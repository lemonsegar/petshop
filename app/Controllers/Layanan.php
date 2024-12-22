<?php
namespace App\Controllers;

use App\Models\ModelLayanan;

class Layanan extends BaseController
{
    public function index()
    {
        $model = new ModelLayanan();
        $data['layanan'] = $model->getlayanan()->getResultArray();
        echo view('layanan/v_layanan', $data);
    }


    public function save()
    {
        $model = new ModelLayanan();
        $data = array(
            'id_layanan'  => $this->request->getPost('id'),
            'nama_layanan' => $this->request->getPost('namalayanan'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[layanan.id_layanan]',
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
        return redirect()->to('/layanan');
    }

    public function delete()
    {
        $model = new ModelLayanan();
        $id = $this->request->getpost('id');
        $model->deletlayanan($id);
        return redirect()->to('/layanan/index');
    }

    function update()
{
    $model = new ModelLayanan();
    $id = $this->request->getPost('id');
    $data = array(
        'id_layanan'  => $this->request->getPost('id'),
            'nama_layanan' => $this->request->getPost('namalayanan'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
    );
    $model->updatelayanan($data, $id);
    return redirect()->to('/layanan/index');
}
}
?>