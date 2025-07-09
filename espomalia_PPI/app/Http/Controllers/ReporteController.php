<?php

namespace App\Http\Controllers;

use App\Models\Reportes;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportes = Reportes::paginate();
            return view('reportes.index', compact('reportes'));
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
            'id' => 'required|numeric|unique:reportes,id',
            'tituloReporte' => 'required',
            'descripcion' => 'required',
            'fechaEmision' => 'required|date',
        ]);

        Reportes::create($request->all());
        return redirect()->route('reportes.index')->with('success', 'Reporte creado correctamente.');
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
        $reporte = Reportes::findOrFail($id);

        $request->validate([
            'id' => 'required|numeric|unique:reportes,id,' . $reporte->id,
            'tituloReporte' => 'required',
            'descripcion' => 'required',
            'fechaEmision' => 'required|date',
        ]);

        // Si el ID fue cambiado, crea uno nuevo y elimina el anterior
        if ($request->id != $reporte->id) {
            $reporte->fill($request->except('id'));
            $reporte->save();
            $newData = $reporte->toArray();
            $newData['id'] = $request->id;
            Reportes::create($newData);
            $reporte->delete();
        } else {
            $reporte->update($request->all());
        }

        return redirect()->route('reportes.index')->with('success', 'Reporte actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reporte = Reportes::findOrFail($id);
        $reporte->delete();
        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado correctamente.');
    }
}
