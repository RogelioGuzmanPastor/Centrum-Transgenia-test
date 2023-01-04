<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Actualizaciones extends Migration
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
			'creador_token_id'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 12,
            ],
            'titulo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',			
            ],
			
            'version'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',			
            ],
            'color'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',			
            ],
            'actualizacion'       => [
                'type'       => 'TEXT',                
            ],

			'creado datetime default current_timestamp',
			'editado datetime default current_timestamp',

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('actualizaciones');
	}

	public function down()
	{
		$this->forge->dropTable('actualizaciones');
	}
}
