<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = StockMovement::with(['product', 'user']);
        
        // Filtros
        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        return response()->json($query->orderBy('created_at', 'desc')->paginate(20));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Obtener producto
        $product = Product::findOrFail($request->product_id);
        
        // Actualizar stock según tipo de movimiento
        if ($request->type === 'in') {
            $product->stock += $request->quantity;
        } else {
            // Verificar stock suficiente
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'error' => 'Stock insuficiente. Stock actual: ' . $product->stock
                ], 422);
            }
            $product->stock -= $request->quantity;
        }
        
        $product->save();

        // Crear movimiento
        $movement = StockMovement::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'movement' => $movement->load('product'),
            'new_stock' => $product->stock,
            'message' => 'Movimiento registrado correctamente'
        ], 201);
    }

    public function show($id)
    {
        $movement = StockMovement::with(['product', 'user'])->findOrFail($id);
        return response()->json($movement);
    }
}