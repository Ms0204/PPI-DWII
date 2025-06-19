<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::paginate();
            return view("usuarios.index", ["usuarios"=> $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return "holi";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'cedula' => "required","numeric","digits:10",
            'usuario' => "required","string","min:8","max:15",
            'password' => "required","string","min:8","max:15",
            'nombres' => "required","string","min:8","max:30",
            'apellidos' => "required","string","min:10","max:20",
            'correo' => "required","email" ,"min:15",
            'direccion' => "required","string","min:8","max:60",
            'telefono' => "required","numeric","digits:10",
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
