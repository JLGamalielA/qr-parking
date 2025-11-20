<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Salida | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        /* Animación de éxito */
        @keyframes scaleUp {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-scale { animation: scaleUp 0.4s ease-out forwards; }
        
        /* Animación del Escáner */
        @keyframes scanLine {
            0% { top: 0%; }
            50% { top: 100%; }
            100% { top: 0%; }
        }
        .scan-line {
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background: #00ff00;
            box-shadow: 0 0 10px #00ff00;
            animation: scanLine 2s linear infinite;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center p-6">
        
        <!-- CONTENEDOR PRINCIPAL -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl overflow-hidden relative min-h-[550px] flex flex-col md:flex-row">

            <!-- FORMULARIO DE BÚSQUEDA -->
            <div id="searchSection" class="w-full md:w-1/2 p-8 border-r border-gray-200 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <a href="/dashboard" class="text-gray-400 hover:text-gray-600 mr-4 transition" title="Volver">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-800">Procesar Salida</h2>
                </div>

                <p class="text-gray-500 mb-6 text-sm">Escanea el ticket QR o ingresa la placa manualmente.</p>

                <form id="exitForm" onsubmit="calculateFee(event)" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Código de Boleto / Placa</label>
                        
                        <!-- INPUT CON BOTÓN DE ESCÁNER -->
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="material-icons text-gray-400">confirmation_number</i>
                                </div>
                                <input type="text" id="searchInput"
                                    class="pl-10 w-full rounded-lg border border-gray-300 p-3 text-gray-900 focus:ring-green-500 focus:border-green-500 uppercase font-mono text-xl tracking-wider font-bold" 
                                    placeholder="ABC-123" 
                                    required
                                    autofocus>
                            </div>
                            
                            <button type="button" onclick="openScanner()" class="bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 px-4 rounded-lg flex items-center justify-center transition shadow-sm group" title="Abrir Cámara">
                                <i class="material-icons text-2xl group-hover:scale-110 transition">qr_code_scanner</i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Presiona el icono de QR para usar la cámara.</p>
                    </div>

                    <button type="submit" id="searchBtn" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition-colors">
                        <i class="material-icons text-sm">search</i> Buscar Vehículo
                    </button>
                </form>

                <!-- Info Box -->
                <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-100 flex items-start gap-3">
                    <i class="material-icons text-blue-500">info</i>
                    <p class="text-xs text-blue-700">
                        Tarifa actual: <strong>$20.00 / hora</strong>.<br>
                        Tolerancia: 15 minutos después del pago.
                    </p>
                </div>
            </div>

            <!-- RESUMEN DE PAGO  -->
            <div id="paymentSection" class="w-full md:w-1/2 bg-gray-50 p-8 flex flex-col justify-center relative overflow-hidden">
                
                <!-- ESTADO INICIAL (VACÍO) -->
                <div id="emptyState" class="text-center text-gray-400">
                    <i class="material-icons text-6xl opacity-20">receipt_long</i>
                    <p class="mt-2 text-sm">Ingresa una placa para ver el cobro.</p>
                </div>

                <!-- ESTADO DETALLE (OCULTO) -->
                <div id="detailsState" class="hidden w-full relative z-10 animate-scale">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-green-200 rounded-full opacity-20 pointer-events-none"></div>
                    
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 uppercase tracking-wide border-b border-gray-200 pb-2">Resumen de Pago</h3>
                    
                    <div class="space-y-3 mb-6 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Vehículo / Token</span>
                            <span class="font-mono font-bold text-gray-800 text-lg" id="resPlate">---</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Hora Entrada</span>
                            <span class="font-medium text-gray-800" id="resEntry">---</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Hora Salida</span>
                            <span class="font-medium text-gray-800" id="resExit">---</span>
                        </div>
                        <div class="flex justify-between bg-gray-200 p-2 rounded">
                            <span class="text-gray-700 font-bold">Tiempo Total</span>
                            <span class="font-bold text-gray-900" id="resTime">---</span>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border-2 border-green-500 shadow-md mb-6 text-center transform scale-105">
                        <span class="block text-xs text-gray-500 uppercase mb-1">Total a Pagar</span>
                        <span class="block text-5xl font-extrabold text-green-600" id="resTotal">$0.00</span>
                    </div>

                    <button onclick="processPayment()" class="w-full py-4 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold shadow-lg shadow-green-500/30 transition transform hover:scale-[1.02] flex justify-center items-center gap-2">
                        <i class="material-icons">payments</i> Confirmar Pago y Abrir
                    </button>
                    
                    <button onclick="resetExit()" class="w-full mt-3 py-2 text-gray-400 hover:text-gray-600 text-xs underline">Cancelar</button>
                </div>

                <!-- ESTADO ÉXITO  -->
                <div id="successState" class="hidden w-full text-center animate-scale">
                    <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="material-icons text-5xl">check_circle</i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">¡Pago Exitoso!</h2>
                    <p class="text-gray-600 mb-6">La barrera se ha levantado.</p>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200 mb-6">
                        <p class="text-xs text-green-800 uppercase font-bold">Mensaje al Conductor</p>
                        <p class="text-lg font-serif italic text-gray-700">"Gracias por su visita, buen viaje."</p>
                    </div>
                    <button onclick="resetExit()" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-900 transition">
                        Procesar Siguiente Auto
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- SIMULADOR DE ESCÁNER  -->
    <div id="scannerModal" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden flex flex-col items-center justify-center">
        <div class="relative w-full max-w-sm bg-gray-900 rounded-xl overflow-hidden aspect-[3/4] shadow-2xl border border-gray-700">
            <!-- Marco de la cámara -->
            <div class="absolute inset-0 z-10 border-2 border-green-500 opacity-50 m-8 rounded-lg">
                <!-- Línea de escaneo animada -->
                <div class="scan-line"></div>
            </div>
            
            <!-- Mensaje -->
            <div class="absolute bottom-0 w-full bg-black bg-opacity-60 p-4 text-center z-20 backdrop-blur-sm">
                <p class="text-white text-sm font-medium animate-pulse">Buscando código QR...</p>
                <button onclick="closeScanner()" class="mt-4 text-gray-400 text-xs hover:text-white underline">Cancelar Escaneo</button>
            </div>

            <!-- Placeholder de Video -->
            <div class="w-full h-full flex items-center justify-center bg-gray-800">
                <i class="material-icons text-8xl text-gray-700">videocam</i>
            </div>
        </div>
    </div>

    <script>
        // --- LÓGICA DEL ESCÁNER ---
        
        function openScanner() {
            const modal = document.getElementById('scannerModal');
            modal.classList.remove('hidden');

            setTimeout(() => {
                closeScanner();

                // Rellenar el campo automáticamente con un TOKEN simulado
                const input = document.getElementById('searchInput');
                input.value = "QRP-TOKEN-8821"; 
                
                // Disparar la búsqueda automáticamente
                const fakeEvent = { preventDefault: () => {} };
                calculateFee(fakeEvent);

            }, 2000);
        }

        function closeScanner() {
            document.getElementById('scannerModal').classList.add('hidden');
        }

        // --- LÓGICA DE COBRO ---

        function calculateFee(e) {
            e.preventDefault();
            const btn = document.getElementById('searchBtn');
            const input = document.getElementById('searchInput');
            
            if(!input.value) return;

            // UI Loading
            btn.innerHTML = '<i class="material-icons animate-spin text-sm">refresh</i> Buscando...';
            
            setTimeout(() => {
                // Datos simulados
                const plate = input.value.toUpperCase();
                const now = new Date();
                const entryTime = new Date(now.getTime() - (3 * 60 * 60 * 1000) - (15 * 60 * 1000)); // -3h 15m
                
                const hours = 4; 
                const rate = 20;
                const total = hours * rate;

                // Rellenar datos
                document.getElementById('resPlate').innerText = plate;
                document.getElementById('resEntry').innerText = entryTime.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                document.getElementById('resExit').innerText = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                document.getElementById('resTime').innerText = "3h 15m";
                document.getElementById('resTotal').innerText = "$" + total + ".00";

                // Cambiar vista
                document.getElementById('emptyState').classList.add('hidden');
                document.getElementById('detailsState').classList.remove('hidden');
                document.getElementById('successState').classList.add('hidden');
                
                btn.innerHTML = '<i class="material-icons text-sm">search</i> Buscar Vehículo';
                
            }, 800);
        }

        function processPayment() {
            const btn = document.querySelector('#detailsState button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="material-icons animate-spin">refresh</i> Procesando...';
            
            setTimeout(() => {
                document.getElementById('detailsState').classList.add('hidden');
                document.getElementById('successState').classList.remove('hidden');
                btn.innerHTML = originalText;
            }, 1500);
        }

        function resetExit() {
            document.getElementById('exitForm').reset();
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('detailsState').classList.add('hidden');
            document.getElementById('successState').classList.add('hidden');
            document.getElementById('searchInput').focus();
        }
    </script>

</body>
</html>