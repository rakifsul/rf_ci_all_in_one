<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use \App\Helpers\G;

class AdminAttachment2 extends BaseController
{
    // Index Methods Alternatives.
    public function index()
    {
        return $this->getAttachmentsWithTagsMethod5();
    }

    // with query builder
    // with pagination
    // with tag
    // with search
    // with tags array column
    function getAttachmentsWithTagsMethod5(){
        //
        $title = "CI CRUD - Attachments2";

        //
        $request = \Config\Services::request();
        $db = \Config\Database::connect();

        $sq = $request->getGet("sq");
        $tag = $request->getGet("tag");
        $page = $request->getGet("page");
        $page = max(0, $page ?? 0);
        $perPage = 2; // setting
        $data;
        $sql;
        $results;

        //
        if($tag) {
            $attachmentModel = model("Attachment");

            //
            $results = $attachmentModel->select('attachments.id, attachments.title, attachments.path, GROUP_CONCAT(tags.name SEPARATOR ", ") AS tags')
            ->join('attachmenttags', 'attachments.id = attachmenttags.attachment_id', 'left')
            ->join('tags', 'attachmenttags.tag_id = tags.id', 'left')
            ->where('tags.name', $tag)
            ->groupBy('attachments.id')
            ->limit((int)$perPage, (int)$page * (int)$perPage)
            ->get()
            ->getResult();

            foreach ($results as &$result) {
                $tags = $attachmentModel->select('tags.name')
                    ->join('attachmenttags', 'attachments.id = attachmenttags.attachment_id', 'left')
                    ->join('tags', 'attachmenttags.tag_id = tags.id', 'left')
                    ->where('attachments.id', $result->id)
                    ->groupBy('tags.id')
                    ->get()
                    ->getResultArray();
                
                // Tambahkan tags ke setiap attachment
                $result->tags = implode(',', array_column($tags, 'name'));
            }

            //
            $count = $attachmentModel->select('attachments.id, attachments.title, attachments.path, GROUP_CONCAT(tags.name SEPARATOR ", ") AS tags')
            ->join('attachmenttags', 'attachments.id = attachmenttags.attachment_id', 'left')
            ->join('tags', 'attachmenttags.tag_id = tags.id', 'left')
            ->where('tags.name', $tag)
            ->groupBy('attachments.id')
            ->countAllResults();
        } 
        else if($sq) {
            $attachmentModel = model("Attachment");
            
            //
            $results = $attachmentModel->select('attachments.id, attachments.title, attachments.path, GROUP_CONCAT(tags.name) AS tags')
            ->join('attachmenttags', 'attachments.id = attachmenttags.attachment_id', 'left')
            ->join('tags', 'attachmenttags.tag_id = tags.id', 'left')
            ->groupStart()
            ->like('attachments.title', $sq)
            ->orLike('attachments.path', $sq)
            ->groupEnd()
            ->groupBy('attachments.id')
            ->limit((int)$perPage, (int)$page * (int)$perPage)
            ->get()
            ->getResult();

            //
            $count = $attachmentModel->select('attachments.id, attachments.title, attachments.path, GROUP_CONCAT(tags.name) AS tags')
            ->join('attachmenttags', 'attachments.id = attachmenttags.attachment_id', 'left')
            ->join('tags', 'attachmenttags.tag_id = tags.id', 'left')
            ->groupStart()
            ->like('attachments.title', $sq)
            ->orLike('attachments.path', $sq)
            ->groupEnd()
            ->groupBy('attachments.id')
            ->countAllResults();
        } 
        else {
            $attachmentModel = model("Attachment");
            
            //
            $results = $attachmentModel->select("attachments.id, attachments.title, attachments.path, GROUP_CONCAT(tags.name) AS tags")
            ->join("attachmenttags", "attachments.id = attachmenttags.attachment_id", "left")
            ->join("tags", "attachmenttags.tag_id = tags.id", "left")
            ->groupBy("attachments.id")
            ->limit((int)$perPage, (int)$page * (int)$perPage)
            ->get()
            ->getResult();

            //
            $count = $attachmentModel->select("attachments.id, attachments.title, attachments.path, GROUP_CONCAT(tags.name) AS tags")
            ->join("attachmenttags", "attachments.id = attachmenttags.attachment_id", "left")
            ->join("tags", "attachmenttags.tag_id = tags.id", "left")
            ->groupBy("attachments.id")
            ->countAllResults();
        }

        //
        $allFiles = [];
        $counter = 0;
        foreach ($results as $row) {
            $allFiles[$counter]["id"] = $row->id;
            $allFiles[$counter]["title"] = $row->title;
            $allFiles[$counter]["path"] = $row->path;
            $allFiles[$counter]["tags"] = $row->tags;
            
            $counter++;
        }

        //
        $sql = "SELECT * FROM tags";
        $query = $db->query($sql);
        $results = $query->getResult();

        $allTags = [];
        $counter = 0;
        foreach($results as $row) {
            $allTags[$counter] = $row->name;

            $counter++;
        }

        $data = [
            'title' => $title,
            'resultTags' => $allTags,
            'resultFiles' => $allFiles,
            'tag' => $tag,
            'sq' => $sq,
            'pagination'=> [
                'page' => $page,
                'perPage' => $perPage,
                'pageCount' => ceil($count/$perPage),
            ],
        ];

        return view('admin/attachment2', $data);
    }

