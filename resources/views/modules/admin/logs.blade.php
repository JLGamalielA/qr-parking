<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Bitácora | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Bitácora de Accesos</h1>
            <a href="/dashboard" class="text-blue-600 hover:underline flex items-center"><i class="material-icons text-sm mr-1">arrow_back</i> Volver</a>
        </div>

        <!-- Filtros -->
        <div class="bg-white p-4 rounded-lg shadow mb-6 flex gap-4 items-end">
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase">Fecha</label>
                <input type="date" class="block w-full border-gray-300 rounded-md border p-2 text-sm">
            </div>
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase">Tipo Usuario</label>
                <select class="block w-full border-gray-300 rounded-md border p-2 text-sm">
                    <option>Todos</option>
                    <option>Normal</option>
                    <option>Proveedor</option>
                    <option>Taxi</option>
                </select>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Filtrar</button>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-500 font-bold uppercase">
                    <tr>
                        <th class="px-4 py-3">Hora</th>
                        <th class="px-4 py-3">Usuario / Placa</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3">Actividad</th>
                        <th class="px-4 py-3">Cobro</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3">14:22</td>
                        <td class="px-4 py-3 font-mono">ABC-123</td>
                        <td class="px-4 py-3"><span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">Normal</span></td>
                        <td class="px-4 py-3">Salida (3h 10m)</td>
                        <td class="px-4 py-3 font-bold text-green-600">$60.00</td>
                    </tr>
                    <tr class="bg-yellow-50">
                        <td class="px-4 py-3">14:15</td>
                        <td class="px-4 py-3 font-mono">PROV-999</td>
                        <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded text-xs font-bold">Proveedor</span></td>
                        <td class="px-4 py-3">Entrada (Acceso Carga)</td>
                        <td class="px-4 py-3 text-gray-400">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>