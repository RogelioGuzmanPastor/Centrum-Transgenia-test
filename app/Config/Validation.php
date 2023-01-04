<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		// 'list'   => 'CodeIgniter\Validation\Views\list',
		'list'   => 'App\Views\Validations\list_boostraps',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	public $users = [
		'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
		'email' => 'required|min_length[3]|max_length[100]|is_unique[users.email]',
		'password' => 'required|min_length[8]|max_length[20]',
		'nombre' => 'required|min_length[3]|max_length[150]',
	];
	public $users_edit = [	
		'nombre' => 'required|min_length[3]|max_length[150]',		
	];
	public $users_active_notifications = [	
		'user_id' => 'required|min_length[1]|max_length[10]',		
		'token' => 'required|min_length[100]|max_length[200]',		
	];
	public $passwordValidate = [		
		'password' => 'min_length[8]|max_length[20]',
	];
	public $actualizacion = [		
		'titulo' => 'required|min_length[3]',
		'actualizacion' => 'required|min_length[1]',
		'version' => 'required|min_length[1]',
		'color' => 'required|min_length[1]',
	];
	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
