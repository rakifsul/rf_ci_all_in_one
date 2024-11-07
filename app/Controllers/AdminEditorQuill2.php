<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminEditorQuill2 extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - Editor Quill2 JS";

        $editorContentModel = model('EditorContent');
        $row = $editorContentModel->where(['variant' => 'quill2'])->first();

        $data = [
            'title' => $title,
            'content' => $row['content'] ?? "",
        ];

        return view('admin/editor-quill2', $data);
    }

    public function do_update()
    {
        $request = \Config\Services::request();
        $content = $request->getPost('content');
        // dd($content);

        $editorContentModel = model('EditorContent');

        $row = $editorContentModel->where(['variant' => 'quill2'])->first();
        if($row){
            $editorContentModel->where('variant', 'quill2')->set('content', $content)->update();
        } else {
            $data = [
                'variant' => 'quill2',
                'content' => $content,
            ];
            
            $id = $editorContentModel->insert($data);
        }

        return redirect()->to(site_url('/admin/editor-quill2'));
    }
}
