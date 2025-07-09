<?php

namespace App\Http\Controllers;

use App\Models\Ingresos;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Ingresos::paginate();
            return view('ingresos.index', compact('ingresos'));
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
            'id' => 'required|numeric|unique:ingresos,id',
            'cantidad' => 'required',
            'fechaIngreso' => 'required|date',
            'idProducto' => 'required',
            'codigoInventario' => 'required',
        ]);

        Ingresos::create($request->all());
        return redirect()->route('ingresos.index')->with('success', 'Ingreso creado correctamente.');
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
        $ingreso = Ingresos::findOrFail($id);
        $request->validate([
            'id' => 'required|numeric|unique:ingresos,id,' . $ingreso->id,
            'cantidad' => 'required',
            'fechaIngreso' => 'required|date',
            'idProducto' => 'required',
            'codigoInventario' => 'required',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $ingreso->id) {
            $ingreso->fill($request->except('id'));
            $ingreso->save();
            $newData = $ingreso->toArray();
            $newData['id'] = $request->id;
            Ingresos::create($newData);
            $ingreso->delete();
        } else {
            $ingreso->update($request->all());
        }

        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingreso = Ingresos::findOrFail($id);
        $ingreso->delete();
        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado correctamente.');
    }
}
