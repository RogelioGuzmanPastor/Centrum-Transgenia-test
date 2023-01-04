<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersCreateModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','id_token', 'username', 'email', 'password', 'imagen', 'type'];

  
}