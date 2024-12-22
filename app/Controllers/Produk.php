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
        return redirect()->to('/produk/index');
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
    return redirect()->to('/produk/index');
}
}
?>