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
            "codigo" => "required|unique:inventarios,codigo",
            "tipoMovimiento" => "required",
            "fechaRegistro" => "required|date",
            "cantidadProductos" => "required|numeric",
            "cedulaUsuario" => "required|digits:10"
        ]);

        Inventarios::create($request->all());
        return redirect()->route('inventarios.index')->with('success', 'Inventario creado correctamente.');
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
        $inventario = Inventarios::findOrFail($id);

        $request->validate([
            "codigo" => "required|unique:inventarios,codigo," . $inventario->id,
            "tipoMovimiento" => "required",
            "fechaRegistro" => "required|date",
            "cantidadProductos" => "required|numeric",
            "cedulaUsuario" => "required|digits:10"
        ]);

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
