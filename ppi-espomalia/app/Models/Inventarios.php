<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    protected $fillable = ["codigo","tipoMovimiento","fechaRegistro","cantidadProductos",
    "cedulaUsuario"];
}
