<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualizacionesModel extends Model
{
    protected $table = 'actualizaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['creador_token_id','titulo','version','actualizacion','editado','color'];

}