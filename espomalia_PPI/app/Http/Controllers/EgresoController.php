<?php

namespace App\Http\Controllers;

use App\Models\Egresos;
use Illuminate\Http\Request;

class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $egresos = Egresos::paginate();
            return view('egresos.index', compact('egresos'));
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
            'id' => 'required|numeric|unique:egresos,id',
            'cantidad' => 'required',
            'fechaEgreso' => 'required|date',
            'idProducto' => 'required',
            'codigoInventario' => 'required',
        ]);

        Egresos::create($request->all());
        return redirect()->route('egresos.index')->with('success', 'Egreso creado correctamente.');
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
        $egreso = Egresos::findOrFail($id);

        $request->validate([
            'id' => 'required|numeric|unique:egresos,id,' . $egreso->id,
            'cantidad' => 'required',
            'fechaEgreso' => 'required|date',
            'idProducto' => 'required',
            'codigoInventario' => 'required',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $egreso->id) {
            $egreso->fill($request->except('id'));
            $egreso->save();
            $newData = $egreso->toArray();
            $newData['id'] = $request->id;
            Egresos::create($newData);
            $egreso->delete();
        } else {
            $egreso->update($request->all());
        }

        return redirect()->route('egresos.index')->with('success', 'Egreso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $egreso = Egresos::findOrFail($id);
        $egreso->delete();
        return redirect()->route('egresos.index')->with('success', 'Egreso eliminado correctamente.');
    }
}
