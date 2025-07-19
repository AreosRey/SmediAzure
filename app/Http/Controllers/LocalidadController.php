<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Municipio;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $localidades = Localidad::with('municipio')->orderBy('localidad')->get();
        return view('localidades.index', compact('localidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipios = Municipio::orderBy('municipio')->get();
        return view('localidades.create', compact('municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'localidad' => 'required|string|max:255|unique:localidades,localidad',
            'id_municipio' => 'required|exists:municipios,id_municipio',
        ]);

        Localidad::create($validated);

        return redirect()->route('localidades.index')
                         ->with('success', 'Localidad creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $localidad = Localidad::with('municipio')->findOrFail($id);
        return view('localidades.show', compact('localidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);
        $municipios = Municipio::orderBy('municipio')->get();

        return view('localidades.edit', compact('localidad', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $localidad = Localidad::findOrFail($id);

        $validated = $request->validate([
            'localidad' => 'required|string|max:255|unique:localidades,localidad,' . $id . ',id_localidad',
            'id_municipio' => 'required|exists:municipios,id_municipio',
        ]);

        $localidad->update($validated);

        return redirect()->route('localidades.index')
                         ->with('success', 'Localidad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Localidad::findOrFail($id)->delete();

        return redirect()->route('localidades.index')
                         ->with([
                             'success' => 'Localidad eliminada correctamente.',
                             'alert_type' => 'danger'
                         ]);
    }

    /**
     * Optional: Return list as JSON for API purposes.
     */
    public function apiIndex()
    {
        $localidades = Localidad::with('municipio')->get();

        $data = $localidades->map(function ($loc) {
            return [
                'id' => $loc->id_localidad,
                'localidad' => $loc->localidad,
                'municipio' => $loc->municipio->municipio ?? null,
            ];
        });

        return response()->json($data);
    }
}
