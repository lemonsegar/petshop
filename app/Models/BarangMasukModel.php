<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['no_faktur', 'tanggal', 'supplier', 'total_harga', 'keterangan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    // Generate nomor faktur otomatis
    public function generateNoFaktur()
    {
        $date = date('Ymd');
        $query = $this->db->query("SELECT MAX(no_faktur) as nomor FROM barang_masuk WHERE no_faktur LIKE 'BM$date%'");
        $result = $query->getRow();

        if ($result->nomor) {
            $lastNo = substr($result->nomor, -4);
            $nextNo = intval($lastNo) + 1;
            $nextNo = sprintf('%04d', $nextNo);
        } else {
            $nextNo = '0001';
        }

        return 'BM' . $date . $nextNo;
    }
}
