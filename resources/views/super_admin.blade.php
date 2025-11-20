<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Super Admin | QR-Parking Dueño</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans flex h-screen overflow-hidden">

    <!-- SIDEBAR  -->
    <aside class="w-64 bg-gray-800 border-r border-gray-700 flex flex-col z-10">
        <div class="h-16 flex items-center justify-center border-b border-gray-700 bg-gray-900">
            <h1 class="text-xl font-bold tracking-wider text-blue-400">MASTER ADMIN</h1>
        </div>
        <nav class="flex-1 py-6 space-y-2">
            <!-- Dashboard de Finanzas -->
            <a href="/super-admin" class="flex items-center px-6 py-3 bg-gray-700 border-r-4 border-blue-500 text-white">
                <i class="material-icons mr-3">show_chart</i> Finanzas 
            </a>
            
            <!-- Gestión de Clientes  -->
            <a href="/super-admin/estacionamientos" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition group">
                <i class="material-icons mr-3 group-hover:text-blue-400">business</i> Estacionamientos existentes
            </a>

            <!-- Gestión de Usuarios -->
            <a href="/super-admin/usuarios" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition group">
                <i class="material-icons mr-3 group-hover:text-green-400">group</i> Usuarios Suscritos
            </a>

            <!-- Configuración de Precios -->
            <a href="/super-admin/configuracion" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition group">
                <i class="material-icons mr-3 group-hover:text-purple-400">settings</i> Configuración de planes
            </a>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center gap-3">
                <a href="/" class="text-red-400 hover:text-red-300 text-sm font-bold flex items-center gap-1">
                    <i class="material-icons text-sm">logout</i> Salir
                </a>   
            </div>             
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1 flex flex-col overflow-y-auto bg-gray-900">
        
        <!-- HEADER -->
        <header class="h-16 bg-gray-800 border-b border-gray-700 flex justify-between items-center px-8 sticky top-0 z-20">
            <h2 class="text-lg font-medium text-gray-300">Visión General del Negocio</h2>
            <div class="flex items-center gap-4">
                <span class="bg-green-900 text-green-300 px-3 py-1 rounded-full text-xs font-bold border border-green-700 flex items-center gap-1">
                    <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span> SISTEMA ACTIVO
                </span>
                <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center font-bold">S</div>
                    <div>
                        <p class="text-sm font-medium text-white">Super Admin</p>
                        <p class="text-xs text-gray-500">Dueño</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8 space-y-8">

            <!-- MÉTRICAS PRINCIPALES -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <p class="text-gray-400 text-xs uppercase font-bold">Ingreso Mensual </p>
                    <h3 class="text-3xl font-bold text-white mt-2">$45,000</h3>
                    <p class="text-xs text-green-400 mt-2 flex items-center gap-1"><i class="material-icons text-xs">arrow_upward</i> 12% vs mes anterior</p>
                </div>
                <!-- Clientes Activos -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <p class="text-gray-400 text-xs uppercase font-bold">Estacionamientos Activos</p>
                    <h3 class="text-3xl font-bold text-white mt-2">75</h3>
                    <p class="text-xs text-blue-400 mt-2">+5 esta semana</p>
                </div>
                <!-- Usuarios Totales -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <p class="text-gray-400 text-xs uppercase font-bold">Conductores Registrados</p>
                    <h3 class="text-3xl font-bold text-white mt-2">12,450</h3>
                    <p class="text-xs text-gray-500 mt-2">Base de datos usuarios</p>
                </div>
                <!-- Comisión Acumulada -->
                <div class="bg-gradient-to-br from-green-900 to-gray-800 p-6 rounded-xl border border-green-700 relative overflow-hidden">
                    <i class="material-icons absolute right-2 bottom-2 text-6xl text-green-500 opacity-10">payments</i>
                    <p class="text-green-200 text-xs uppercase font-bold">Tu Ganancia Neta (Comisiones)</p>
                    <h3 class="text-3xl font-bold text-white mt-2">$42,510</h3>
                </div>
            </div>

            <!-- TABLA DE ÚLTIMAS SUSCRIPCIONES -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
                    <h3 class="text-sm font-bold text-gray-200 uppercase">Actividad Reciente B2B</h3>
                    <button onclick="window.location.href='/super-admin/estacionamientos'" class="text-xs bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded transition">Ver Todos</button>
                </div>
                <table class="min-w-full text-sm text-left text-gray-400">
                    <thead class="bg-gray-900 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-3">Cliente / Estacionamiento</th>
                            <th class="px-6 py-3">Plan Contratado</th>
                            <th class="px-6 py-3">Fecha Pago</th>
                            <th class="px-6 py-3">Monto</th>
                            <th class="px-6 py-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 text-white">Plaza Universidad</td>
                            <td class="px-6 py-4"><span class="bg-purple-900 text-purple-200 px-2 py-0.5 rounded text-xs border border-purple-700">Enterprise</span></td>
                            <td class="px-6 py-4">Hoy, 10:30 AM</td>
                            <td class="px-6 py-4 font-mono text-green-400">+$3,500.00</td>
                            <td class="px-6 py-4"><i class="material-icons text-green-500 text-sm">check_circle</i></td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-white">Estacionamiento Centro</td>
                            <td class="px-6 py-4"><span class="bg-blue-900 text-blue-200 px-2 py-0.5 rounded text-xs border border-blue-700">Profesional</span></td>
                            <td class="px-6 py-4">Ayer, 18:45 PM</td>
                            <td class="px-6 py-4 font-mono text-green-400">+$1,200.00</td>
                            <td class="px-6 py-4"><i class="material-icons text-green-500 text-sm">check_circle</i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</body>
</html>