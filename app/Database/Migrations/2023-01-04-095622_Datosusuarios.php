<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datosusuarios extends Migration
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
            'nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',			
            ],
            'telefono'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',			
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
				'unique'     => TRUE
            ],
            'company' => [
				'type' => 'VARCHAR',
				'constraint' => '150',				
            ],			
            'servicio' => [
				'type' => 'VARCHAR',
				'constraint' => '255',                
            ],			
            'rango' => [
				'type' => 'VARCHAR',
				'constraint' => '30',                
            ],			
            
			'creado datetime default current_timestamp',

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('datos');
	}

	public function down()
	{
		$this->forge->dropTable('datos');
	}
}
