<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    public function simpan($data){
        $query= $this->db->table('user')->insert($data);
        return $query;
    }

    public function cek_login($username){
        return $this->db->table('user')->where(array('username'=>$username))->get()->getRowArray();
    }

    public function getUser()
    {
        $builder= $this->db->table('user');
        return $builder->get();
    }
}