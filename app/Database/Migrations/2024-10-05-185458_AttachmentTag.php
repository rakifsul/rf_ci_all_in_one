<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AttachmentTag extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'attachment_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'tag_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('attachmenttags');
    }

    public function down()
    {
        //
        $this->forge->dropTable('attachmenttags');
    }
}
