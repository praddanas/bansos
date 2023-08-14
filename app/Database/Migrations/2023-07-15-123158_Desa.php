<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Desa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'desa_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kecamatan_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true
            ],
            'desa_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('desa_id', true);
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'kecamatan_id','CASCADE','CASCADE');
        $this->forge->createTable('desa');
    }

    public function down()
    {
        $this->forge->dropTable('desa');
    }
}
