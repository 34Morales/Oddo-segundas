<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Reporte de stock bajo
    public function lowStock(Request $request)
    {
        $threshold = $request->get('threshold', 10);
        
        $products = Product::with('category')
            ->where('stock', '<=', $threshold)
            ->orderBy('stock', 'asc')
            ->get();
            
        return response()->json([
            'threshold' => $threshold,
            'count' => $products->count(),
            'products' => $products,
        ]);
    }

    // Reporte de movimientos por período
    public function movementsSummary(Request $request)
    {
        $validator = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $summary = StockMovement::select(
                DB::raw('DATE(created_at) as date'),
                'type',
                DB::raw('COUNT(*) as total_movements'),
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->groupBy('date', 'type')
            ->orderBy('date', 'desc')
            ->get();
            
        $totalIn = StockMovement::where('type', 'in')
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->sum('quantity');
            
        $totalOut = StockMovement::where('type', 'out')
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->sum('quantity');

        return response()->json([
            'period' => [
                'start' => $request->start_date,
                'end' => $request->end_date,
            ],
            'summary' => $summary,
            'totals' => [
                'in' => $totalIn,
                'out' => $totalOut,
                'net' => $totalIn - $totalOut,
            ],
        ]);
    }

    // Productos más movidos
    public function topProducts(Request $request)
    {
        $limit = $request->get('limit', 10);
        
        $topProducts = StockMovement::select(
                'product_id',
                DB::raw('COUNT(*) as movement_count'),
                DB::raw('SUM(CASE WHEN type = "in" THEN quantity ELSE 0 END) as total_in'),
                DB::raw('SUM(CASE WHEN type = "out" THEN quantity ELSE 0 END) as total_out')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderBy('movement_count', 'desc')
            ->limit($limit)
            ->get();
            
        return response()->json($topProducts);
    }
}