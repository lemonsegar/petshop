<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_keluar_detail';
    protected $primaryKey       = 'id_detail';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang_keluar', 'id_produk', 'jumlah', 'harga', 'subtotal'];

    public function getDetailWithProduk($id_barang_keluar)
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang_keluar_detail.*, produk.nama_produk');
        $builder->join('produk', 'produk.id_produk = barang_keluar_detail.id_produk');
        $builder->where('id_barang_keluar', $id_barang_keluar);
        return $builder->get()->getResultArray();
    }
}
