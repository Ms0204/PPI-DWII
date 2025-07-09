<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pagos::paginate();
            return view('pagos.index', compact('pagos'));
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
            "id" => "required|numeric|unique:pagos,id",
            "numeroPago" => "required",
            "metodoPago" => "required",
            "cantidad" => "required|numeric",
            "fechaPago" => "required|date",
            "cedulaUsuario" => "required|digits:10"
        ]);

        Pagos::create($request->all());
        return redirect()->route('pagos.index')->with('success', 'Pago creado correctamente.');
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
        $pago = Pagos::findOrFail($id);

        $request->validate([
            "id" => "required|numeric|unique:pagos,id," . $pago->id,
            "numeroPago" => "required",
            "metodoPago" => "required",
            "cantidad" => "required|numeric",
            "fechaPago" => "required|date",
            "cedulaUsuario" => "required|digits:10"
        ]);

        // Si el ID fue cambiado, actualiza manualmente
        if ($request->id != $pago->id) {
            $pago->fill($request->except('id'));
            $pago->save();
            // Crear nuevo registro con el nuevo ID y eliminar el anterior
            $newData = $pago->toArray();
            $newData['id'] = $request->id;
            Pagos::create($newData);
            $pago->delete();
        } else {
            $pago->update($request->all());
        }

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pago = Pagos::findOrFail($id);
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
    }
}
