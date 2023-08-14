<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Warga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'warga_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'desa_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true
            ],
            'warga_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'warga_nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ],
            'warga_rt_rw' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'warga_jk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'warga_usia' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' => 0
            ],
        ]);
        $this->forge->addKey('warga_id', true);
        $this->forge->addForeignKey('desa_id', 'desa', 'desa_id','CASCADE','CASCADE');
        $this->forge->createTable('warga');
    }

    public function down()
    {
        $this->forge->dropTable('warga');
    }
}