    // with pagination
    // with tag
    // with search
    // with tags array column
    function getAttachmentsWithTagsMethod4(){
        //
        $title = "CI CRUD - Attachments2";

        //
        $request = \Config\Services::request();
        $db = \Config\Database::connect();

        $sq = $request->getGet("sq");
        $tag = $request->getGet("tag");
        $page = $request->getGet("page");
        $page = max(0, $page ?? 0);
        $perPage = 5; // setting
        $data;
        $sql;
        $results;

        //
        if($tag) {
            $sql = "SELECT a.id, a.title, a.path, GROUP_CONCAT(t.name) AS tags
                    FROM attachments a
                    LEFT JOIN attachmenttags at ON a.id = at.attachment_id
                    LEFT JOIN tags t ON at.tag_id = t.id
                    WHERE t.name = ?
                    GROUP BY a.id
                    LIMIT ? OFFSET ?";
            $query = $db->query($sql, [$tag, (int)$perPage, (int)$page * (int)$perPage]);
            $results = $query->getResult();
            // dd($results);

            $sql = "SELECT a.id, a.title, a.path, GROUP_CONCAT(t.name) AS tags
                    FROM attachments a
                    LEFT JOIN attachmenttags at ON a.id = at.attachment_id
                    LEFT JOIN tags t ON at.tag_id = t.id
                    WHERE t.name = ?
                    GROUP BY a.id";
            $query = $db->query($sql, [$tag]);
            $count = $query->getNumRows();

            // dd($sql);

        } 
        else if($sq) {
            // $sql = "SELECT * FROM attachments WHERE (title LIKE '%$sq%') OR (path LIKE '%$sq%') LIMIT ? OFFSET ?";
            $sql = "SELECT a.id, a.title, a.path, GROUP_CONCAT(t.name) AS tags
            FROM attachments a
            LEFT JOIN attachmenttags at ON a.id = at.attachment_id
            LEFT JOIN tags t ON at.tag_id = t.id
            WHERE (a.title LIKE '%$sq%') OR (a.path LIKE '%$sq%')
            GROUP BY a.id
            LIMIT ? OFFSET ?";

            $query = $db->query($sql, [(int)$perPage, (int)$page * (int)$perPage]);
            $results = $query->getResult();

            $sql = "SELECT a.id, a.title, a.path, GROUP_CONCAT(t.name) AS tags
            FROM attachments a
            LEFT JOIN attachmenttags at ON a.id = at.attachment_id
            LEFT JOIN tags t ON at.tag_id = t.id
            WHERE (a.title LIKE '%$sq%') OR (a.path LIKE '%$sq%')
            GROUP BY a.id";
            $query = $db->query($sql);
            $count = $query->getNumRows();

            // dd($sql);
        } 
        else {
            $sql = "SELECT a.id, a.title, a.path, GROUP_CONCAT(t.name) AS tags
            FROM attachments a
            LEFT JOIN attachmenttags at ON a.id = at.attachment_id
            LEFT JOIN tags t ON at.tag_id = t.id
            GROUP BY a.id
            LIMIT ? OFFSET ?";

            $query = $db->query($sql, [(int)$perPage, (int)$page * (int)$perPage]);
            $results = $query->getResult();
            // dd($results);

            $sql = "SELECT a.id, a.title, a.path, GROUP_CONCAT(t.name) AS tags
            FROM attachments a
            LEFT JOIN attachmenttags at ON a.id = at.attachment_id
            LEFT JOIN tags t ON at.tag_id = t.id
            GROUP BY a.id";
            $query = $db->query($sql);
            $count = $query->getNumRows();

            // dd($sql);
        }

        //
        $allFiles = [];
        $counter = 0;
        foreach ($results as $row) {
            $allFiles[$counter]["id"] = $row->id;
            $allFiles[$counter]["title"] = $row->title;
            $allFiles[$counter]["path"] = $row->path;
            $allFiles[$counter]["tags"] = $row->tags;
            
            $counter++;
        }

        //
        $sql = "SELECT * FROM tags";
        $query = $db->query($sql);
        $results = $query->getResult();

        $allTags = [];
        $counter = 0;
        foreach($results as $row) {
            $allTags[$counter] = $row->name;

            $counter++;
        }

        $data = [
            'title' => $title,
            'resultTags' => $allTags,
            'resultFiles' => $allFiles,
            'tag' => $tag,
            'sq' => $sq,
            'pagination'=> [
                'page' => $page,
                'perPage' => $perPage,
                'pageCount' => ceil($count/$perPage),
            ],
        ];

        return view('admin/attachment2', $data);
    }

