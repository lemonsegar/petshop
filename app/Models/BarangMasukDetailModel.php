<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukDetailModel extends Model
{
    protected $table = 'barang_masuk_detail';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = ['id_barang_masuk', 'id_produk', 'jumlah', 'harga', 'subtotal'];

    // Ambil detail dengan nama produk
    public function getDetailWithProduk($id_barang_masuk)
    {
        return $this->select('barang_masuk_detail.*, produk.nama_produk')
            ->join('produk', 'produk.id_produk = barang_masuk_detail.id_produk')
            ->where('id_barang_masuk', $id_barang_masuk)
            ->findAll();
    }
}
