<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BansosWarga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'bansos_warga_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bansos_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'bansos_warga_nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'desa_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true
            ],
            'warga_rt_rw' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'warga_usia' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' => 0
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => '1',
                'default' => 0
            ],
        ]);
        $this->forge->addKey('bansos_warga_id', true);
        $this->forge->addForeignKey('bansos_warga_nik', 'warga', 'warga_nik','CASCADE','CASCADE');
        $this->forge->addForeignKey('bansos_id', 'bansos', 'bansos_id','CASCADE','CASCADE');
        $this->forge->addForeignKey('desa_id', 'desa', 'desa_id','CASCADE','CASCADE');
        $this->forge->createTable('bansos_warga');
    }

    public function down()
    {
        $this->forge->dropTable('bansos_warga');
    }
}
