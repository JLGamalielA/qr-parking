<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Portal | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        .gradient-card { background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); }
        .gold-card { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
        .platinum-card { background: linear-gradient(135deg, #374151 0%, #111827 100%); }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.2); opacity: 0; }
        }
        .pulse-animation::before {
            content: ''; position: absolute; left: 0; top: 0; width: 100%; height: 100%;
            border-radius: 50%; border: 2px solid #2563eb; animation: pulse-ring 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="#" class="flex items-center gap-2">
                        <div class="bg-blue-600 text-white p-1 rounded-lg">
                            <i class="material-icons text-xl">local_parking</i>
                        </div>
                        <span class="font-bold text-xl text-gray-800">QR-Parking</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="/mi-cuenta" class="text-blue-600 font-medium px-3 py-2 rounded-md bg-blue-50">Inicio</a>
                        <a href="/mi-cuenta/historial" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md transition">Historial y Gastos</a>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <!-- Widget Saldo -->
                    <div class="hidden md:flex items-center gap-3 bg-gray-50 px-4 py-1.5 rounded-full border border-gray-200">
                        <div class="text-right">
                            <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Saldo</p>
                            <p class="text-sm font-bold text-gray-800 font-mono" id="userBalance">$520.00</p>
                        </div>
                        <button onclick="openRechargeModal()" class="bg-green-600 text-white rounded-full p-1 hover:bg-green-700 transition shadow-sm" title="Recargar">
                            <i class="material-icons text-sm">add</i>
                        </button>
                    </div>

                    <!-- Perfil -->
                    <a href="/mi-cuenta/perfil" class="flex items-center gap-2 cursor-pointer group">
                        <div class="h-8 w-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold transition group-hover:bg-blue-600 group-hover:text-white">JP</div>
                        <span class="text-sm font-medium hidden sm:block group-hover:text-blue-600">Juan Pérez</span>
                    </a>
                    <a href="/" class="text-gray-400 hover:text-red-500"><i class="material-icons">logout</i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- GESTIÓN DE ACCESO -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Tarjeta de Acceso -->
                <div id="accessCard" class="bg-white rounded-2xl shadow-lg p-6 text-center border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-blue-500" id="statusLine"></div>
                    
                    <!-- FUERA DEL ESTACIONAMIENTO -->
                    <div id="stateOutside">
                        <h2 class="text-lg font-bold text-gray-800 mb-2">¿Vas a entrar?</h2>
                        <p class="text-sm text-gray-500 mb-6">Genera tu código QR para acceder al estacionamiento.</p>
                        
                        <button onclick="generateAccessQR()" class="w-full gradient-card text-white py-4 rounded-xl shadow-blue-500/30 shadow-lg transform transition hover:scale-105 flex items-center justify-center gap-2 relative overflow-hidden">
                            <span class="absolute inset-0 bg-white opacity-0 hover:opacity-10 transition"></span>
                            <i class="material-icons">qr_code_2</i> <span class="font-bold text-lg">Generar Entrada</span>
                        </button>
                    </div>

                    <!-- CÓDIGO QR GENERADO -->
                    <div id="stateQR" class="hidden">
                        <h2 class="text-lg font-bold text-gray-800 mb-1">Escanea en la entrada</h2>
                        <p class="text-xs text-red-500 font-bold mb-4" id="timer">Expira en 05:00</p>
                        
                        <div class="bg-white p-2 border-4 border-gray-900 rounded-xl inline-block mb-4">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ACCESO-USER-123" alt="QR" class="w-48 h-48">
                        </div>
                        <button onclick="cancelQR()" class="text-sm text-gray-400 underline hover:text-gray-600">Cancelar código</button>
                        <button onclick="simulateEntry()" class="block w-full mt-4 bg-gray-100 text-xs py-1 rounded text-gray-400 hover:bg-gray-200">[DEV: Simular Entrada]</button>
                    </div>

                    <!-- DENTRO DEL ESTACIONAMIENTO -->
                    <div id="stateInside" class="hidden">
                        <div class="flex items-center justify-center mb-4">
                            <div class="bg-green-100 text-green-600 p-3 rounded-full pulse-animation relative">
                                <i class="material-icons text-2xl">local_parking</i>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Estacionado</h2>
                        <p class="text-sm text-gray-500">Plaza Universidad</p>
                        <div class="mt-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-500">Entrada:</span>
                                <span class="font-bold">10:30 AM</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Tiempo:</span>
                                <span class="font-bold text-blue-600" id="parkTimer">00:00</span>
                            </div>
                        </div>
                        <button onclick="payAndExit()" class="w-full mt-6 bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-black transition flex items-center justify-center gap-2">
                            <i class="material-icons text-yellow-400">payments</i> Pagar y Salir
                        </button>
                    </div>
                </div>

                <!-- 1. PROMO MEMBRESÍA (Se muestra si se tiene un plan) -->
                <div id="promoMembershipCard" class="bg-gradient-to-r from-purple-600 to-indigo-600 p-5 rounded-xl shadow-md text-white cursor-pointer hover:shadow-lg transition transform hover:scale-[1.02] flex items-center justify-between relative overflow-hidden group" onclick="window.location.href='/mi-cuenta/membresias'">
                    <div class="relative z-10">
                        <h3 class="font-bold text-lg flex items-center gap-2">
                            <i class="material-icons text-yellow-300">star</i> Membresía Premium
                        </h3>
                        <p class="text-xs text-purple-200 mt-1">Obtén descuentos y reservas</p>
                    </div>
                    <i class="material-icons text-6xl opacity-20 absolute -right-4 -bottom-4 rotate-12 group-hover:rotate-0 transition duration-500">workspace_premium</i>
                    <div class="bg-white/20 p-2 rounded-full">
                        <i class="material-icons">arrow_forward</i>
                    </div>
                </div>

                <!-- 2. MEMBRESÍA ACTIVA (Se muestra si ya se compro) -->
                <div id="activeMembershipCard" class="hidden gold-card p-5 rounded-xl shadow-lg text-white relative overflow-hidden transition hover:scale-[1.01]">
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <h3 class="font-bold text-lg flex items-center gap-2 text-white drop-shadow-sm">
                                <i class="material-icons">verified</i> Miembro <span id="planNameDisplay">Gold</span>
                            </h3>
                            <p class="text-xs text-white/80 mt-1">Renueva el 20 Nov 2025</p>
                        </div>
                        <i class="material-icons text-4xl text-white/30">emoji_events</i>
                    </div>
                    <div class="mt-4 pt-3 border-t border-white/20 flex justify-between items-center relative z-10">
                        <span class="text-xs font-mono bg-black/20 px-2 py-1 rounded">ID: 8821-VIP</span>
                        <button onclick="cancelMembership()" class="text-xs hover:underline text-white opacity-80 hover:opacity-100">Cancelar</button>
                    </div>
                    <!-- Patrón de fondo -->
                    <i class="material-icons text-9xl absolute -right-6 -bottom-8 text-white opacity-10 rotate-12">stars</i>
                </div>

            </div>

            <!--  MAPA -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Buscador -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-1">
                        <i class="material-icons absolute left-3 top-3 text-gray-400">search</i>
                        <input type="text" placeholder="¿A dónde vas hoy?" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm text-sm font-medium text-gray-600 hover:bg-gray-50 flex items-center gap-1"><i class="material-icons text-xs">tune</i> Filtros</button>
                        <button class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm text-sm font-medium text-gray-600 hover:bg-gray-50 flex items-center gap-1"><i class="material-icons text-xs">near_me</i> Cerca de mí</button>
                    </div>
                </div>

                <!-- Mapa -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden h-[500px] relative">
                    <div class="absolute inset-0 bg-blue-50 flex items-center justify-center">
                        <p class="text-blue-200 font-bold text-2xl select-none">MAPA GOOGLE / MAPBOX</p>
                    </div>
                    <!-- Pins en Mapa -->
                    <div class="absolute top-1/3 left-1/4 transform -translate-x-1/2 hover:scale-110 transition cursor-pointer group">
                        <i class="material-icons text-red-500 text-5xl drop-shadow-lg">location_on</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RECARGA DE SALDO -->
    <div id="rechargeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[100] backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recargar Saldo</h3>
                <button onclick="closeRechargeModal()" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>

            <form onsubmit="processRecharge(event)">
                <!-- Monto -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">¿Cuánto quieres recargar?</label>
                    <div class="grid grid-cols-3 gap-3 mb-3">
                        <button type="button" onclick="selectAmount(50)" class="amount-btn border border-gray-300 rounded-lg py-2 text-sm hover:border-blue-500 hover:text-blue-600 transition">$50</button>
                        <button type="button" onclick="selectAmount(100)" class="amount-btn border border-gray-300 rounded-lg py-2 text-sm hover:border-blue-500 hover:text-blue-600 transition">$100</button>
                        <button type="button" onclick="selectAmount(200)" class="amount-btn border border-blue-500 bg-blue-50 text-blue-700 font-bold rounded-lg py-2 text-sm transition">$200</button>
                    </div>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-500">$</span>
                        <input type="number" id="customAmount" class="w-full border border-gray-300 rounded-lg pl-8 pr-4 py-2 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100" placeholder="Otro monto" value="200">
                    </div>
                </div>

                <!-- Método de Pago -->
                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Selecciona Método de Pago</label>
                    <div class="space-y-3" id="paymentMethodsList">
                        <!-- Tarjeta 1 -->
                        <div class="payment-option flex items-center justify-between p-3 border border-blue-500 bg-blue-50 rounded-lg cursor-pointer transition" onclick="selectPaymentMethod(this)">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" checked class="text-blue-600 focus:ring-blue-500 pointer-events-none">
                                <div class="flex items-center gap-2">
                                    <i class="material-icons text-gray-600">credit_card</i>
                                    <span class="text-sm font-medium">Visa terminada en 4242</span>
                                </div>
                            </div>
                            <i class="material-icons text-blue-600 text-sm check-icon">check_circle</i>
                        </div>
                        
                        <!-- Tarjeta 2 (PayPal) -->
                        <div class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition" onclick="selectPaymentMethod(this)">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500 pointer-events-none">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-blue-800 text-xs italic">Pay</span>
                                    <span class="text-sm font-medium">PayPal</span>
                                </div>
                            </div>
                            <i class="material-icons text-blue-600 text-sm check-icon hidden">check_circle</i>
                        </div>

                        <!-- BOTÓN  PARA AGREGAR TARJETA -->
                        <button type="button" onclick="openAddCardModal()" class="text-blue-600 text-xs font-bold flex items-center gap-1 hover:underline mt-1 w-full p-2 rounded hover:bg-blue-50 transition">
                            <i class="material-icons text-xs">add_circle</i> Agregar nueva tarjeta
                        </button>
                    </div>
                </div>

                <button type="submit" id="confirmRechargeBtn" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 shadow-lg shadow-green-500/30 transition flex justify-center items-center gap-2">
                    <i class="material-icons text-sm">account_balance_wallet</i> Confirmar Recarga
                </button>
            </form>
        </div>
    </div>

    <!-- AGREGAR TARJETA (USUARIO) -->
    <div id="addCardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[110] backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Nueva Tarjeta</h3>
                <button onclick="closeAddCardModal()" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="saveNewCard(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Número de Tarjeta</label>
                        <div class="relative">
                            <i class="material-icons absolute left-3 top-3 text-gray-400 text-sm">credit_card</i>
                            <input type="text" class="w-full border pl-10 p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="0000 0000 0000 0000" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Expiración</label>
                            <input type="text" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="MM/AA" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">CVC</label>
                            <input type="password" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="123" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Titular</label>
                        <input type="text" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="Nombre como aparece en la tarjeta" required>
                    </div>
                </div>
                <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-700 transition shadow-lg">Guardar Tarjeta</button>
            </form>
        </div>
    </div>

    <script>
        // --- VERIFICAR MEMBRESÍA AL CARGAR ---
        document.addEventListener('DOMContentLoaded', () => {
            const plan = localStorage.getItem('user_membership_plan');
            
            if (plan) {
                // Ocultar Promo de Venta
                document.getElementById('promoMembershipCard').classList.add('hidden');
                
                // Mostrar Tarjeta Activa
                const activeCard = document.getElementById('activeMembershipCard');
                document.getElementById('planNameDisplay').innerText = plan;
                activeCard.classList.remove('hidden');

                // Platinum
                if (plan === 'Platinum') {
                    activeCard.classList.remove('gold-card');
                    activeCard.classList.add('platinum-card');
                }
            }
        });

        function cancelMembership() {
            if(confirm("¿Estás seguro que deseas cancelar tu membresía Premium? Perderás tus beneficios al final del ciclo.")) {
                localStorage.removeItem('user_membership_plan');
                alert("Membresía cancelada.");
                location.reload(); 
            }
        }

        // --- LÓGICA DE RECARGA Y TARJETAS ---
        function openRechargeModal() {
            document.getElementById('rechargeModal').classList.remove('hidden');
        }

        function closeRechargeModal() {
            document.getElementById('rechargeModal').classList.add('hidden');
        }
        
        function openAddCardModal() {
            document.getElementById('rechargeModal').classList.add('hidden');
            document.getElementById('addCardModal').classList.remove('hidden');
        }

        function closeAddCardModal() {
            document.getElementById('addCardModal').classList.add('hidden');
            document.getElementById('rechargeModal').classList.remove('hidden');
        }

        function saveNewCard(e) {
            e.preventDefault();
            alert("Tarjeta guardada exitosamente.");
            
            // Agregar visualmente a la lista
            const list = document.getElementById('paymentMethodsList');
            const newCardHTML = document.createElement('div');
            newCardHTML.className = "payment-option flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition";
            newCardHTML.onclick = function() { selectPaymentMethod(this); };
            newCardHTML.innerHTML = `
                <div class="flex items-center gap-3">
                    <input type="radio" name="payment_method" class="text-blue-600 focus:ring-blue-500 pointer-events-none">
                    <div class="flex items-center gap-2">
                        <i class="material-icons text-gray-600">credit_card</i>
                        <span class="text-sm font-medium">Nueva Tarjeta •••• 0000</span>
                    </div>
                </div>
                <i class="material-icons text-blue-600 text-sm check-icon hidden">check_circle</i>
            `;
            
            const btn = list.lastElementChild;
            list.insertBefore(newCardHTML, btn);
            
            // Seleccion de tarjeta
            selectPaymentMethod(newCardHTML);
            closeAddCardModal();
        }

        function selectAmount(amount) {
            document.getElementById('customAmount').value = amount;
            document.querySelectorAll('.amount-btn').forEach(btn => {
                btn.classList.remove('border-blue-500', 'bg-blue-50', 'text-blue-700', 'font-bold');
                btn.classList.add('border-gray-300');
                if(btn.innerText.includes(amount)) {
                    btn.classList.add('border-blue-500', 'bg-blue-50', 'text-blue-700', 'font-bold');
                    btn.classList.remove('border-gray-300');
                }
            });
        }
        
        function selectPaymentMethod(element) {
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('border-blue-500', 'bg-blue-50');
                opt.classList.add('border-gray-200');
                opt.querySelector('.check-icon').classList.add('hidden');
                opt.querySelector('input[type="radio"]').checked = false;
            });
            element.classList.remove('border-gray-200');
            element.classList.add('border-blue-500', 'bg-blue-50');
            element.querySelector('.check-icon').classList.remove('hidden');
            element.querySelector('input[type="radio"]').checked = true;
        }

        function processRecharge(e) {
            e.preventDefault();
            const btn = document.getElementById('confirmRechargeBtn');
            const amount = document.getElementById('customAmount').value;
            
            if(!amount || amount <= 0) {
                alert("Por favor ingresa un monto válido.");
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="material-icons animate-spin text-sm">refresh</i> Procesando...';

            setTimeout(() => {
                const balanceEl = document.getElementById('userBalance');
                let currentBalance = parseFloat(balanceEl.innerText.replace('$',''));
                let newBalance = currentBalance + parseFloat(amount);
                balanceEl.innerText = '$' + newBalance.toFixed(2);

                alert(`¡Recarga exitosa de $${amount}!\nTu nuevo saldo es $${newBalance.toFixed(2)}`);
                closeRechargeModal();
                btn.disabled = false;
                btn.innerHTML = '<i class="material-icons text-sm">account_balance_wallet</i> Confirmar Recarga';
            }, 1500);
        }

        function generateAccessQR() {
            document.getElementById('stateOutside').classList.add('hidden');
            document.getElementById('stateQR').classList.remove('hidden');
            let duration = 300;
            const display = document.getElementById('timer');
            const timer = setInterval(() => {
                let minutes = parseInt(duration / 60, 10);
                let seconds = parseInt(duration % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = "Expira en " + minutes + ":" + seconds;
                if (--duration < 0) clearInterval(timer);
            }, 1000);
        }

        function cancelQR() {
            document.getElementById('stateQR').classList.add('hidden');
            document.getElementById('stateOutside').classList.remove('hidden');
        }

        function simulateEntry() {
            document.getElementById('stateQR').classList.add('hidden');
            document.getElementById('stateInside').classList.remove('hidden');
            document.getElementById('statusLine').classList.remove('bg-blue-500');
            document.getElementById('statusLine').classList.add('bg-green-500');
            let seconds = 0;
            setInterval(() => {
                seconds++;
                const date = new Date(0);
                date.setSeconds(seconds); 
                document.getElementById('parkTimer').innerText = date.toISOString().substr(11, 8);
            }, 1000);
        }

        function payAndExit() {
            if(confirm("Total a pagar: $40.00\nSe descontará de tu saldo.\n¿Confirmar?")) {
                const balanceEl = document.getElementById('userBalance');
                let balance = parseFloat(balanceEl.innerText.replace('$',''));
                balance -= 40;
                balanceEl.innerText = '$' + balance.toFixed(2);
                alert("Pago exitoso. Tienes 15 minutos para salir.");
                location.reload();
            }
        }
    </script>
</body>
</html>