<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminDashboard extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - Dashboard";

        $data = [
            'title' => $title,
        ];

        return view('admin/dashboard', $data);
    }
}
