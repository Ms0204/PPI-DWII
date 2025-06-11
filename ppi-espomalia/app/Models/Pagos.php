<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = ["id","numeroPago","metodoPago","cantidad",
    "fechaPago","cedulaUsuario"];
}
