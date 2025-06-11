<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $fillable = ["id","fechaAsignacion","estado","cedulaUsuario","idRol"];

}
