<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receta;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * Obtener estadísticas del sistema
     */
    public function getStatistics(): JsonResponse
    {
        // Totales
        $totalUsers = User::count();
        $chefCount = User::where('rol', 'Cocinero')->count();
        $assistantCount = User::where('rol', 'Asistente')->count();
        $adminCount = User::where('rol', 'Admin')->count();
        $totalRecipes = Receta::count();

        // Usuarios recientes (últimos 5)
        $recentUsers = User::orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'rol' => $user->rol,
                    'created_at' => $user->created_at->format('d/m/Y H:i'),
                ];
            });

        // Registros por mes (últimos 6 meses)
        $monthlyRegistrations = DB::table('users')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => \Carbon\Carbon::createFromFormat('Y-m', $item->month)->format('M'),
                    'count' => $item->count,
                ];
            });

        return response()->json([
            'totalUsers' => $totalUsers,
            'chefCount' => $chefCount,
            'assistantCount' => $assistantCount,
            'adminCount' => $adminCount,
            'totalRecipes' => $totalRecipes,
            'recentUsers' => $recentUsers,
            'monthlyRegistrations' => $monthlyRegistrations,
        ]);
    }
}
