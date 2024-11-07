<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class Home extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - Home";

        $data = [
            'title' => $title,
        ];

        return view('home', $data);
    }
}
