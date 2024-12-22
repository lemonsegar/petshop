<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function getUser()
    {
      $builder = $this->db->table('user');
      return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('user')->insert($data);
    }

    public function deletuser($id)
    {
        $query = $this->db->table('user')->delete(array('id_user' => $id));
        return $query;
    }

    public function updateuser($data, $id)
    {
        $query = $this->db->table('user')->update($data, array('id_user' => $id));
    }

    
}
?>