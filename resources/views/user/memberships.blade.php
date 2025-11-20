<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membresías Premium | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <a href="/mi-cuenta" class="text-gray-500 hover:text-blue-600 flex items-center gap-2">
                    <i class="material-icons">arrow_back</i> Volver
                </a>
                <h1 class="font-bold text-lg">Tienda de Membresías</h1>
                <div class="w-8"></div>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-10">

        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Mejora tu experiencia</h1>
            <p class="text-lg text-gray-500">Elimina anuncios, obtén descuentos exclusivos y reserva tu lugar antes de llegar.</p>
        </div>

        <!-- PLANES -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Plan Gratuito -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col opacity-75 hover:opacity-100 transition">
                <h3 class="text-lg font-bold text-gray-500">Básico</h3>
                <div class="my-4">
                    <span class="text-4xl font-bold text-gray-800">$0</span>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                    <li class="flex items-center"><i class="material-icons text-green-500 text-sm mr-2">check</i> Acceso QR</li>
                    <li class="flex items-center"><i class="material-icons text-green-500 text-sm mr-2">check</i> Historial de pagos</li>
                    <li class="flex items-center"><i class="material-icons text-gray-300 text-sm mr-2">block</i> Sin reserva</li>
                </ul>
                <button class="w-full py-3 px-4 bg-gray-100 text-gray-600 font-bold rounded-xl cursor-default">Tu Plan Actual</button>
            </div>

            <!-- Plan Gold -->
            <div class="bg-white rounded-2xl shadow-xl border-2 border-yellow-400 p-8 flex flex-col transform scale-105 z-10 relative">
                <div class="absolute top-0 right-0 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wide">Más Vendido</div>
                <h3 class="text-lg font-bold text-yellow-600 flex items-center gap-2">
                    <i class="material-icons">star</i> Gold
                </h3>
                <div class="my-4">
                    <span class="text-4xl font-bold text-gray-900">$49</span><span class="text-gray-500">/mes</span>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                    <li class="flex items-center"><i class="material-icons text-yellow-500 text-sm mr-2">check_circle</i> <strong>Sin Publicidad</strong></li>
                    <li class="flex items-center"><i class="material-icons text-yellow-500 text-sm mr-2">check_circle</i> Reservar (30 min antes)</li>
                    <li class="flex items-center"><i class="material-icons text-yellow-500 text-sm mr-2">check_circle</i> Soporte Prioritario</li>
                </ul>
                <button onclick="openPaymentModal('Gold', 49)" class="w-full py-3 px-4 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white font-bold rounded-xl hover:shadow-lg hover:scale-[1.02] transition transform">
                    Obtener Gold
                </button>
            </div>

            <!-- Plan Platinum -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 flex flex-col hover:shadow-lg transition hover:-translate-y-1">
                <h3 class="text-lg font-bold text-gray-800">Platinum</h3>
                <div class="my-4">
                    <span class="text-4xl font-bold text-gray-900">$99</span><span class="text-gray-500">/mes</span>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                    <li class="flex items-center"><i class="material-icons text-blue-500 text-sm mr-2">check</i> Todo lo de Gold</li>
                    <li class="flex items-center"><i class="material-icons text-blue-500 text-sm mr-2">check</i> <strong>5% Cashback</strong></li>
                    <li class="flex items-center"><i class="material-icons text-blue-500 text-sm mr-2">check</i> Acceso a eventos</li>
                </ul>
                <button onclick="openPaymentModal('Platinum', 99)" class="w-full py-3 px-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition">
                    Obtener Platinum
                </button>
            </div>

        </div>
    </div>

    <!-- PAGO -->
    <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[100] backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Confirmar Suscripción</h3>
                    <p class="text-sm text-gray-500">Plan <span id="modalPlanName" class="font-bold">--</span> • <span id="modalPlanPrice" class="font-bold text-green-600">--</span></p>
                </div>
                <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-3">Selecciona Método de Pago</label>
                <div class="space-y-3">
                    <label class="flex items-center justify-between p-4 border border-blue-500 bg-blue-50 rounded-xl cursor-pointer transition hover:shadow-md payment-option" onclick="selectOption(this)">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment_method" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-white p-1 rounded border border-blue-100">
                                    <i class="material-icons text-gray-600">credit_card</i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Visa •••• 4242</p>
                                    <p class="text-[10px] text-gray-500">Expira 12/25</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <button onclick="processSubscription()" class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-black shadow-lg transition flex justify-center items-center gap-2">
                <i class="material-icons text-yellow-400">lock</i> Pagar y Suscribirse
            </button>
        </div>
    </div>

    <script>
        let selectedPlan = '';

        function openPaymentModal(planName, price) {
            selectedPlan = planName;
            document.getElementById('modalPlanName').innerText = planName;
            document.getElementById('modalPlanPrice').innerText = '$' + price + '/mes';
            document.getElementById('paymentModal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        function selectOption(element) {
            document.querySelectorAll('.payment-option').forEach(el => {
                el.classList.remove('border-blue-500', 'bg-blue-50');
                el.classList.add('border-gray-200');
                el.querySelector('input').checked = false;
            });
            element.classList.remove('border-gray-200');
            element.classList.add('border-blue-500', 'bg-blue-50');
            element.querySelector('input').checked = true;
        }

        function processSubscription() {
            const btn = document.querySelector('#paymentModal button.w-full');
            btn.disabled = true;
            btn.innerHTML = '<i class="material-icons animate-spin">refresh</i> Procesando...';

            setTimeout(() => {
                // GUARDA LA MEMBRESÍA EN EL NAVEGADOR
                localStorage.setItem('user_membership_plan', selectedPlan);
                
                alert("¡Felicidades! Ahora eres miembro " + selectedPlan + ".");
                window.location.href = '/mi-cuenta';
            }, 2000);
        }
    </script>
</body>
</html>