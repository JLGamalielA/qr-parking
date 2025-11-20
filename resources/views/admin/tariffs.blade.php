<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Tarifas | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Gestor de Tarifas y Reglas</h1>
            <a href="/dashboard" class="text-blue-600 hover:underline flex items-center"><i class="material-icons text-sm mr-1">arrow_back</i> Volver</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <i class="material-icons text-blue-500">directions_car</i> Usuario Normal
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Precio por Hora</label>
                        <input type="number" value="20" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tolerancia (minutos)</label>
                        <input type="number" value="15" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Guardar Cambios</button>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-l-4 border-yellow-400">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <i class="material-icons text-yellow-600">local_shipping</i> Proveedores / Taxis
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tiempo Libre (Carga/Descarga)</label>
                        <div class="flex gap-2">
                            <input type="number" value="45" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <span class="mt-3 text-sm text-gray-500">minutos</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tarifa Excedente</label>
                        <input type="number" value="50" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <p class="text-xs text-gray-400 mt-1">Se cobra triple si exceden el tiempo.</p>
                    </div>
                    <button class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-900">Actualizar Reglas VIP</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>