<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::paginate();
            return view('roles.index', compact('roles'));
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
            'id' => 'required|numeric|unique:roles,id',
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Roles::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
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
        $rol = Roles::findOrFail($id);

        $request->validate([
            'id' => 'required|numeric|unique:roles,id,' . $rol->id,
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $rol->id) {
            $rol->fill($request->except('id'));
            $rol->save();
            $newData = $rol->toArray();
            $newData['id'] = $request->id;
            Roles::create($newData);
            $rol->delete();
        } else {
            $rol->update($request->all());
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Roles::findOrFail($id);
        $rol->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
