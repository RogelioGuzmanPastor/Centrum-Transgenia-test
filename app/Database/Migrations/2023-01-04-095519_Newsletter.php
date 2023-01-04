<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Newsletter extends Migration
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
			'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',	
            ],
            
			'creado datetime default current_timestamp',


        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('newsletter');
	}

	public function down()
	{
		$this->forge->dropTable('newsletter');
	}
}
