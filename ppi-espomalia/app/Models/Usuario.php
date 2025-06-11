<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ["cedula","usuario","contrasenia","nombres",
    "apellidos","correo","direccion","telefono"];
}
