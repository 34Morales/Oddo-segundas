<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StockMovementController;
use App\Http\Controllers\Api\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas de autenticación
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// Rutas protegidas con JWT
Route::middleware('auth:api')->group(function () {
    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);
    
    // CRUD Resources
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('users', UserController::class);
    
    // Stock Movements (solo index, show y store)
    Route::apiResource('stock-movements', StockMovementController::class)->only(['index', 'store', 'show']);
    
    // Reportes
    Route::prefix('reports')->group(function () {
        Route::get('low-stock', [ReportController::class, 'lowStock']);
        Route::get('movements-summary', [ReportController::class, 'movementsSummary']);
        Route::get('top-products', [ReportController::class, 'topProducts']);
    });
    
    // Dashboard stats
    Route::get('dashboard/stats', function () {
        return response()->json([
            'total_products' => \App\Models\Product::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_movements' => \App\Models\StockMovement::count(),
            'total_users' => \App\Models\User::count(),
            'low_stock_count' => \App\Models\Product::where('stock', '<=', 10)->count(),
        ]);
    });
});