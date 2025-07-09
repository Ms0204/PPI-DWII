<?php

namespace App\Http\Controllers;

use App\Models\Inventarios;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventarios::paginate();
        return view("inventarios.index", compact("inventarios"));
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
            'codigo' => ['required', 'numeric', 'min:10000000', 'max:999999999999999'],
            'tipoMovimiento' => ['required', 'string'],
            'fecha_registro' => ['required', 'date'],
            'cantidad_productos' => ['required', 'integer', 'min:1'],
            'cedula_usuario' => ['required', 'digits:10'],
        ]);

        Inventarios::create($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario agregado correctamente.');
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
        $request->validate([
            'codigo' => ['required', 'numeric', 'min:10000000', 'max:999999999999999'],
            'tipoMovimiento' => ['required', 'string'],
            'fecha_registro' => ['required', 'date'],
            'cantidad_productos' => ['required', 'integer', 'min:1'],
            'cedula_usuario' => ['required', 'numeric', 'digits:10'],
        ]);

        $inventario = Inventarios::findOrFail($id);
        $inventario->update($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventario = Inventarios::findOrFail($id);
        $inventario->delete();

        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado correctamente.');
    }
}
