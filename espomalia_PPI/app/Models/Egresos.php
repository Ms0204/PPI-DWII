<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Egresos extends Model
{
    protected $fillable = ["id","cantidad","fechaEgreso",
        "idProducto","codigoInventario"];
}
