<?php

namespace App\Models;

use CodeIgniter\Model;

class PelayananDetailModel extends Model
{
    protected $table = 'pelayanan_detail';
    protected $primaryKey = 'id_pelayanan_detail';
    protected $allowedFields = ['id_pelayanan', 'id_layanan', 'harga', 'subtotal'];

    public function getDetailWithLayanan($id_pelayanan)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pelayanan_detail.*, layanan.nama_layanan');
        $builder->join('layanan', 'layanan.id_layanan = pelayanan_detail.id_layanan');
        $builder->where('id_pelayanan', $id_pelayanan);
        return $builder->get()->getResultArray();
    }
}
