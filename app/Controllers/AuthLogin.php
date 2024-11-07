<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AuthLogin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'CI CRUD - Login'
        ];
        return view('auth/login', $data);
    }

    public function do_login()
    {
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $email = $request->getPost('email');
        $password = $request->getPost('password');

        $err = "";
        $loginSuccess = true;
        if(!$email)
        {
            $err .= "email empty.<br>";
            $loginSuccess = false;
        }

        if(!$password)
        {
            $err .= "password empty.<br>";
            $loginSuccess = false;
        }

        $userModel = model('User');
        $pair = $userModel->where(['email' => $email])->first();

        // dd($pair);

        if(!$pair)
        {
            $err .= "email not found.<br>";
            $loginSuccess = false;
        }

        if($loginSuccess == false) {
            session()->setFlashdata("error", $err);
            return redirect()->to(site_url('/auth/login'));
        }
    
        if(md5($password) != $pair["password"])
        {
            $err .= "invalid password.<br>";
            $loginSuccess = false;
        }

        if($loginSuccess == false) {
            session()->setFlashdata("error", $err);
            return redirect()->to(site_url('/auth/login'));
        }


        session()->set($pair);
        return redirect()->to(site_url('/admin'));
    }

    public function do_logout()
    {
        session()->destroy();
        return redirect()->to(site_url('/auth/login'));
    }
}
