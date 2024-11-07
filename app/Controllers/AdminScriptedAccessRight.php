<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminScriptedAccessRight extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - Scripted Access Right";

        //
        $scriptedRoleModel = model("ScriptedRole");
        $rows = $scriptedRoleModel->findAll();

        $data = [
            'title' => $title,
            'results' => $rows,
        ];

        return view('admin/scripted-access-right', $data);
    }

    public function do_add() {
        $name = $this->request->getVar("name");
        $script = $this->request->getVar("script");
        $scriptedRoleModel = model("ScriptedRole");

        $row = $scriptedRoleModel->where(['name' => $name])->first();
        if(!$row){
            $data = [
                'name' => $name,
                'script' => $script,
            ];
            $scriptedRoleModel->insert($data);
        }

        return redirect()->to(site_url("/admin/scripted-access-right"));
    }

    public function do_delete($id = null){
        $scriptedRoleModel = model("ScriptedRole");
        $row = $scriptedRoleModel->find($id);
       
        if($row){
            // dd($row);
            // $scriptedRoleModel->delete($id);
            // dd($id);
            $scriptedRoleModel->where('id =', $id);
            $scriptedRoleModel->where('name <>', 'Administrator');
            $scriptedRoleModel->delete();
        }
        return redirect()->to(site_url("/admin/scripted-access-right"));
    }
}
