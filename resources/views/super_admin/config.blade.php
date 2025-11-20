<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Configuración SaaS | Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans p-8">
    
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Configuración de Planes SaaS</h1>
                <p class="text-gray-400 text-sm">Define los precios y características que vendes a los estacionamientos.</p>
            </div>
            <a href="/super-admin" class="text-gray-400 hover:text-white flex items-center gap-2">
                <i class="material-icons text-sm">arrow_back</i> Volver
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Plan Básico -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 relative group hover:border-blue-500 transition">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-white">Plan Básico</h3>
                    <i class="material-icons text-gray-600 group-hover:text-blue-500">edit</i>
                </div>
                <div class="mb-4">
                    <label class="text-xs text-gray-500 uppercase font-bold">Precio Mensual</label>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-gray-400">$</span>
                        <input type="number" value="500" class="bg-gray-900 border border-gray-600 rounded px-2 py-1 text-white w-24 font-bold">
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-400">
                    <p>• 1 Lector</p>
                    <p>• Gestión Manual</p>
                </div>
                <button class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-medium transition">Guardar Cambios</button>
            </div>

            <!-- Plan Pro -->
            <div class="bg-gray-800 rounded-xl border-2 border-blue-600 p-6 relative shadow-lg shadow-blue-900/20">
                <div class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] px-2 py-0.5 rounded-bl uppercase font-bold">Más Vendido</div>
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-white">Plan Profesional</h3>
                    <i class="material-icons text-blue-400">edit</i>
                </div>
                <div class="mb-4">
                    <label class="text-xs text-gray-500 uppercase font-bold">Precio Mensual</label>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-gray-400">$</span>
                        <input type="number" value="1200" class="bg-gray-900 border border-blue-500 rounded px-2 py-1 text-white w-24 font-bold">
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-400">
                    <p>• Lectores Ilimitados</p>
                    <p>• Proveedores VIP</p>
                    <p>• Reportes</p>
                </div>
                <button class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-medium transition">Guardar Cambios</button>
            </div>

            <!-- Plan Enterprise -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 relative group hover:border-purple-500 transition">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-white">Plan Enterprise</h3>
                    <i class="material-icons text-gray-600 group-hover:text-purple-500">edit</i>
                </div>
                <div class="mb-4">
                    <label class="text-xs text-gray-500 uppercase font-bold">Precio Mensual</label>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-gray-400">$</span>
                        <input type="number" value="3500" class="bg-gray-900 border border-gray-600 rounded px-2 py-1 text-white w-24 font-bold">
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-400">
                    <p>• API Integración</p>
                    <p>• Soporte 24/7</p>
                </div>
                <button class="mt-6 w-full bg-gray-700 hover:bg-gray-600 text-white py-2 rounded font-medium transition">Guardar Cambios</button>
            </div>

        </div>
    </div>
</body>
</html>