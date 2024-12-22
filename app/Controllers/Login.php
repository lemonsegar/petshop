<?php
namespace App\Controllers;
use App\Models\UserModel;
class Login extends BaseController
{
    public function index()
    {
        echo view('/login/v_login');
    }

    public function ceklogin()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $cek = $model->cek_login($username);
        if ($cek) {
            $pass = $cek['password'];
            $verify_pass = password_verify($password, $pass);
            if ($pass == $verify_pass) {
                session()->set('username', $cek['username']);
                session()->set('masuk', TRUE);
                session()->set('level', $cek['level']);
                return redirect()->to('/layout');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}