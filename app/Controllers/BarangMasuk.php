<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangMasukDetailModel;
use App\Models\ModelProduk;

class BarangMasuk extends BaseController
{
    protected $barangMasukModel;
    protected $barangMasukDetailModel;
    protected $produkModel;

    public function __construct()
    {
        $this->barangMasukModel = new BarangMasukModel();
        $this->barangMasukDetailModel = new BarangMasukDetailModel();
        $this->produkModel = new ModelProduk();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Barang Masuk',
            'barangmasuk' => $this->barangMasukModel->findAll()
        ];
        return view('barangmasuk/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Barang Masuk',
            'no_faktur' => $this->barangMasukModel->generateNoFaktur(),
            'produk' => $this->produkModel->getProduk()->getResult()
        ];
        return view('barangmasuk/create', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Simpan header barang masuk
            $dataHeader = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tanggal' => $this->request->getPost('tanggal'),
                'supplier' => $this->request->getPost('supplier'),
                'total_harga' => str_replace(',', '', $this->request->getPost('total_harga')),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            // Debug
            // var_dump($dataHeader);

            // Insert ke tabel barang_masuk
            $builder = $db->table('barang_masuk');
            $builder->insert($dataHeader);

            // Ambil ID yang baru saja di-insert
            $id_barang_masuk = $db->insertID();

            // Simpan detail barang masuk
            $id_produk = $this->request->getPost('id_produk');
            $jumlah = $this->request->getPost('jumlah');
            $harga = $this->request->getPost('harga');
            $subtotal = $this->request->getPost('subtotal');

            foreach ($id_produk as $key => $value) {
                if ($value && $jumlah[$key]) {
                    $dataDetail = [
                        'id_barang_masuk' => $id_barang_masuk,
                        'id_produk' => $value,
                        'jumlah' => $jumlah[$key],
                        'harga' => str_replace(',', '', $harga[$key]),
                        'subtotal' => str_replace(',', '', $subtotal[$key])
                    ];

                    // Debug
                    // var_dump($dataDetail);

                    // Insert ke tabel barang_masuk_detail
                    $db->table('barang_masuk_detail')->insert($dataDetail);

                    // Update stok produk
                    $queryStok = $db->table('produk')->where('id_produk', $value)->get();
                    $produk = $queryStok->getRow();

                    if ($produk) {
                        $stokBaru = $produk->stok + (int)$jumlah[$key];
                        $db->table('produk')
                            ->where('id_produk', $value)
                            ->update(['stok' => $stokBaru]);
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                // Debug
                // var_dump($db->error());
                return redirect()->back()->with('error', 'Gagal menyimpan data');
            }

            return redirect()->to('barangmasuk')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            $db->transRollback();
            // Debug
            // var_dump($e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Barang Masuk',
            'barangmasuk' => $this->barangMasukModel->find($id),
            'detail' => $this->barangMasukDetailModel->getDetailWithProduk($id)
        ];
        return view('barangmasuk/show', $data);
    }


    public function edit($id)
    {
        $barangMasukModel = new BarangMasukModel();
        $barangMasukDetailModel = new BarangMasukDetailModel();
        $produkModel = new ModelProduk();

        $data = [
            'title' => 'Edit Barang Masuk',
            'barangmasuk' => $barangMasukModel->find($id),
            'detail' => $barangMasukDetailModel->getDetailWithProduk($id),
            'produk' => $produkModel->getProduk()->getResult()
        ];

        return view('barangmasuk/edit', $data);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Debug untuk melihat data yang diterima
            // var_dump($this->request->getPost());
            // die();

            // Update header barang masuk
            $dataHeader = [
                'tanggal' => $this->request->getPost('tanggal'),
                'supplier' => $this->request->getPost('supplier'),
                'total_harga' => str_replace(',', '', $this->request->getPost('total_harga')),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            // Update langsung menggunakan query builder
            $db->table('barang_masuk')
                ->where('id_barang_masuk', $id)
                ->update($dataHeader);

            // Hapus detail lama
            $detailLama = $db->table('barang_masuk_detail')
                ->where('id_barang_masuk', $id)
                ->get()
                ->getResultArray();

            // Kembalikan stok lama
            foreach ($detailLama as $item) {
                $db->table('produk')
                    ->where('id_produk', $item['id_produk'])
                    ->set('stok', "stok - {$item['jumlah']}", false)
                    ->update();
            }

            // Hapus detail lama
            $db->table('barang_masuk_detail')
                ->where('id_barang_masuk', $id)
                ->delete();

            // Insert detail baru
            $id_produk = $this->request->getPost('id_produk');
            $jumlah = $this->request->getPost('jumlah');
            $harga = $this->request->getPost('harga');
            $subtotal = $this->request->getPost('subtotal');

            foreach ($id_produk as $key => $value) {
                if ($value && $jumlah[$key]) {
                    // Insert detail baru
                    $dataDetail = [
                        'id_barang_masuk' => $id,
                        'id_produk' => $value,
                        'jumlah' => $jumlah[$key],
                        'harga' => str_replace(',', '', $harga[$key]),
                        'subtotal' => str_replace(',', '', $subtotal[$key])
                    ];

                    $db->table('barang_masuk_detail')->insert($dataDetail);

                    // Update stok baru
                    $db->table('produk')
                        ->where('id_produk', $value)
                        ->set('stok', "stok + {$jumlah[$key]}", false)
                        ->update();
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                // Debug jika ada error
                // var_dump($db->error());
                return redirect()->back()->with('error', 'Gagal mengupdate data');
            }

            return redirect()->to('barangmasuk')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            $db->transRollback();
            // Debug exception
            // var_dump($e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $barangMasukModel = new BarangMasukModel();
            $barangMasukDetailModel = new BarangMasukDetailModel();

            // Ambil detail sebelum dihapus untuk update stok
            $detailBarang = $barangMasukDetailModel->where('id_barang_masuk', $id)->findAll();

            // Update stok produk (kurangi)
            foreach ($detailBarang as $item) {
                $db->table('produk')
                    ->where('id_produk', $item['id_produk'])
                    ->set('stok', 'stok - ' . $item['jumlah'], false)
                    ->update();
            }

            // Hapus detail dan header
            $barangMasukDetailModel->where('id_barang_masuk', $id)->delete();
            $barangMasukModel->delete($id);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal menghapus data');
            }

            return redirect()->to('barangmasuk')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
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

            // Query untuk mendapatkan data barang masuk dengan detail
            $sql = "SELECT bm.*, 
                           bmd.id_produk, p.nama_produk, bmd.jumlah, bmd.harga, bmd.subtotal
                    FROM barang_masuk bm
                    JOIN barang_masuk_detail bmd ON bmd.id_barang_masuk = bm.id_barang_masuk
                    JOIN produk p ON p.id_produk = bmd.id_produk
                    WHERE 1=1";

            $params = [];

            // Filter berdasarkan tanggal atau bulan
            if ($this->request->getGet('filter_type') == 'bulan') {
                $sql .= " AND MONTH(bm.tanggal) = ? AND YEAR(bm.tanggal) = ?";
                $params = [$bulan, $tahun];
            } else {
                $sql .= " AND DATE(bm.tanggal) BETWEEN ? AND ?";
                $params = [$tgl_awal, $tgl_akhir];
            }

            $sql .= " ORDER BY bm.tanggal DESC, bm.id_barang_masuk ASC";

            $data = [
                'title' => 'Laporan Barang Masuk',
                'barang_masuk' => $db->query($sql, $params)->getResultArray(),
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'filter_type' => $this->request->getGet('filter_type') ?? 'tanggal'
            ];

            return view('barangmasuk/laporan', $data);
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

            $sql = "SELECT bm.*, 
                           bmd.id_produk, p.nama_produk, bmd.jumlah, bmd.harga, bmd.subtotal
                    FROM barang_masuk bm
                    JOIN barang_masuk_detail bmd ON bmd.id_barang_masuk = bm.id_barang_masuk
                    JOIN produk p ON p.id_produk = bmd.id_produk
                    WHERE 1=1";

            $params = [];
            $periode = '';

            if ($filter_type == 'bulan') {
                $bulan = $this->request->getGet('bulan');
                $tahun = $this->request->getGet('tahun');
                $sql .= " AND MONTH(bm.tanggal) = ? AND YEAR(bm.tanggal) = ?";
                $params = [$bulan, $tahun];
                $periode = "Bulan " . bulan($bulan) . " " . $tahun;
            } else {
                $tgl_awal = $this->request->getGet('tgl_awal');
                $tgl_akhir = $this->request->getGet('tgl_akhir');
                $sql .= " AND DATE(bm.tanggal) BETWEEN ? AND ?";
                $params = [$tgl_awal, $tgl_akhir];
                $periode = "Periode " . tanggal_indo($tgl_awal) . " - " . tanggal_indo($tgl_akhir);
            }

            $sql .= " ORDER BY bm.tanggal DESC, bm.id_barang_masuk ASC";

            $data = [
                'barang_masuk' => $db->query($sql, $params)->getResultArray(),
                'periode' => $periode,
                'tanggal' => date('d/m/Y')
            ];

            $dompdf = new \Dompdf\Dompdf();
            $html = view('barangmasuk/cetak_pdf', $data);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('laporan_barang_masuk.pdf', ['Attachment' => false]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
