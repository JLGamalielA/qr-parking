<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Solicitudes | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Solicitudes de Acceso Especial</h1>
            <a href="/dashboard" class="text-blue-600 hover:underline flex items-center"><i class="material-icons text-sm mr-1">arrow_back</i> Volver</a>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol Solicitado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Justificación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Item 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">JP</div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Juan Pérez</div>
                                    <div class="text-sm text-gray-500">juan@correo.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proveedor</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Entrega de bebidas</div>
                            <div class="text-xs text-gray-500">Coca-Cola FEMSA</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button onclick="alert('DB: UPDATE solicitudes_proveedor SET estado=aprobado; INSERT INTO vinculos...')" class="text-green-600 hover:text-green-900 font-bold">Aprobar</button>
                            <button class="text-red-600 hover:text-red-900">Rechazar</button>
                        </td>
                    </tr>
                    <!-- Item 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold">RT</div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Radio Taxis</div>
                                    <div class="text-sm text-gray-500">base@radiotaxi.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Base de Taxis</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Permiso de base nocturna</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button class="text-green-600 hover:text-green-900 font-bold">Aprobar</button>
                            <button class="text-red-600 hover:text-red-900">Rechazar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>