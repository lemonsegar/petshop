<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelLayanan extends Model
{
    public function getlayanan()
    {
      $builder = $this->db->table('layanan');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('layanan')->insert($data);
    }

    public function deletlayanan($id)
    {
        $query = $this->db->table('layanan')->delete(array('id_layanan' => $id));
        return $query;
    }

    public function updatelayanan($data, $id)
    {
        $query = $this->db->table('layanan')->update($data, array('id_layanan' => $id));
    }
}
?>