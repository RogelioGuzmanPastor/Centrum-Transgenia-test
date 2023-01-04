<?php

namespace App\Models;

use CodeIgniter\Model;

class DatosModel extends Model
{
    protected $table = 'datos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','telefono','email','company','servicio','rango'];

}