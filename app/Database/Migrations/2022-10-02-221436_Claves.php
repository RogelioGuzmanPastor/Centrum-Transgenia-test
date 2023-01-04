<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Claves extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_clave'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
			'type'   => [
				'type' 			=> 'ENUM',
				'constraint'    => ['administrador','usuario','down'],
				'default'		=> 'usuario',

			],
            'clave'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,                
            ],
            'faccion_id'       => [
                'type'           => 'INT',
                'constraint'     => 10,
            ],            
			'creado datetime default current_timestamp',
			'editado datetime default current_timestamp',

        ]);
        $this->forge->addKey('id_clave', true);
        $this->forge->createTable('claves');
	}

	public function down()
	{
		$this->forge->dropTable('claves');
	}
}
