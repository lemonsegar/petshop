<?php

namespace App\Controllers;

use App\Models\ModelProduk;

class Produk extends BaseController
{
    public function index()
    {
        $model = new ModelProduk();
        $data['produk'] = $model->getProduk()->getResultArray();
        echo view('produk/v_produk', $data);
    }


    public function save()
    {
        $model = new ModelProduk();
        $data = array(
            'id_produk'  => $this->request->getPost('id'),
            'nama_produk' => $this->request->getPost('namaproduk'),
            'kategori'       => $this->request->getPost('kat'),
            'stok'        => $this->request->getPost('stok'),
            'harga'         => $this->request->getPost('harga'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[produk.id_produk]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} Sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }

        $model->insertData($data);
        return redirect()->to('/produk');
    }

    public function delete()
    {
        $model = new ModelProduk();
        $id = $this->request->getpost('id');
        $model->deletproduk($id);
        return redirect()->to('/produk');
    }

    function update()
    {
        $model = new ModelProduk();
        $id = $this->request->getPost('id');
        $data = array(
            'id_produk'  => $this->request->getPost('id'),
            'nama_produk' => $this->request->getPost('namaproduk'),
            'kategori'       => $this->request->getPost('kat'),
            'stok'        => $this->request->getPost('stok'),
            'harga'         => $this->request->getPost('harga'),
        );
        $model->updateproduk($data, $id);
        return redirect()->to('/produk');
    }

    public function laporan()
    {
        $db = \Config\Database::connect();

        try {
            // Get semua ID produk untuk dropdown
            $sql_produk = "SELECT id_produk, CONCAT(id_produk, ' - ', nama_produk) as nama 
                           FROM produk 
                           ORDER BY id_produk ASC";
            $produk_list = $db->query($sql_produk)->getResultArray();

            // Get filter dari form jika ada
            $dari = $this->request->getGet('dari') ?? $produk_list[0]['id_produk'];
            $sampai = $this->request->getGet('sampai') ?? end($produk_list)['id_produk'];

            // Query untuk mendapatkan data produk dengan filter
            $sql = "SELECT id_produk, nama_produk, kategori, stok, harga 
                    FROM produk 
                    WHERE id_produk BETWEEN ? AND ?
                    ORDER BY nama_produk ASC";

            $data = [
                'title' => 'Laporan Data Produk',
                'produk' => $db->query($sql, [$dari, $sampai])->getResultArray(),
                'produk_list' => $produk_list,
                'dari' => $dari,
                'sampai' => $sampai
            ];

            return view('produk/laporan', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakPdf()
    {
        $db = \Config\Database::connect();

        try {
            // Get filter dari URL
            $dari = $this->request->getGet('dari');
            $sampai = $this->request->getGet('sampai');

            // Query untuk mendapatkan data produk dengan filter
            $sql = "SELECT id_produk, nama_produk, kategori, stok, harga 
                    FROM produk 
                    WHERE id_produk BETWEEN ? AND ?
                    ORDER BY nama_produk ASC";

            $data = [
                'produk' => $db->query($sql, [$dari, $sampai])->getResultArray(),
                'tanggal' => date('d/m/Y'),
                'dari' => $dari,
                'sampai' => $sampai
            ];

            $dompdf = new \Dompdf\Dompdf();
            $html = view('produk/cetak_pdf', $data);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('laporan_produk.pdf', ['Attachment' => false]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getIdProduk()
    {
        $db = \Config\Database::connect();

        try {
            $search = $this->request->getGet('search');

            $sql = "SELECT id_produk, CONCAT(id_produk, ' - ', nama_produk) as text 
                    FROM produk 
                    WHERE id_produk LIKE ? OR nama_produk LIKE ?
                    ORDER BY id_produk ASC 
                    LIMIT 10";

            $data = $db->query($sql, ["%$search%", "%$search%"])->getResultArray();

            return $this->response->setJSON(['results' => $data]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => $e->getMessage()]);
        }
    }
}
