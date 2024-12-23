<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_keluar';
    protected $primaryKey       = 'id_barang_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_faktur', 'tanggal', 'id_pelanggan', 'total_harga', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generateNoFaktur()
    {
        $builder = $this->db->table($this->table);
        $date = date('Ymd');
        $query = $builder->like('no_faktur', 'BK' . $date, 'after')
            ->orderBy('no_faktur', 'DESC')
            ->get()
            ->getRow();

        if ($query) {
            $lastNumber = substr($query->no_faktur, -4);
            $nextNumber = str_pad((int)$lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return 'BK' . $date . $nextNumber;
    }

    public function getBarangKeluar($id = null)
    {
        $builder = $this->db->table('barang_keluar');
        $builder->select('barang_keluar.*, pelanggan.nama_pelanggan');
        $builder->join('pelanggan', 'pelanggan.id_pelanggan = barang_keluar.id_pelanggan');

        if ($id !== null) {
            $builder->where('barang_keluar.id_barang_keluar', $id);
            return $builder->get()->getRow();
        }

        $builder->orderBy('barang_keluar.tanggal', 'DESC');
        return $builder->get()->getResultArray();
    }
}
