<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminSuperUser extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - SuperUser Access";

        //
        $staticSuperUserARTest = $this->doesCurrentSTARHaveAccess();
        $scriptedSuperUserARTest = $this->doesCurrentSARHaveAccess();
        // dd([$staticUserARTest, $scriptedUserARTest]);
        if(!($staticSuperUserARTest == true && $scriptedSuperUserARTest == true)) {
            return redirect()->to(site_url("/admin"));
        }

        //
        $data = [
            'title' => $title,
        ];
        return view('admin/superuser-access', $data);
    }

    function doesCurrentSTARHaveAccess(){
        return session()->get("static_role") == "superuser";
    }

    function doesCurrentSARHaveAccess(){
        $scriptedRoleModel = model("ScriptedRole");
        $row = $scriptedRoleModel->where(['id' => session()->get("scripted_role_id")])->first();
        if(!$row){
            return false;
        }
        // dd($row);
        $arr = eval($row["script"]);
        return in_array("http://no-cms.test/rf_ci_crud_template/public/admin/superuser-access", $arr);
    }
}
