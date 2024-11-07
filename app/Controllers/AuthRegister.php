<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AuthRegister extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'CI CRUD - Register'
        ];

        return view('auth/register', $data);
    }

    public function do_register()
    {
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $email = $request->getPost('email');
        $name = $request->getPost('name');
        $password = $request->getPost('password');
        $password_repeat = $request->getPost('password_repeat');

        $err = "";
        $regSuccess = true;

        if(!$email)
        {
            $err .= "email empty.<br>";
            $regSuccess = false;
        }

        if(!$name)
        {
            $err .= "name empty.<br>";
            $regSuccess = false;
        }

        if(!$password)
        {
            $err .= "password empty.<br>";
            $regSuccess = false;
        }

        if($password != $password_repeat)
        {
            $err .= "password doesn't match.<br>";
            $regSuccess = false;
        }

        if($regSuccess == false) {
            session()->setFlashdata("error", $err);
            return redirect()->to(site_url('/auth/register'));
        }

        $userModel = model('User');

        $data = [
            'static_role' => null,
            'scripted_role_id' => null,
            'email' => $email,
            'name' => $name,
            'password' => md5($password),
        ];
        
        $userId = $userModel->insert($data);

        return redirect()->to(site_url('/auth/login'));

    }
}
