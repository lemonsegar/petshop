<?php
namespace App\Controllers;

use App\Models\ModelPelanggan;

class Pelanggan extends BaseController
{
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
        return redirect()->to('/pelanggan/index');
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
    return redirect()->to('/pelanggan/index');
}
}
?>