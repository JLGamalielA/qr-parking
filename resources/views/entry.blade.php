<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Entrada | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        /* Animación de guardar ticket */
        @keyframes printSlide {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .ticket-animation { animation: printSlide 0.6s ease-out forwards; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center p-6">
        
        <!-- CONTENEDOR PRINCIPAL -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden relative min-h-[500px]">
            
            <!-- FORMULARIO DE REGISTRO -->
            <div id="formView" class="transition-all duration-300">
                <div class="bg-blue-600 p-6 text-center relative">
                    <a href="/dashboard" class="absolute left-4 top-6 text-white hover:text-blue-200 transition" title="Volver al Panel">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <h2 class="text-2xl font-bold text-white">Registrar Entrada</h2>
                    <p class="text-blue-100 mt-1">Ingresa los datos del vehículo</p>
                </div>

                <div class="p-8">
                    <form id="entryForm" onsubmit="generateTicket(event)" class="space-y-6">
                        
                        <!-- Placa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número de Placa</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="material-icons text-gray-400">aspect_ratio</i>
                                </div>
                                <input type="text" id="plateInput"
                                    class="pl-10 w-full rounded-lg border border-gray-300 p-3 text-gray-900 focus:ring-blue-500 focus:border-blue-500 uppercase font-mono text-xl tracking-wider font-bold" 
                                    placeholder="ABC-123" 
                                    required 
                                    maxlength="10"
                                    autofocus>
                            </div>
                        </div>

                        <!-- Tipo De Vehiculo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Vehículo</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="tipo" value="Auto" class="peer sr-only" checked>
                                    <div class="rounded-lg border border-gray-200 p-3 text-center hover:bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-600 transition">
                                        <i class="material-icons">directions_car</i>
                                        <span class="block text-xs font-medium mt-1">Auto</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="tipo" value="Moto" class="peer sr-only">
                                    <div class="rounded-lg border border-gray-200 p-3 text-center hover:bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-600 transition">
                                        <i class="material-icons">two_wheeler</i>
                                        <span class="block text-xs font-medium mt-1">Moto</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="tipo" value="Camioneta" class="peer sr-only">
                                    <div class="rounded-lg border border-gray-200 p-3 text-center hover:bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-600 transition">
                                        <i class="material-icons">local_shipping</i>
                                        <span class="block text-xs font-medium mt-1">Camioneta</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-transform transform hover:scale-[1.02]">
                            <i class="material-icons">qr_code</i> Generar Boleto
                        </button>
                    </form>
                </div>
            </div>

            <!-- BOLETO GENERADO  -->
            <div id="ticketView" class="hidden bg-gray-800 text-white h-full absolute inset-0 flex flex-col items-center justify-center p-6">
                
                <div class="bg-white text-gray-800 rounded-lg shadow-2xl p-6 w-full max-w-sm ticket-animation relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-blue-600"></div>
                    
                    <div class="text-center border-b-2 border-dashed border-gray-300 pb-4 mb-4">
                        <h3 class="text-xl font-bold text-gray-900">QR-Parking</h3>
                        <p class="text-xs text-gray-500">Plaza Central - Acceso Norte</p>
                        <p class="text-xs text-gray-400 mt-1" id="ticketDate">Fecha</p>
                    </div>

                    <div class="flex justify-center py-2">
                        <!-- QR  Dinamico -->
                        <img id="qrImage" src="" alt="Código QR" class="w-40 h-40 border-4 border-gray-900 rounded-lg">
                    </div>

                    <div class="text-center mt-4 space-y-1">
                        <p class="text-3xl font-mono font-bold tracking-wider text-gray-900" id="displayPlate">ABC-123</p>
                        <p class="text-sm text-gray-500 bg-gray-100 rounded px-2 py-1 inline-block font-medium" id="displayType">Auto Particular</p>
                    </div>

                    <div class="mt-6 pt-4 border-t-2 border-dashed border-gray-300 text-center">
                        <p class="text-xs text-gray-400">Conserva este boleto para tu salida.</p>
                        <p class="text-xs font-mono font-bold mt-1 text-gray-600" id="ticketToken">TOKEN: QRP-88219</p>
                    </div>
                </div>

                <div class="mt-8 w-full space-y-3 text-center">
                    <div class="flex gap-3 justify-center">
                         <!-- Boton de descarga -->
                        <button onclick="printTicket()" class="bg-white text-gray-900 px-4 py-2 rounded-full font-bold hover:bg-gray-200 transition flex items-center gap-2">
                            <i class="material-icons text-sm">download</i> Descargar
                        </button>
                         <!-- Boton de generar otro Qr -->
                        <button onclick="resetForm()" class="bg-blue-600 text-white px-4 py-2 rounded-full font-bold hover:bg-blue-500 transition flex items-center gap-2">
                            <i class="material-icons text-sm">add</i> Nuevo
                        </button>
                    </div>
                    <a href="/dashboard" class="inline-block text-gray-400 hover:text-white text-sm underline mt-4">Volver al Inicio </a>
                </div>

            </div>

        </div>
    </div>

    <script>
        function generateTicket(e) {
            e.preventDefault();

            // Obtener datos
            const plate = document.getElementById('plateInput').value.toUpperCase();
            const type = document.querySelector('input[name="tipo"]:checked').value;
            
            // Generar datos 
            const now = new Date();
            const dateString = now.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });
            const randomToken = 'QRP-' + Math.floor(10000 + Math.random() * 90000);

            // Rellenar el boleto
            document.getElementById('displayPlate').innerText = plate;
            document.getElementById('displayType').innerText = type;
            document.getElementById('ticketDate').innerText = dateString;
            document.getElementById('ticketToken').innerText = "TOKEN: " + randomToken;

            // Generar QR real usando API
            const qrData = `${plate}|${randomToken}|${now.getTime()}`;
            document.getElementById('qrImage').src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrData}`;

            // 5. Cambiar vista 
            document.getElementById('formView').classList.add('hidden');
            document.getElementById('ticketView').classList.remove('hidden');
        }

        function resetForm() {
            // Limpiar y volver
            document.getElementById('entryForm').reset();
            document.getElementById('ticketView').classList.add('hidden');
            document.getElementById('formView').classList.remove('hidden');
        }

        function printTicket() {
            alert("Descargando Codigo Qr...\n\n(Simulación: Boleto guardado exitosamente)");
        }
    </script>

</body>
</html>