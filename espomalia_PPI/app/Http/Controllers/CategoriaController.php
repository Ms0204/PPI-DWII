<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categorias::paginate();
            return view('categorias.index', compact('categorias'));
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
            'id' => 'required|numeric|unique:categorias,id',
            'nombre' => 'required',
            'descripcion' => 'required',
            'idProducto' => 'required',
        ]);

        Categorias::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
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
        $categoria = Categorias::findOrFail($id);

        $request->validate([
            'id' => 'required|numeric|unique:categorias,id,' . $categoria->id,
            'nombre' => 'required',
            'descripcion' => 'required',
            'idProducto' => 'required',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $categoria->id) {
            $categoria->fill($request->except('id'));
            $categoria->save();
            $newData = $categoria->toArray();
            $newData['id'] = $request->id;
            Categorias::create($newData);
            $categoria->delete();
        } else {
            $categoria->update($request->all());
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categorias::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
