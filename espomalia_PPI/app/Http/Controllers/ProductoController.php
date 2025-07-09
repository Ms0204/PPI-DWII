<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Productos::paginate();
            return view('productos.index', compact('productos'));
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
            'id' => 'required|numeric|unique:productos,id',
            'nombre' => 'required',
            'cantidad' => 'required',
        ]);

        Productos::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
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
        $producto = Productos::findOrFail($id);

        $request->validate([
            'id' => 'required|numeric|unique:productos,id,' . $producto->id,
            'nombre' => 'required',
            'cantidad' => 'required',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $producto->id) {
            $producto->fill($request->except('id'));
            $producto->save();
            $newData = $producto->toArray();
            $newData['id'] = $request->id;
            Productos::create($newData);
            $producto->delete();
        } else {
            $producto->update($request->all());
        }
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
