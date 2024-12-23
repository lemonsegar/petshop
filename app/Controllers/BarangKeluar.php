<?php

namespace App\Controllers;

use App\Models\BarangKeluarModel;
use App\Models\BarangKeluarDetailModel;
use App\Models\ModelProduk;
use App\Models\ModelPelanggan;

class BarangKeluar extends BaseController
{
    protected $barangKeluarModel;
    protected $barangKeluarDetailModel;
    protected $produkModel;
    protected $pelangganModel;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->barangKeluarDetailModel = new BarangKeluarDetailModel();
        $this->produkModel = new ModelProduk();
        $this->pelangganModel = new ModelPelanggan();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Barang Keluar',
            'barangkeluar' => $this->barangKeluarModel->getBarangKeluar()
        ];

        return view('barangkeluar/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Barang Keluar',
            'no_faktur' => $this->barangKeluarModel->generateNoFaktur(),
            'produk' => $this->produkModel->getProduk()->getResult()
        ];

        return view('barangkeluar/create', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Simpan header barang keluar
            $dataHeader = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'total_harga' => str_replace(',', '', $this->request->getPost('total_harga')),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            // Insert ke tabel barang_keluar
            $builder = $db->table('barang_keluar');
            $builder->insert($dataHeader);

            // Ambil ID yang baru saja di-insert
            $id_barang_keluar = $db->insertID();

            // Simpan detail barang keluar
            $id_produk = $this->request->getPost('id_produk');
            $jumlah = $this->request->getPost('jumlah');
            $harga = $this->request->getPost('harga');
            $subtotal = $this->request->getPost('subtotal');

            foreach ($id_produk as $key => $value) {
                if ($value && $jumlah[$key]) {
                    // Cek stok terlebih dahulu
                    $queryStok = $db->table('produk')->where('id_produk', $value)->get();
                    $produk = $queryStok->getRow();

                    if ($produk) {
                        $stokBaru = $produk->stok - (int)$jumlah[$key];

                        if ($stokBaru < 0) {
                            throw new \Exception('Stok tidak mencukupi untuk produk ' . $produk->nama_produk);
                        }

                        // Insert ke tabel barang_keluar_detail
                        $dataDetail = [
                            'id_barang_keluar' => $id_barang_keluar,
                            'id_produk' => $value,
                            'jumlah' => $jumlah[$key],
                            'harga' => str_replace(',', '', $harga[$key]),
                            'subtotal' => str_replace(',', '', $subtotal[$key])
                        ];
                        $db->table('barang_keluar_detail')->insert($dataDetail);

                        // Update stok produk
                        $db->table('produk')
                            ->where('id_produk', $value)
                            ->update(['stok' => $stokBaru]);
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal menyimpan data');
            }

            return redirect()->to('barangkeluar')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Barang Keluar',
            'barangkeluar' => $this->barangKeluarModel->getBarangKeluar($id),
            'detail' => $this->barangKeluarDetailModel->getDetailWithProduk($id)
        ];

        if (empty($data['barangkeluar'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Barang Keluar tidak ditemukan');
        }

        return view('barangkeluar/show', $data);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        try {
            // Get barang keluar header dengan query langsung
            $sql = "SELECT bk.*, p.nama_pelanggan 
                    FROM barang_keluar bk 
                    JOIN pelanggan p ON p.id_pelanggan = bk.id_pelanggan 
                    WHERE bk.id_barang_keluar = ?";
            $barangkeluar = $db->query($sql, [$id])->getRow();

            if (!$barangkeluar) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Barang Keluar tidak ditemukan');
            }

            // Get detail dengan query langsung
            $sqlDetail = "SELECT bkd.*, p.nama_produk, p.stok 
                         FROM barang_keluar_detail bkd 
                         JOIN produk p ON p.id_produk = bkd.id_produk 
                         WHERE bkd.id_barang_keluar = ?";
            $detail = $db->query($sqlDetail, [$id])->getResultArray();

            // Get data pelanggan
            $pelanggan = $db->table('pelanggan')->get()->getResultArray();

            // Get data produk
            $produk = $db->table('produk')->get()->getResultArray();

            $data = [
                'title' => 'Edit Barang Keluar',
                'barangkeluar' => $barangkeluar,
                'detail' => $detail,
                'pelanggan' => $pelanggan,
                'produk' => $produk
            ];

            return view('barangkeluar/edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Ambil data lama untuk mengembalikan stok
            $oldDetail = $this->barangKeluarDetailModel->getDetailWithProduk($id);
            foreach ($oldDetail as $item) {
                // Kembalikan stok lama
                $produk = $db->table('produk')->where('id_produk', $item['id_produk'])->get()->getRow();
                if ($produk) {
                    $stokKembali = $produk->stok + $item['jumlah'];
                    $db->table('produk')
                        ->where('id_produk', $item['id_produk'])
                        ->update(['stok' => $stokKembali]);
                }
            }

            // Update header barang keluar
            $dataHeader = [
                'tanggal' => $this->request->getPost('tanggal'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'total_harga' => str_replace(',', '', $this->request->getPost('total_harga')),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            $db->table('barang_keluar')
                ->where('id_barang_keluar', $id)
                ->update($dataHeader);

            // Hapus detail lama
            $db->table('barang_keluar_detail')
                ->where('id_barang_keluar', $id)
                ->delete();

            // Insert detail baru
            $id_produk = $this->request->getPost('id_produk');
            $jumlah = $this->request->getPost('jumlah');
            $harga = $this->request->getPost('harga');
            $subtotal = $this->request->getPost('subtotal');

            foreach ($id_produk as $key => $value) {
                if ($value && $jumlah[$key]) {
                    // Cek stok
                    $queryStok = $db->table('produk')->where('id_produk', $value)->get();
                    $produk = $queryStok->getRow();

                    if ($produk) {
                        $stokBaru = $produk->stok - (int)$jumlah[$key];

                        if ($stokBaru < 0) {
                            throw new \Exception('Stok tidak mencukupi untuk produk ' . $produk->nama_produk);
                        }

                        // Insert detail baru
                        $dataDetail = [
                            'id_barang_keluar' => $id,
                            'id_produk' => $value,
                            'jumlah' => $jumlah[$key],
                            'harga' => str_replace(',', '', $harga[$key]),
                            'subtotal' => str_replace(',', '', $subtotal[$key])
                        ];
                        $db->table('barang_keluar_detail')->insert($dataDetail);

                        // Update stok
                        $db->table('produk')
                            ->where('id_produk', $value)
                            ->update(['stok' => $stokBaru]);
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal mengupdate data');
            }

            return redirect()->to('barangkeluar')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Ambil detail untuk mengembalikan stok
            $detail = $this->barangKeluarDetailModel->getDetailWithProduk($id);
            foreach ($detail as $item) {
                // Kembalikan stok
                $produk = $db->table('produk')->where('id_produk', $item['id_produk'])->get()->getRow();
                if ($produk) {
                    $stokKembali = $produk->stok + $item['jumlah'];
                    $db->table('produk')
                        ->where('id_produk', $item['id_produk'])
                        ->update(['stok' => $stokKembali]);
                }
            }

            // Hapus detail
            $db->table('barang_keluar_detail')->where('id_barang_keluar', $id)->delete();

            // Hapus header
            $db->table('barang_keluar')->where('id_barang_keluar', $id)->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data']);
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    public function laporan()
    {
        $db = \Config\Database::connect();

        try {
            // Default bulan (bulan ini)
            $bulan = $this->request->getGet('bulan') ?? date('m');
            $tahun = $this->request->getGet('tahun') ?? date('Y');

            // Default tanggal (1 bulan terakhir)
            $tgl_awal = $this->request->getGet('tgl_awal') ?? date('Y-m-d', strtotime('-1 month'));
            $tgl_akhir = $this->request->getGet('tgl_akhir') ?? date('Y-m-d');

            // Query untuk mendapatkan data barang keluar dengan detail
            $sql = "SELECT bk.*, 
                           bkd.id_produk, p.nama_produk, bkd.jumlah, bkd.harga, bkd.subtotal
                    FROM barang_keluar bk
                    JOIN barang_keluar_detail bkd ON bkd.id_barang_keluar = bk.id_barang_keluar
                    JOIN produk p ON p.id_produk = bkd.id_produk
                    WHERE 1=1";

            $params = [];

            // Filter berdasarkan tanggal atau bulan
            if ($this->request->getGet('filter_type') == 'bulan') {
                $sql .= " AND MONTH(bk.tanggal) = ? AND YEAR(bk.tanggal) = ?";
                $params = [$bulan, $tahun];
            } else {
                $sql .= " AND DATE(bk.tanggal) BETWEEN ? AND ?";
                $params = [$tgl_awal, $tgl_akhir];
            }

            $sql .= " ORDER BY bk.tanggal DESC, bk.id_barang_keluar ASC";

            $data = [
                'title' => 'Laporan Barang Keluar',
                'barang_keluar' => $db->query($sql, $params)->getResultArray(),
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'filter_type' => $this->request->getGet('filter_type') ?? 'tanggal'
            ];

            return view('barangkeluar/laporan', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakPdf()
    {
        $db = \Config\Database::connect();

        try {
            // Get filter type
            $filter_type = $this->request->getGet('filter_type') ?? 'tanggal';

            $sql = "SELECT bk.*, 
                           bkd.id_produk, p.nama_produk, bkd.jumlah, bkd.harga, bkd.subtotal
                    FROM barang_keluar bk
                    JOIN barang_keluar_detail bkd ON bkd.id_barang_keluar = bk.id_barang_keluar
                    JOIN produk p ON p.id_produk = bkd.id_produk
                    WHERE 1=1";

            $params = [];
            $periode = '';

            if ($filter_type == 'bulan') {
                $bulan = $this->request->getGet('bulan');
                $tahun = $this->request->getGet('tahun');
                $sql .= " AND MONTH(bk.tanggal) = ? AND YEAR(bk.tanggal) = ?";
                $params = [$bulan, $tahun];
                $periode = "Bulan " . bulan($bulan) . " " . $tahun;
            } else {
                $tgl_awal = $this->request->getGet('tgl_awal');
                $tgl_akhir = $this->request->getGet('tgl_akhir');
                $sql .= " AND DATE(bk.tanggal) BETWEEN ? AND ?";
                $params = [$tgl_awal, $tgl_akhir];
                $periode = "Periode " . tanggal_indo($tgl_awal) . " - " . tanggal_indo($tgl_akhir);
            }

            $sql .= " ORDER BY bk.tanggal DESC, bk.id_barang_keluar ASC";

            $data = [
                'barang_keluar' => $db->query($sql, $params)->getResultArray(),
                'periode' => $periode,
                'tanggal' => date('d/m/Y')
            ];

            $dompdf = new \Dompdf\Dompdf();
            $html = view('barangkeluar/cetak_pdf', $data);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('laporan_barang_keluar.pdf', ['Attachment' => false]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
