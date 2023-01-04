<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersNotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','token'];
  
}