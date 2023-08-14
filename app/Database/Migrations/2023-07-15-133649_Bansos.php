<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bansos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'bansos_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true
            ],
            'bansos_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('bansos_id', true);
        $this->forge->addForeignKey('jenis_id', 'jenis_bansos', 'jenis_id','CASCADE','CASCADE');
        $this->forge->createTable('bansos');
    }

    public function down()
    {
        $this->forge->dropTable('bansos');
    }
}
