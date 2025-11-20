<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Admin Parking | QR-Parking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">
    
    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r flex flex-col flex-shrink-0 z-20">
        <div class="h-16 bg-blue-900 flex items-center justify-center text-white font-bold shadow-md tracking-wider">
            ADMIN PARKING
        </div>
        
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <!-- Principal -->
                <li>
                    <a href="/dashboard" class="flex items-center px-6 py-3 text-blue-600 bg-blue-50 border-r-4 border-blue-600 font-medium">
                        <i class="material-icons mr-3">dashboard</i> Resumen
                    </a>
                </li>
                
                <!-- SECCIÓN OPERACIÓN -->
                <li class="pt-4 pb-1 px-6 text-xs font-bold text-gray-400 uppercase">Operación Diaria</li>
                <li>
                    <a href="/entrada" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">login</i> Ingreso
                    </a>
                </li>
                <li>
                    <a href="/salida" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">logout</i> Salida
                    </a>
                </li>

                <!-- SECCIÓN GESTIÓN DE CLIENTES -->
                <li class="pt-4 pb-1 px-6 text-xs font-bold text-gray-400 uppercase">Gestión de Clientes</li>
                <li>
                    <a href="/admin/solicitudes" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 justify-between transition">
                        <div class="flex items-center"><i class="material-icons mr-3 text-gray-400">group_add</i> Solicitudes Especiales</div>
                        <span class="bg-red-100 text-red-600 text-xs px-2 rounded-full font-bold">3</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/planes" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">sell</i> Vender Pensiones
                    </a>
                </li>
                <li>
                    <a href="/admin/tarifas" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">price_change</i> Configurar Tarifas
                    </a>
                </li>
                <li>
                    <a href="/admin/bitacora" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">list_alt</i> Bitácora Accesos
                    </a>
                </li>

                <!-- SECCIÓN ADMINISTRACIÓN DEL SOFTWARE -->
                <li class="pt-4 pb-1 px-6 text-xs font-bold text-gray-400 uppercase">Administración del Software</li>
                <li>
                    <a href="/suscripciones" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">receipt</i> Mi Plan
                    </a>
                </li>
                <li>
                    <a href="/admin/metodos-pago" class="flex items-center px-6 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                        <i class="material-icons mr-3 text-gray-400">credit_card</i> Métodos de Pago
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t bg-gray-50">
            <a href="/" class="flex items-center text-red-500 hover:text-red-700 font-medium text-sm transition">
                <i class="material-icons mr-2">logout</i> Cerrar Sesión
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Topbar -->
        <header class="h-16 bg-white border-b flex justify-between items-center px-8 shadow-sm z-10">
            <h2 class="text-xl font-bold text-gray-800">Panel de Control</h2>
            <div class="flex items-center gap-4">
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1 border border-green-200">
                    <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></span> Sistema Online
                </span>
                
                <!-- Perfil de Usuario -->
                <div class="flex items-center gap-3 pl-4 border-l border-gray-200 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition group">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-800 leading-none group-hover:text-blue-600 transition">Admin Parking</p>
                        <p class="text-xs text-gray-500 mt-0.5">Gerente General</p>
                    </div>
                    <div class="h-10 w-10 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full flex items-center justify-center font-bold shadow-md border-2 border-white ring-2 ring-gray-100">
                        <span>AD</span>
                    </div>
                    <i class="material-icons text-gray-400 text-sm group-hover:text-blue-600 transition">expand_more</i>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Ocupación -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Ocupación Actual</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">45 <span class="text-lg text-gray-400 font-normal">/ 60</span></h3>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg text-blue-600"><i class="material-icons">directions_car</i></div>
                    </div>
                    <div class="mt-4 w-full bg-gray-100 rounded-full h-2 relative z-10">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <!-- Ganancias -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Ganancias Hoy</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">$2,850.00</h3>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg text-green-600"><i class="material-icons">attach_money</i></div>
                    </div>
                    <p class="text-xs text-green-600 mt-4 flex items-center font-medium">
                        <i class="material-icons text-xs mr-1">trending_up</i> +12% vs ayer
                    </p>
                </div>

                <!-- Solicitudes Pendientes  -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-red-100 cursor-pointer hover:shadow-md transition group" onclick="window.location.href='/admin/solicitudes'">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-red-500 font-bold uppercase tracking-wider">Solicitudes Pendientes</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-red-600 transition">3 Solicitudes</h3>
                        </div>
                        <div class="p-3 bg-red-50 rounded-lg text-red-600 group-hover:bg-red-100 transition"><i class="material-icons">notifications</i></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-4">Proveedores esperando aprobación</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 min-h-[300px] flex flex-col justify-center items-center text-gray-400">
                    <i class="material-icons text-5xl mb-2 text-gray-200">bar_chart</i>
                    <p class="text-sm">Gráfica de flujo de ocupación (Por horas)</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h3 class="font-bold text-gray-700 text-sm uppercase">Actividad Reciente</h3>
                    </div>
                    <ul class="divide-y divide-gray-100">
                        <li class="px-6 py-3 flex justify-between items-center hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-100 p-1.5 rounded text-green-600"><i class="material-icons text-xs">login</i></div>
                                <span class="text-sm font-medium text-gray-700">Entrada: ABC-123</span>
                            </div>
                            <span class="text-xs text-gray-400">Hace 5 min</span>
                        </li>
                        <li class="px-6 py-3 flex justify-between items-center hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 p-1.5 rounded text-blue-600"><i class="material-icons text-xs">logout</i></div>
                                <span class="text-sm font-medium text-gray-700">Salida: JKL-999</span>
                            </div>
                            <span class="text-xs text-gray-400">Hace 12 min</span>
                        </li>
                        <li class="px-6 py-3 flex justify-between items-center hover:bg-gray-50">
                            <div class="flex items-center gap-3">
                                <div class="bg-yellow-100 p-1.5 rounded text-yellow-600"><i class="material-icons text-xs">star</i></div>
                                <span class="text-sm font-medium text-gray-700">Proveedor: Coca-Cola</span>
                            </div>
                            <span class="text-xs text-gray-400">Hace 45 min</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </main>
</body>
</html>