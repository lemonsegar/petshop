<?php

namespace App\Controllers;

use App\Models\PelayananModel;
use App\Models\PelayananDetailModel;
use App\Models\ModelLayanan;
use App\Models\ModelPelanggan;

class Pelayanan extends BaseController
{
    protected $pelayananModel;
    protected $pelayananDetailModel;
    protected $layananModel;
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelayananModel = new PelayananModel();
        $this->pelayananDetailModel = new PelayananDetailModel();
        $this->layananModel = new ModelLayanan();
        $this->pelangganModel = new ModelPelanggan();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pelayanan',
            'pelayanan' => $this->pelayananModel->getPelayanan()
        ];

        return view('pelayanan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pelayanan',
            'no_faktur' => $this->pelayananModel->generateNoFaktur(),
            'layanan' => $this->layananModel->findAll()
        ];

        return view('pelayanan/create', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Insert header
            $dataHeader = [
                'no_faktur' => $this->request->getPost('no_faktur'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'total_harga' => str_replace(',', '', $this->request->getPost('total_harga')),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            $this->pelayananModel->insert($dataHeader);
            $id_pelayanan = $this->pelayananModel->insertID();

            // Insert detail
            $id_layanan = $this->request->getPost('id_layanan');
            $harga = $this->request->getPost('harga');
            $subtotal = $this->request->getPost('subtotal');

            foreach ($id_layanan as $key => $value) {
                if ($value) {
                    $dataDetail = [
                        'id_pelayanan' => $id_pelayanan,
                        'id_layanan' => $value,
                        'harga' => str_replace(',', '', $harga[$key]),
                        'subtotal' => str_replace(',', '', $subtotal[$key])
                    ];
                    $this->pelayananDetailModel->insert($dataDetail);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data');
            }

            return redirect()->to('pelayanan')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Pelayanan',
            'pelayanan' => $this->pelayananModel->getPelayanan($id),
            'detail' => $this->pelayananDetailModel->getDetailWithLayanan($id)
        ];

        if (empty($data['pelayanan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pelayanan tidak ditemukan');
        }

        return view('pelayanan/show', $data);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        try {
            // Get pelayanan header dengan query langsung
            $sql = "SELECT p.*, pl.nama_pelanggan 
                    FROM pelayanan p 
                    JOIN pelanggan pl ON pl.id_pelanggan = p.id_pelanggan 
                    WHERE p.id_pelayanan = ?";
            $pelayanan = $db->query($sql, [$id])->getRow();

            if (!$pelayanan) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pelayanan tidak ditemukan');
            }

            // Get detail dengan query langsung
            $sqlDetail = "SELECT pd.*, l.nama_layanan 
                         FROM pelayanan_detail pd 
                         JOIN layanan l ON l.id_layanan = pd.id_layanan 
                         WHERE pd.id_pelayanan = ?";
            $detail = $db->query($sqlDetail, [$id])->getResultArray();

            $data = [
                'title' => 'Edit Pelayanan',
                'pelayanan' => $pelayanan,
                'detail' => $detail,
                'layanan' => $this->layananModel->findAll()
            ];

            return view('pelayanan/edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update header
            $dataHeader = [
                'tanggal' => $this->request->getPost('tanggal'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'total_harga' => str_replace(',', '', $this->request->getPost('total_harga')),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            $this->pelayananModel->update($id, $dataHeader);

            // Hapus detail lama
            $this->pelayananDetailModel->where('id_pelayanan', $id)->delete();

            // Insert detail baru
            $id_layanan = $this->request->getPost('id_layanan');
            $harga = $this->request->getPost('harga');
            $subtotal = $this->request->getPost('subtotal');

            foreach ($id_layanan as $key => $value) {
                if ($value) {
                    $dataDetail = [
                        'id_pelayanan' => $id,
                        'id_layanan' => $value,
                        'harga' => str_replace(',', '', $harga[$key]),
                        'subtotal' => str_replace(',', '', $subtotal[$key])
                    ];
                    $this->pelayananDetailModel->insert($dataDetail);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal mengupdate data');
            }

            return redirect()->to('pelayanan')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Hapus detail terlebih dahulu
            $this->pelayananDetailModel->where('id_pelayanan', $id)->delete();

            // Hapus header
            $this->pelayananModel->delete($id);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menghapus data');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ]);
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

            // Query untuk mendapatkan data pelayanan dengan detail
            $sql = "SELECT p.*, pl.nama_pelanggan, pd.id_layanan, l.nama_layanan, 
                           pd.harga, pd.subtotal
                    FROM pelayanan p
                    JOIN pelanggan pl ON pl.id_pelanggan = p.id_pelanggan
                    JOIN pelayanan_detail pd ON pd.id_pelayanan = p.id_pelayanan
                    JOIN layanan l ON l.id_layanan = pd.id_layanan
                    WHERE 1=1";

            $params = [];

            // Filter berdasarkan tanggal atau bulan
            if ($this->request->getGet('filter_type') == 'bulan') {
                $sql .= " AND MONTH(p.tanggal) = ? AND YEAR(p.tanggal) = ?";
                $params = [$bulan, $tahun];
            } else {
                $sql .= " AND DATE(p.tanggal) BETWEEN ? AND ?";
                $params = [$tgl_awal, $tgl_akhir];
            }

            $sql .= " ORDER BY p.tanggal DESC, p.id_pelayanan ASC";

            $data = [
                'title' => 'Laporan Pelayanan',
                'pelayanan' => $db->query($sql, $params)->getResultArray(),
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'filter_type' => $this->request->getGet('filter_type') ?? 'tanggal'
            ];

            return view('pelayanan/laporan', $data);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->to('pelayanan');
        }
    }

    public function cetakPdf()
    {
        $db = \Config\Database::connect();

        try {
            // Get filter type
            $filter_type = $this->request->getGet('filter_type') ?? 'tanggal';

            $sql = "SELECT p.*, pl.nama_pelanggan, pd.id_layanan, l.nama_layanan, 
                           pd.harga, pd.subtotal
                    FROM pelayanan p
                    JOIN pelanggan pl ON pl.id_pelanggan = p.id_pelanggan
                    JOIN pelayanan_detail pd ON pd.id_pelayanan = p.id_pelayanan
                    JOIN layanan l ON l.id_layanan = pd.id_layanan
                    WHERE 1=1";

            $params = [];
            $periode = '';

            if ($filter_type == 'bulan') {
                $bulan = $this->request->getGet('bulan');
                $tahun = $this->request->getGet('tahun');
                $sql .= " AND MONTH(p.tanggal) = ? AND YEAR(p.tanggal) = ?";
                $params = [$bulan, $tahun];
                $periode = "Bulan " . bulan($bulan) . " " . $tahun;
            } else {
                $tgl_awal = $this->request->getGet('tgl_awal');
                $tgl_akhir = $this->request->getGet('tgl_akhir');
                $sql .= " AND DATE(p.tanggal) BETWEEN ? AND ?";
                $params = [$tgl_awal, $tgl_akhir];
                $periode = "Periode " . tanggal_indo($tgl_awal) . " - " . tanggal_indo($tgl_akhir);
            }

            $sql .= " ORDER BY p.tanggal DESC, p.id_pelayanan ASC";

            $data = [
                'pelayanan' => $db->query($sql, $params)->getResultArray(),
                'periode' => $periode,
                'tanggal' => date('d/m/Y')
            ];

            $dompdf = new \Dompdf\Dompdf();
            $html = view('pelayanan/cetak_pdf', $data);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('laporan_pelayanan.pdf', ['Attachment' => false]);
            exit();
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->to('pelayanan');
        }
    }
}
