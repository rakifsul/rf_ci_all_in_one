<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminSetting extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - Setting";

        //
        $scriptRoleModel = model("ScriptedRole");
        $allRoles = $scriptRoleModel->findAll();
        //
        $data = [
            'title' => $title,
            'staticrole' => session()->get("static_role"),
            'scriptedrole' => session()->get("scripted_role_id"),
            'scriptedroles' => $allRoles,
        ];
        return view('admin/setting', $data);
    }

    public function do_apply() {
        $staticRole = $this->request->getPost("staticrole");
        $scriptedRole = $this->request->getPost("scriptedrole");

        $userModel = model("User");
        
        $userModel->where("id", session()->get("id"))->set([
            'static_role'=> $staticRole,
            'scripted_role_id'=> $scriptedRole,
        ])->update();
        session()->set("static_role", $staticRole);
        session()->set("scripted_role_id", $scriptedRole);
        return redirect()->to(site_url("/admin/setting"));
    }
}
