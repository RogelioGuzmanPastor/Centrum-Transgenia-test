<?php

namespace App\Models;

use CodeIgniter\Model;

class RecoveryModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['token', 'password'];

  
}