    // Upload Methods Alternatives.
    public function do_upload() {
        $parsedBody = $this->request->getVar();
        $editId = $parsedBody["editId"] ?? null;

        if(isset($editId)){
            return $this->uploadEditMethod0();
            // dd($editId);
        } else {
            return $this->uploadMethod0();
        }
    }

    function uploadMethod1()
    {
        // upload
        $img = $this->request->getFile('upload');
        if (! $img->hasMoved()) {
            $img->move("assets/img");
        }

        // store data to db
        $parsedBody = $this->request->getVar();
        $title = $parsedBody["title"];
        $rawTags = $parsedBody["tags"];
        $path = "assets/img" . "/" . $img->getName();
        $finalTags = explode(",", $rawTags);
        $finalTags = array_filter($finalTags);

        // Insert the attachment data
        $imageModel = model('Attachment');
        $data = [
            'title' => $title,
            'path'  => $path,
        ];

        $imageId = $imageModel->insert($data);

        // Process tags in bulk to reduce DB queries
        $tagModel = model('Tag');
        
        // Get all existing tags in one query
        $existingTags = $tagModel->whereIn('name', $finalTags)->findAll();

        // Extract existing tag names and ids
        $existingTagNames = array_column($existingTags, 'name');
        $existingTagIds = array_column($existingTags, 'id', 'name');

        // Prepare new tags to be inserted (those not in existing tags)
        $newTags = array_diff($finalTags, $existingTagNames);

        // Insert new tags in bulk
        if (!empty($newTags)) {
            $newTagData = [];
            foreach ($newTags as $newTag) {
                $newTagData[] = ['name' => $newTag];
            }
            $tagModel->insertBatch($newTagData);

            // Fetch the newly inserted tags
            $insertedTags = $tagModel->whereIn('name', $newTags)->findAll();

            // Add new tags to the existing tag list
            foreach ($insertedTags as $insertedTag) {
                $existingTagIds[$insertedTag['name']] = $insertedTag['id'];
            }
        }

        // Now insert into the pivot table
        $imageTagModel = model('AttachmentTag');
        $attachmentTagData = [];
        foreach ($finalTags as $finalTag) {
            $attachmentTagData[] = [
                'attachment_id' => $imageId,
                'tag_id'        => $existingTagIds[$finalTag],
            ];
        }
        
        // Insert all attachment-tag relations in one query
        $imageTagModel->insertBatch($attachmentTagData);

        return redirect()->to(site_url('/admin/attachment2'));
    }


    function uploadMethod0()
    {
        // upload
        $img = $this->request->getFile('upload');

        if (! $img->hasMoved()) {
            $img->move("assets/img");
        }

        // store data to db
        $parsedBody = $this->request->getVar();
        
        $title = $parsedBody["title"];
        $rawTags = $parsedBody["tags"];
        $path123 = "assets/img"."/".$img->getName();

        $finalTags = explode(",", $rawTags);
        $finalTags = array_filter($finalTags);

        $imageModel = model('Attachment');
        
        $data = [
            'title' => $title,
            'path' => $path123,
        ];
        
        $imageid = $imageModel->insert($data);

        foreach($finalTags as $finalTag) {
            $tagModel = model('Tag');

            $tagsWhereName = $tagModel->where(['name' => $finalTag])->get()->getResultArray();

            $isUnique = count($tagsWhereName) <= 0;

            $tagId;
            if ($isUnique) {
                $data = [
                    'name' => $finalTag,
                ];
                
                $tagId = $tagModel->insert($data);
            } else {
                $tagId = $tagsWhereName[0]['id'];
            }

            $imageTagModel = model('AttachmentTag');

            $data = [
                'attachment_id' => $imageid,
                'tag_id' => $tagId,
            ];
            $tagId = $imageTagModel->insert($data);
        }

        return redirect()->to(site_url('/admin/attachment2'));
    }

