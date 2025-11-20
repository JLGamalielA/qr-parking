<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Clientes B2B | Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans p-8">
    
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Estacionamientos Registrados (B2B)</h1>
                <p class="text-gray-400 text-sm">Gestión de clientes y licencias SaaS.</p>
            </div>
            <a href="/super-admin" class="text-gray-400 hover:text-white flex items-center gap-2">
                <i class="material-icons text-sm">arrow_back</i> Volver al Dashboard
            </a>
        </div>

        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-xl">
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="bg-gray-900 text-gray-500 uppercase font-bold text-xs">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nombre del Estacionamiento</th>
                        <th class="px-6 py-4">Plan Actual</th>
                        <th class="px-6 py-4">Próximo Pago</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <!-- Cliente 1 -->
                    <tr class="hover:bg-gray-750 transition">
                        <td class="px-6 py-4 font-mono text-xs">#001</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-white">Plaza Universidad</p>
                            <p class="text-xs text-gray-500">Admin: Roberto Gómez</p>
                        </td>
                        <td class="px-6 py-4"><span class="bg-purple-900 text-purple-200 px-2 py-1 rounded text-xs border border-purple-700">Enterprise</span></td>
                        <td class="px-6 py-4">20 Dic 2025</td>
                        <td class="px-6 py-4"><span class="text-green-400 flex items-center gap-1 text-xs font-bold"><span class="h-2 w-2 rounded-full bg-green-500"></span> Al día</span></td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-blue-400 hover:text-white mr-2">Detalles</button>
                            <button class="text-red-400 hover:text-red-200" onclick="alert('Servicio suspendido por falta de pago')">Suspender</button>
                        </td>
                    </tr>
                    <!-- Cliente 2 -->
                    <tr class="hover:bg-gray-750 transition">
                        <td class="px-6 py-4 font-mono text-xs">#045</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-white">Parking Centro Histórico</p>
                            <p class="text-xs text-gray-500">Admin: Laura M.</p>
                        </td>
                        <td class="px-6 py-4"><span class="bg-blue-900 text-blue-200 px-2 py-1 rounded text-xs border border-blue-700">Profesional</span></td>
                        <td class="px-6 py-4 text-red-400 font-bold">Vencido ayer</td>
                        <td class="px-6 py-4"><span class="text-red-400 flex items-center gap-1 text-xs font-bold"><span class="h-2 w-2 rounded-full bg-red-500 animate-pulse"></span> Mora</span></td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-blue-400 hover:text-white mr-2">Contactar</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">Bloquear Acceso</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>