<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuarios::paginate();        
        return view('usuarios.index', compact('usuarios'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|digits:10|unique:usuarios,cedula',
            'usuario' => 'required|unique:usuarios,usuario',
            'contrasenia' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'telefono' => 'required|digits:10',
        ]);

        Usuarios::create($request->all());
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
        $usuario = Usuarios::findOrFail($id);

        $request->validate([
            'cedula' => 'required|digits:10|unique:usuarios,cedula,' . $usuario->id,
            'usuario' => 'required|unique:usuarios,usuario,' . $usuario->id,
            'contrasenia' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'telefono' => 'required|digits:10',
        ]);

        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuarios::findOrFail($id);
        $usuario->activo = false;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario desactivado correctamente.');
    }
}
