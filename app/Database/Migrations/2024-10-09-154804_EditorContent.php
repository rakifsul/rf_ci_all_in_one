<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditorContent extends Migration
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
            'variant' => [
                'type' => 'TEXT',
            ],
            'content' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('editorcontents');
    }

    public function down()
    {
        //
        $this->forge->dropTable('editorcontents');
    }
}
