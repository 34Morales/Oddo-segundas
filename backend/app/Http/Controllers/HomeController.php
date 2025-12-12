<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'title' => 'Inventory API',
            'message' => 'API RESTful para sistema de inventario',
            'endpoints' => [
                ['method' => 'POST', 'path' => '/api/auth/login', 'desc' => 'Autenticación JWT'],
                ['method' => 'GET', 'path' => '/api/products', 'desc' => 'Listar productos'],
                ['method' => 'POST', 'path' => '/api/products', 'desc' => 'Crear producto'],
                ['method' => 'GET', 'path' => '/api/categories', 'desc' => 'Listar categorías'],
                ['method' => 'GET', 'path' => '/api/stock-movements', 'desc' => 'Movimientos de stock'],
            ],
            'frontend_url' => 'http://localhost:5173',
            'repo_url' => 'https://github.com/tu-usuario/inventory-odoo-clone'
        ]);
    }
}