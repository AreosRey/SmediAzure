<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{

    public function index()
    {
        $municipios = Municipio::orderBy('municipio')->get();
        return view('municipio.index', compact('municipios'));
    }

    public function create()
    {
        return view('municipio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'municipio' => 'required|string|max:100|unique:municipios,municipio',
        ]);

        Municipio::create($validated);

        return redirect()->route('municipios.index')->with('success', 'Municipio creado correctamente.');
    }
    public function show(string $id)
    {
        $municipio = Municipio::findOrFail($id);
        return view('municipio.show', compact('municipio'));
    }

    public function edit(string $id)
    {
        $municipio = Municipio::findOrFail($id);
        return view('municipio.edit', compact('municipio'));
    }

    public function update(Request $request, string $id)
    {
        $municipio = Municipio::findOrFail($id);

        $validated = $request->validate([
            'municipio' => 'required|string|max:100|unique:municipios,municipio,' . $municipio->id_municipio . ',id_municipio',
        ]);

        $municipio->update($validated);

        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado correctamente.');
    }


    public function destroy(string $id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();

        return redirect()->route('municipios.index')
                         ->with([
                             'success' => 'Municipio eliminado correctamente.',
                             'alert_type' => 'danger'
                         ]);
    }

    public function apiIndex()
    {
        $municipios = Municipio::orderBy('municipio')->get();

        $data = $municipios->map(function ($m) {
            return [
                'id' => $m->id_municipio,
                'municipio' => $m->municipio,
            ];
        });

        return response()->json($data);
    }
}
