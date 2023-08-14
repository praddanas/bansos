<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kecamatan_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'  => true
            ],
            'user_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'kecamatan_id','CASCADE','CASCADE');
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
