<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminEditorQuill extends BaseController
{
    public function index()
    {
        //
        $title = "CI CRUD - Editor Quill JS";

        $editorContentModel = model('EditorContent');
        $row = $editorContentModel->where(['variant' => 'quill'])->first();

        $data = [
            'title' => $title,
            'content' => $row['content'] ?? "",
        ];

        return view('admin/editor-quill', $data);
    }

    public function do_update()
    {
        $request = \Config\Services::request();
        $content = $request->getPost('content');
        // dd($content);

        $editorContentModel = model('EditorContent');

        $row = $editorContentModel->where(['variant' => 'quill'])->first();
        if($row){
            $editorContentModel->where('variant', 'quill')->set('content', $content)->update();
        } else {
            $data = [
                'variant' => 'quill',
                'content' => $content,
            ];
            
            $id = $editorContentModel->insert($data);
        }

        return redirect()->to(site_url('/admin/editor-quill'));
    }
}
