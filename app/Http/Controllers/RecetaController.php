<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RecetaController extends Controller
{
    public function index()
    {
        // Obtener todas las recetas con su autor y ordenarlas por fecha
        $recetas = Receta::with('autor')->latest()->get();

        // Datos para la gráfica: conteo de recetas por cada usuario con rol 'Cocinero'
        $cocineros = User::where('rol', 'Cocinero')
            ->withCount('recetas')
            ->get();

        // Renderiza la vista de listado pasando recetas y datos de cocineros
        return view('recetas.index', compact('recetas', 'cocineros'));
    }

    public function create()
    {
        // Muestra el formulario para crear una nueva receta
        return view('recetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => ['required', 'string', 'max:191'],
            'ingredientes' => ['required', 'string'],
            'pasos'        => ['required', 'string'],
        ]);

        // Crea la receta y asigna el user_id del usuario autenticado
        Receta::create([
            'titulo'       => $request->titulo,
            'ingredientes' => $request->ingredientes,
            'pasos'        => $request->pasos,
            'user_id'      => Auth::id(),
        ]);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('recetas.index')
            ->with('success', 'Receta creada exitosamente.');
    }

    public function show(Receta $receta)
    {
        // Muestra una sola receta
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

        // Actualiza solo los campos permitidos de la receta
        $receta->update($request->only('titulo', 'ingredientes', 'pasos'));

        // Redirige al listado con mensaje de confirmación
        return redirect()->route('recetas.index')
            ->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy(Receta $receta)
    {
        // Elimina la receta de la base de datos
        $receta->delete();

        // Redirige al listado con mensaje de éxito
        return redirect()->route('recetas.index')
            ->with('success', 'Receta eliminada.');
    }


    public function pdf(Receta $receta)
    {
        // Genera y descarga un PDF con la receta
        $pdf = Pdf::loadView('recetas.pdf', compact('receta'));
        return $pdf->download('receta-' . $receta->id . '.pdf');
    }
}
