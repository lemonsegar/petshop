<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelProduk extends Model
{
    public function getProduk()
    {
      $builder = $this->db->table('produk');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('produk')->insert($data);
    }

    public function deletproduk($id)
    {
        $query = $this->db->table('produk')->delete(array('id_produk' => $id));
        return $query;
    }

    public function updateproduk($data, $id)
    {
        $query = $this->db->table('produk')->update($data, array('id_produk' => $id));
    }
}
?>