    function uploadEditMethod0()
    {
        //
        $parsedBody = $this->request->getVar();
        $editId = $parsedBody["editId"];

        // upload edit
        // store data to db
        $title = $parsedBody["title"];
        $rawTags = $parsedBody["tags"];
        $finalTags = explode(",", $rawTags);
        $finalTags = array_filter($finalTags);
        $imageModel = model('Attachment');
        $willBeDeleted = $imageModel->find($editId);
        $img = $this->request->getFile('upload');
        $path123;
        if(!empty($_FILES['upload']['name'])){
            if (! $img->hasMoved()) {
                $img->move("assets/img");
            }
            $path123 = "assets/img"."/".$img->getName();

            $data = [
                'title' => $title,
                'path' => $path123,
            ];
            
            $imageModel->where('id', $editId);
            $imageModel->set('title', $title);
            $imageModel->set('path', $path123);
        } else {
            $imageModel->where('id', $editId);
            $imageModel->set('title', $title);
        }
        $imageModel->update();
        $imageId = $editId;

        //
        $imageTagModel = model('AttachmentTag');
        $tagModel = model('Tag');

        //
        $imageTagModel->where('attachment_id', $imageId)->delete();

        //
        $allTags = $tagModel->findAll();
        foreach($allTags as $tag){
            $filetagsWhereId = $imageTagModel->where(['tag_id' => $tag["id"]])->get()->getResultArray();;

            if (count($filetagsWhereId) <= 0) {
                $tagModel->where(['id' => $tag["id"]])->delete();
            }
        }

        //
        foreach($finalTags as $finalTag) {
            //
            $tagsWhereName = $tagModel->where(['name' => $finalTag])->get()->getResultArray();
            $tagNeverExist = count($tagsWhereName) <= 0;
            $tagId;
            if ($tagNeverExist) {
                $data = [
                    'name' => $finalTag,
                ];
                
                $tagId = $tagModel->insert($data);
            } else {
                $tagId = $tagsWhereName[0]['id'];
            }

            //
            $data = [
                'attachment_id' => $imageId,
                'tag_id' => $tagId,
            ];
            $tagId = $imageTagModel->insert($data);
        }

        if(!empty($_FILES['upload']['name'])){
            unlink(realpath($willBeDeleted["path"]));
        }
        return redirect()->to(site_url('/admin/attachment2'));
    }

    // Delete Methods Alternatives.
    public function do_delete($id = null){
        return $this->deleteMethod1($id);
    }

    function deleteMethod1($id = null)
    {
        // Mulai transaksi untuk memastikan integritas data
        $db = \Config\Database::connect();
        $db->transStart();

        // Model declarations
        $imageModel = model('Attachment');
        $imageTagModel = model('AttachmentTag');
        $tagModel = model('Tag');

        // Cari data attachment yang akan dihapus
        $willBeDeleted = $imageModel->find($id);

        // Hapus attachment
        $imageModel->delete($id);

        // Hapus data dari pivot table (AttachmentTag) untuk attachment ini
        $imageTagModel->where('attachment_id', $id)->delete();

        // Ambil semua tag yang berhubungan dengan attachment yang dihapus
        $relatedTags = $imageTagModel->select('tag_id')->groupBy('tag_id')->findAll();
        $relatedTagIds = array_column($relatedTags, 'tag_id');

        // Cari tag yang tidak lagi memiliki hubungan dengan attachment
        if (!empty($relatedTagIds)) {
            $unusedTags = $tagModel->whereNotIn('id', $relatedTagIds)->findAll();

            // Hapus tag yang tidak memiliki hubungan dengan attachment lainnya
            if (!empty($unusedTags)) {
                $unusedTagIds = array_column($unusedTags, 'id');
                $tagModel->whereIn('id', $unusedTagIds)->delete();
            }
        } else {
            $tagModel->whereNotIn('id', [-1])->delete();
        }

        // Hapus file fisik attachment dari server
        if (file_exists($willBeDeleted['path'])) {
            unlink(realpath($willBeDeleted['path']));
        }

        // Commit transaction
        $db->transComplete();

        // Redirect ke halaman admin attachment
        return redirect()->to(site_url('/admin/attachment2'));
    }


    function deleteMethod0($id = null)
    {
        $imageModel = model('Attachment');
        $willBeDeleted = $imageModel->find($id);
        $imageModel->delete($id);

        $imageTagModel = model("AttachmentTag");
        $imageTagModel->where(['attachment_id' => $id])->delete();

        $tagModel = model("Tag");
        $allTags = $tagModel->findAll();

        foreach($allTags as $tag){
            $imageTagModel = model("AttachmentTag");
            $filetagsWhereId = $imageTagModel->where(['tag_id' => $tag["id"]])->get()->getResultArray();;

            if (count($filetagsWhereId) <= 0) {
                $tagModel = model("Tag");
                $tagModel->where(['id' => $tag["id"]])->delete();
            }
        }

        unlink(realpath($willBeDeleted["path"]));
        
        return redirect()->to(site_url('/admin/attachment2'));
    }

    public function do_download($id)
    {
        $imageModel = model("Attachment");
        $found = $imageModel->find($id);

        $file = realpath($found["path"]);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: '.filesize($file));
            readfile($file);
            exit;
        }

        return redirect()->to(site_url('/admin/attachment2'));
    }
}
