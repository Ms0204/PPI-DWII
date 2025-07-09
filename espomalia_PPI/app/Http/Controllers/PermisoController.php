<?php

namespace App\Http\Controllers;

use App\Models\Permisos;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permisos::paginate();
            return view('permisos.index', compact('permisos'));
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
            'id' => 'required|numeric|unique:permisos,id',
            'fechaAsignacion' => 'required|date',
            'estado' => 'required',
            'cedulaUsuario' => 'required|numeric',
            'idRol' => 'required|numeric',
        ]);

        Permisos::create($request->all());
        return redirect()->route('permisos.index')->with('success', 'Permiso creado correctamente.');
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
        $permiso = Permisos::findOrFail($id);
        $request->validate([
            
            'id' => 'required|numeric|unique:permisos,id,' . $permiso->id,
            'fechaAsignacion' => 'required|date',
            'estado' => 'required',
            'cedulaUsuario' => 'required|numeric',
            'idRol' => 'required|numeric',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $permiso->id) {
            $permiso->fill($request->except('id'));
            $permiso->save();
            $newData = $permiso->toArray();
            $newData['id'] = $request->id;
            Permisos::create($newData);
            $permiso->delete();
        } else {
            $permiso->update($request->all());
        }

        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permiso = Permisos::findOrFail($id);
        $permiso->delete();
        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
