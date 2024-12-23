<?php

namespace App\Models;

use CodeIgniter\Model;

class PelayananModel extends Model
{
    protected $table = 'pelayanan';
    protected $primaryKey = 'id_pelayanan';
    protected $allowedFields = ['no_faktur', 'tanggal', 'id_pelanggan', 'total_harga', 'keterangan'];
    protected $useTimestamps = true;

    public function generateNoFaktur()
    {
        $date = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur, 4)) as max_no FROM pelayanan 
                                  WHERE DATE(created_at) = CURDATE()");
        $result = $query->getRow();
        $max_no = $result->max_no;

        $next_no = intval($max_no) + 1;
        $no_faktur = 'PL' . $date . sprintf('%04s', $next_no);

        return $no_faktur;
    }

    public function getPelayanan($id = null)
    {
        $builder = $this->db->table('pelayanan');
        $builder->select('pelayanan.*, pelanggan.nama_pelanggan');
        $builder->join('pelanggan', 'pelanggan.id_pelanggan = pelayanan.id_pelanggan');

        if ($id !== null) {
            $builder->where('pelayanan.id_pelayanan', $id);
            return $builder->get()->getRow();
        }

        return $builder->get()->getResultArray();
    }
}
