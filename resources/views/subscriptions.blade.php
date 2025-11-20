<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mi Suscripción | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .loader { border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans">

    <!-- Sidebar Lateral -->
    <aside class="w-64 bg-white border-r flex flex-col z-10 shadow-lg">
        <div class="h-16 bg-blue-900 flex items-center justify-center text-white font-bold shadow-md tracking-wider">
            ADMIN PARKING
        </div>
        <nav class="flex-1 py-6">
            <ul class="space-y-2">
                <li>
                    <a href="/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 transition group">
                        <i class="material-icons mr-3 text-gray-400 group-hover:text-blue-600">dashboard</i> 
                        Volver al menú
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-6 py-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600 font-medium">
                        <i class="material-icons mr-3">receipt_long</i> Facturación Software
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- CONTENIDO -->
    <main class="flex-1 flex flex-col overflow-y-auto relative">
        
        <header class="h-16 bg-white border-b flex justify-between items-center px-8 sticky top-0 z-20">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Licencia de Uso del Sistema</h2>
                <p class="text-xs text-gray-500">Gestiona tu suscripción a la plataforma QR-Parking</p>
            </div>
        </header>

        <div class="p-10 max-w-7xl mx-auto w-full">

            <!-- LOADER -->
            <div id="loadingState" class="flex flex-col items-center justify-center py-32">
                <div class="loader mb-4"></div>
                <p class="text-gray-500 text-sm animate-pulse">Consultando estado de cuenta...</p>
            </div>

            <!-- VENTAS (se muestra si no hay pagos) -->
            <div id="pricingSection" class="hidden fade-in">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide border border-red-200">Licencia Requerida</span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-4 mb-4">Activa tu acceso administrativo</h1>
                    <p class="text-gray-500 text-lg">Selecciona el nivel de servicio para operar tu estacionamiento.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Plan Básico -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col relative hover:shadow-lg transition">
                        <h3 class="text-lg font-bold text-gray-900">Licencia Básica</h3>
                        <div class="my-4"><span class="text-4xl font-bold text-gray-900">$500</span><span class="text-gray-500">/mes</span></div>
                        <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                            <li class="flex items-center"><i class="material-icons text-green-500 text-sm mr-2">check_circle</i> 1 Terminal</li>
                            <li class="flex items-center"><i class="material-icons text-green-500 text-sm mr-2">check_circle</i> Cobro Manual</li>
                        </ul>
                        <button onclick="goToCheckout('Básico', 500)" class="w-full py-3 px-4 bg-gray-50 text-blue-700 font-bold rounded-lg border border-blue-200 hover:bg-blue-100 transition">
                            Contratar Básico
                        </button>
                    </div>

                    <!-- Plan Pro -->
                    <div class="bg-white rounded-2xl shadow-xl border-2 border-blue-600 p-8 transform scale-105 z-10 relative flex flex-col">
                        <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg uppercase">Popular</div>
                        <h3 class="text-lg font-bold text-gray-900">Licencia Pro</h3>
                        <div class="my-4"><span class="text-4xl font-bold text-gray-900">$1,200</span><span class="text-gray-500">/mes</span></div>
                        <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                            <li class="flex items-center"><i class="material-icons text-blue-600 text-sm mr-2">check_circle</i> Terminales Ilimitadas</li>
                            <li class="flex items-center"><i class="material-icons text-blue-600 text-sm mr-2">check_circle</i> Proveedores VIP</li>
                            <li class="flex items-center"><i class="material-icons text-blue-600 text-sm mr-2">check_circle</i> Reportes</li>
                        </ul>
                        <button onclick="goToCheckout('Profesional', 1200)" class="w-full py-3 px-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg">
                            Activar Licencia Pro
                        </button>
                    </div>

                    <!-- Plan Enterprise -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col hover:shadow-lg transition">
                        <h3 class="text-lg font-bold text-gray-900">Enterprise</h3>
                        <div class="my-4"><span class="text-4xl font-bold text-gray-900">$3,500</span><span class="text-gray-500">/mes</span></div>
                        <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                            <li class="flex items-center"><i class="material-icons text-green-500 text-sm mr-2">check_circle</i> API Integración</li>
                            <li class="flex items-center"><i class="material-icons text-green-500 text-sm mr-2">check_circle</i> Soporte 24/7</li>
                        </ul>
                        <button onclick="goToCheckout('Enterprise', 3500)" class="w-full py-3 px-4 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-900 transition">
                            Contratar Enterprise
                        </button>
                    </div>
                </div>
            </div>

            <!-- MI PLAN ACTIVO (se muestra si se realizo un pago) -->
            <div id="managementSection" class="hidden fade-in">
                
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Mi Plan Actual</h2>
                    
                    <!-- Tarjeta de Estado -->
                    <div class="bg-white rounded-xl shadow-md border border-green-200 p-8 mb-8 relative overflow-hidden">
                        <div class="absolute left-0 top-0 h-full w-2 bg-green-500"></div>
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                                        <span id="activePlanName" class="text-green-700">Licencia --</span>
                                    </h2>
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase border border-green-200">Pagado & Activo</span>
                                </div>
                                <p class="text-gray-600 mt-2">Tu estacionamiento tiene acceso completo a las funciones contratadas.</p>
                                <p class="text-sm text-gray-400 mt-4">Próxima renovación automática: <strong class="text-gray-600" id="renewalDate">--/--/----</strong></p>
                            </div>
                            
                            <!-- Botón de Cancelación -->
                            <div class="text-right">
                                <button onclick="cancelSubscription()" class="text-red-500 hover:text-red-700 font-medium text-sm px-4 py-2 border border-red-100 rounded hover:bg-red-50 transition flex items-center gap-2">
                                    <i class="material-icons text-sm">cancel</i> Dar de baja el servicio
                                </button>
                                <p class="text-xs text-gray-400 mt-2 w-48 ml-auto">Al cancelar, el servicio se detendrá al final del periodo.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Historial de Pagos -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Historial de Pagos</h3>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <i class="material-icons text-green-500">check_circle</i>
                                <div>
                                    <p class="text-sm font-bold text-gray-700">Pago Mensualidad</p>
                                    <p class="text-xs text-gray-500">Procesado hoy</p>
                                </div>
                            </div>
                            <span class="font-mono font-bold text-gray-700">$<span id="lastPrice">--</span></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Verifica si ya pagó leyendo el LocalStorage
            setTimeout(() => {
                document.getElementById('loadingState').classList.add('hidden');
                
                const activePlan = localStorage.getItem('parking_subscription_plan');
                
                if (activePlan) {
                    // TIENE PLAN: Mostrar panel de gestión
                    document.getElementById('activePlanName').innerText = 'Licencia ' + activePlan;
                    
                    // Calcular precio simulado para mostrar
                    let price = '0';
                    if(activePlan.includes('Básico')) price = '500';
                    if(activePlan.includes('Profesional')) price = '1,200';
                    if(activePlan.includes('Enterprise')) price = '3,500';
                    document.getElementById('lastPrice').innerText = price;

                    // Fecha +1 mes
                    const date = new Date();
                    date.setMonth(date.getMonth() + 1);
                    document.getElementById('renewalDate').innerText = date.toLocaleDateString();

                    document.getElementById('managementSection').classList.remove('hidden');
                } else {
                    // Planes cuando no hay ninguno activo
                    document.getElementById('pricingSection').classList.remove('hidden');
                }
            }, 800);
        });

        function goToCheckout(plan, price) {
            window.location.href = `/payment/checkout?plan=${encodeURIComponent(plan)}&price=${price}`;
        }

        function cancelSubscription() {
            if(confirm("¿Estás seguro que deseas dar de baja tu plan? Se desactivarán las funciones administrativas al terminar el mes.")) {
                localStorage.removeItem('parking_subscription_plan');
                localStorage.removeItem('parking_subscription_status');
                
                alert('Tu suscripción ha sido cancelada.');
                location.reload();
            }
        }
    </script>
</body>
</html>