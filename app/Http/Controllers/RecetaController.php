<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::with('autor')->latest()->get();
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        return view('recetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => ['required', 'string', 'max:191'],
            'ingredientes' => ['required', 'string'],
            'pasos'        => ['required', 'string'],
        ]);

        Receta::create([
            'titulo'       => $request->titulo,
            'ingredientes' => $request->ingredientes,
            'pasos'        => $request->pasos,
            'user_id'      => Auth::id(),
        ]);

        return redirect()->route('recetas.index')
            ->with('success', 'Receta creada exitosamente.');
    }

    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    public function edit(Receta $receta)
    {
        return view('recetas.edit', compact('receta'));
    }

    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            'titulo'       => ['required', 'string', 'max:191'],
            'ingredientes' => ['required', 'string'],
            'pasos'        => ['required', 'string'],
        ]);

        $receta->update($request->only('titulo', 'ingredientes', 'pasos'));

        return redirect()->route('recetas.index')
            ->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy(Receta $receta)
    {
        $receta->delete();

        return redirect()->route('recetas.index')
            ->with('success', 'Receta eliminada.');
    }
}
