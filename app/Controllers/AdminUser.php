<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminUser extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - User Access";

        //
        $staticUserARTest = $this->doesCurrentSTARHaveAccess();
        $scriptedUserARTest = $this->doesCurrentSARHaveAccess();
        // dd([$staticUserARTest, $scriptedUserARTest]);
        if(!($staticUserARTest == true && $scriptedUserARTest == true)) {
            return redirect()->to(site_url("/admin"));
        }

        //
        $data = [
            'title' => $title,
        ];
        return view('admin/user-access', $data);
    }

    function doesCurrentSTARHaveAccess(){
        return session()->get("static_role") == "user";
    }

    function doesCurrentSARHaveAccess(){
        $scriptedRoleModel = model("ScriptedRole");
        $row = $scriptedRoleModel->where(['id' => session()->get("scripted_role_id")])->first();
        if(!$row){
            return false;
        }
        // dd($row);
        $arr = eval($row["script"]);
        return in_array("http://no-cms.test/rf_ci_crud_template/public/admin/user-access", $arr);
    }
}
