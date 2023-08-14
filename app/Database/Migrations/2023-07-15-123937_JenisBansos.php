<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisBansos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jenis_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('jenis_id', true);
        $this->forge->createTable('jenis_bansos');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_bansos');
    }
}
