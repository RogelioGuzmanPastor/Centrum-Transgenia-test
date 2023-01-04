<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_token'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 12,
                // 'unsigned'       => true,                
            ],
            'sup'       => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default'		=> 0,
            ],
            'faccion'       => [
                'type'           => 'INT',
                'constraint'     => 10,                
                'unsigned'       => true, 
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
				'unique'     => TRUE
            ],
            'nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',			
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
				'unique'     => TRUE
            ],
            'password' => [
				'type' => 'VARCHAR',
				'constraint' => '60',                
            ],			
            'token' => [
				'type' => 'VARCHAR',
				'constraint' => '255',                
            ],			
            'imagen' => [
				'type' => 'TEXT',                
				'null' => true,
            ],			
			'activo'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'unsigned'       => true,                
				'default'		=> 1,
            ],
			'type'   => [
				'type' 			=> 'ENUM',
				'constraint'    => ['administrador','usuario','down'],
				'default'		=> 'usuario',

			],

			'creado datetime default current_timestamp',
			'editado datetime default current_timestamp',

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
