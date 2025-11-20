<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Historial | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="/mi-cuenta" class="text-gray-500 hover:text-blue-600 transition">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <span class="font-bold text-xl text-gray-800">Mi Actividad</span>
                </div>
                <div class="flex items-center">
                    <div class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                        Noviembre 2024
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-8">
        
        <!-- RESUMEN -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs text-gray-500 uppercase font-bold">Gastado este mes</p>
                <h3 class="text-2xl font-bold text-gray-900">$450.00</h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs text-gray-500 uppercase font-bold">Visitas Totales</p>
                <h3 class="text-2xl font-bold text-gray-900">8</h3>
            </div>
        </div>

        <!-- FILTROS -->
        <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Todos</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-50">Estacionamientos</button>
            <button class="bg-white border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-50">Recargas</button>
        </div>

        <!-- TIMELINE DE ACTIVIDAD -->
        <div class="space-y-6">

            <!-- GRUPO: HOY -->
            <div>
                <h4 class="text-sm font-bold text-gray-500 mb-3 ml-2">Hoy</h4>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <!-- Item 1 -->
                    <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition cursor-pointer group">
                        <div class="flex justify-between items-start">
                            <div class="flex gap-4">
                                <div class="bg-blue-100 p-3 rounded-xl text-blue-600 h-12 w-12 flex items-center justify-center">
                                    <i class="material-icons">local_parking</i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Plaza Universidad</h3>
                                    <p class="text-xs text-gray-500">Entrada: 14:30 • Salida: 16:45</p>
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded border border-gray-200">2h 15m</span>
                                        <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded border border-gray-200">Sentra Rojo</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-500">-$45.00</p>
                                <p class="text-[10px] text-gray-400 mt-1">Saldo</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- GRUPO: AYER -->
            <div>
                <h4 class="text-sm font-bold text-gray-500 mb-3 ml-2">Ayer</h4>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <!-- Item 2 -->
                    <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition cursor-pointer">
                        <div class="flex justify-between items-start">
                            <div class="flex gap-4">
                                <div class="bg-green-100 p-3 rounded-xl text-green-600 h-12 w-12 flex items-center justify-center">
                                    <i class="material-icons">account_balance_wallet</i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Recarga de Saldo</h3>
                                    <p class="text-xs text-gray-500">10:00 AM • Tarjeta ****4242</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-500">+$200.00</p>
                                <p class="text-[10px] text-gray-400 mt-1">Aprobado</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="p-4 hover:bg-gray-50 transition cursor-pointer">
                        <div class="flex justify-between items-start">
                            <div class="flex gap-4">
                                <div class="bg-blue-100 p-3 rounded-xl text-blue-600 h-12 w-12 flex items-center justify-center">
                                    <i class="material-icons">local_parking</i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Centro Histórico</h3>
                                    <p class="text-xs text-gray-500">Entrada: 08:15 • Salida: 09:15</p>
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded border border-gray-200">1h 00m</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-red-500">-$20.00</p>
                                <p class="text-[10px] text-gray-400 mt-1">Saldo</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- GRUPO: SEMANA PASADA -->
            <div>
                <h4 class="text-sm font-bold text-gray-500 mb-3 ml-2">Semana Pasada</h4>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <!-- Item 4 (Proveedor) -->
                    <div class="p-4 hover:bg-gray-50 transition cursor-pointer border-l-4 border-yellow-400 bg-yellow-50/30">
                        <div class="flex justify-between items-start">
                            <div class="flex gap-4">
                                <div class="bg-yellow-100 p-3 rounded-xl text-yellow-700 h-12 w-12 flex items-center justify-center">
                                    <i class="material-icons">local_shipping</i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Hotel Real (Carga)</h3>
                                    <p class="text-xs text-gray-500">12 Nov • 11:00 AM</p>
                                    <div class="mt-2">
                                        <span class="bg-yellow-100 text-yellow-800 text-[10px] px-2 py-0.5 rounded border border-yellow-200 font-bold">Proveedor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-400">$0.00</p>
                                <p class="text-[10px] text-gray-400 mt-1">Autorizado</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        
        <div class="mt-8 text-center">
            <button class="text-blue-600 text-sm font-medium hover:underline">Cargar más actividad...</button>
        </div>

    </div>

</body>
</html>