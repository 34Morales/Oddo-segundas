<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odoo2 - Laravel API</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">
                            <i class="fas fa-boxes mr-3"></i>{{ $title }}
                        </h1>
                        <p class="text-blue-100 text-lg">{{ $message }}</p>
                    </div>
                    <div class="text-right">
                        <div class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-circle animate-pulse mr-2"></i>API Online
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- API Endpoints -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-plug mr-3 text-blue-600"></i>API Endpoints Disponibles
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($endpoints as $endpoint)
                        <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition">
                            <div class="mr-4">
                                @if($endpoint['method'] == 'GET')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm font-mono font-bold">GET</span>
                                @elseif($endpoint['method'] == 'POST')
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm font-mono font-bold">POST</span>
                                @elseif($endpoint['method'] == 'PUT')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm font-mono font-bold">PUT</span>
                                @elseif($endpoint['method'] == 'DELETE')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm font-mono font-bold">DELETE</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <code class="bg-gray-800 text-gray-100 px-3 py-1 rounded text-sm">{{ $endpoint['path'] }}</code>
                            </div>
                            <div class="text-gray-600">
                                {{ $endpoint['desc'] }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid md:grid-cols-2 gap-6 mb-10">
                    <a href="{{ $frontend_url }}" target="_blank" 
                       class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-xl hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="mr-4">
                                <i class="fas fa-desktop text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Ir al Frontend</h3>
                                <p class="text-indigo-100">Aplicación React con interfaz completa</p>
                            </div>
                        </div>
                    </a>

                    <a href="/api/auth/login" target="_blank"
                       class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-xl hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="mr-4">
                                <i class="fas fa-key text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Probar Autenticación</h3>
                                <p class="text-green-100">Endpoint de login con JWT</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Credentials -->
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-r-lg mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-yellow-500 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-yellow-800">Credenciales de Prueba</h3>
                            <div class="mt-2 grid md:grid-cols-3 gap-4">
                                <div class="bg-white p-3 rounded-lg">
                                    <div class="font-semibold text-gray-700">Admin</div>
                                    <div class="text-sm text-gray-600">admin@example.com</div>
                                    <code class="text-xs bg-gray-100 p-1 rounded">password</code>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <div class="font-semibold text-gray-700">Manager</div>
                                    <div class="text-sm text-gray-600">manager@example.com</div>
                                    <code class="text-xs bg-gray-100 p-1 rounded">password</code>
                                </div>
                                <div class="bg-white p-3 rounded-lg">
                                    <div class="font-semibold text-gray-700">User</div>
                                    <div class="text-sm text-gray-600">user@example.com</div>
                                    <code class="text-xs bg-gray-100 p-1 rounded">password</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-1">
                            {{ \App\Models\User::count() ?? 3 }}
                        </div>
                        <div class="text-blue-800 font-medium">Usuarios</div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-green-600 mb-1">
                            {{ \App\Models\Product::count() ?? 5 }}
                        </div>
                        <div class="text-green-800 font-medium">Productos</div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-purple-600 mb-1">
                            {{ \App\Models\Category::count() ?? 4 }}
                        </div>
                        <div class="text-purple-800 font-medium">Categorías</div>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg text-center">
                        <div class="text-3xl font-bold text-orange-600 mb-1">
                            {{ \App\Models\StockMovement::count() ?? 0 }}
                        </div>
                        <div class="text-orange-800 font-medium">Movimientos</div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-100 px-8 py-6 border-t">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <div class="text-gray-600">
                            <i class="fas fa-code-branch mr-2"></i>
                            <a href="{{ $repo_url }}" target="_blank" class="text-blue-600 hover:underline">
                                GitHub Repository
                            </a>
                        </div>
                    </div>
                    <div class="text-gray-500 text-sm">
                        <i class="fas fa-server mr-2"></i>Laravel {{ app()->version() }} | PHP {{ phpversion() }} | MySQL
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>