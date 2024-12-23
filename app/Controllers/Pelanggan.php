<?php

namespace App\Controllers;

use App\Models\ModelPelanggan;

class Pelanggan extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new ModelPelanggan();
    }

    public function index()
    {
        $model = new ModelPelanggan();
        $data['pelanggan'] = $model->getPelanggan()->getResultArray();
        echo view('pelanggan/v_pelanggan', $data);
    }


    public function save()
    {
        $model = new ModelPelanggan();
        $data = array(
            'id_pelanggan'  => $this->request->getPost('id'),
            'nama_pelanggan' => $this->request->getPost('namapelanggan'),
            'alamat'       => $this->request->getPost('alamat'),
            'no_telfon'        => $this->request->getPost('no_telfon'),
            'tanggal'         => $this->request->getPost('tanggal'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[pelanggan.id_pelanggan]',
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
        return redirect()->to('/pelanggan');
    }

    public function delete()
    {
        $model = new ModelPelanggan();
        $id = $this->request->getpost('deleteId');
        $model->deletPelanggan($id);
        return redirect()->to('/pelanggan');
    }

    function update()
    {
        $model = new ModelPelanggan();
        $id = $this->request->getPost('id');
        $data = array(
            'id_pelanggan'  => $id,
            'nama_pelanggan' => $this->request->getPost('namapelanggan'),
            'alamat'       => $this->request->getPost('alamat'),
            'no_telfon'        => $this->request->getPost('no_telfon'),
            'tanggal'         => $this->request->getPost('tanggal'),
        );
        $model->updatepelanggan($data, $id);
        return redirect()->to('/pelanggan');
    }

    public function datatables()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('pelanggan');

            // Pencarian
            $search = $this->request->getPost('search');
            if (isset($search['value'])) {
                $searchValue = $search['value'];
                $builder->groupStart()
                    ->like('nama_pelanggan', $searchValue)
                    ->orLike('alamat', $searchValue)
                    ->orLike('no_telfon', $searchValue)
                    ->groupEnd();
            }

            // Total records sebelum filter
            $totalRecords = $builder->countAllResults(false);
            $totalDisplay = $totalRecords;

            // Ordering
            $order = $this->request->getPost('order');
            if (isset($order[0])) {
                $columns = ['nama_pelanggan', 'alamat', 'no_telfon'];
                $columnIndex = $order[0]['column'];
                if (isset($columns[$columnIndex])) {
                    $columnName = $columns[$columnIndex];
                    $columnSort = $order[0]['dir'];
                    $builder->orderBy($columnName, $columnSort);
                }
            }

            // Limit & offset
            $start = $this->request->getPost('start');
            $length = $this->request->getPost('length');
            if ($length !== -1) {
                $builder->limit($length, $start);
            }

            // Get data
            $results = $builder->get()->getResultArray();

            // Total records setelah filter
            if (isset($searchValue)) {
                $totalDisplay = count($results);
            }

            $response = [
                'draw' => intval($this->request->getPost('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalDisplay,
                'data' => $results
            ];

            return $this->response->setJSON($response);
        }

        return $this->response->setStatusCode(404);
    }

    public function laporan()
    {
        $db = \Config\Database::connect();

        try {
            
            $sql = "SELECT id_pelanggan, nama_pelanggan, alamat, no_telfon 
                    FROM pelanggan 
                    ORDER BY nama_pelanggan ASC";

            $data = [
                'title' => 'Laporan Data Pelanggan',
                'pelanggan' => $db->query($sql)->getResultArray()
            ];

            return view('pelanggan/laporan', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakPdf()
    {
        $db = \Config\Database::connect();

        try {
            // Query untuk mendapatkan data pelanggan
            $sql = "SELECT id_pelanggan, nama_pelanggan, alamat, no_telfon 
                    FROM pelanggan 
                    ORDER BY nama_pelanggan ASC";

            $data = [
                'pelanggan' => $db->query($sql)->getResultArray(),
                'tanggal' => date('d/m/Y')
            ];

            $dompdf = new \Dompdf\Dompdf();
            $html = view('pelanggan/cetak_pdf', $data);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('laporan_pelanggan.pdf', ['Attachment' => false]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
