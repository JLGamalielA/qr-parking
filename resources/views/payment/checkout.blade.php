<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Finalizar Compra | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; background-color: #f3f4f6; }</style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- RESUMEN DE COMPRA -->
        <div class="w-full md:w-1/3 bg-gray-900 text-white p-8 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 mb-8">
                    <i class="material-icons text-blue-400">local_parking</i>
                    <span class="font-bold text-xl">QR-Parking SaaS</span>
                </div>
                <p class="text-gray-400 text-xs uppercase font-bold tracking-widest mb-2">Estás comprando</p>
                <h2 class="text-3xl font-bold mb-2" id="planName">Cargando...</h2>
                <p class="text-gray-400 text-sm">Facturación mensual recurrente.</p>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-700">
                <div class="flex justify-between items-end">
                    <span class="text-sm text-gray-400">Total a pagar hoy</span>
                    <span class="text-4xl font-bold text-green-400" id="planPrice">...</span>
                </div>
                <p class="text-xs text-gray-500 mt-2">Incluye impuestos aplicables.</p>
            </div>
        </div>

        <!-- FORMULARIO DE PAGO  -->
        <div class="w-full md:w-2/3 p-8 md:p-12">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-gray-800">Detalles de Pago</h2>
                <div class="flex gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-6">
                </div>
            </div>

            <form onsubmit="processPayment(event)" class="space-y-6">
                <!-- Nombre -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nombre en la tarjeta</label>
                    <input type="text" class="w-full border-b-2 border-gray-200 p-2 focus:outline-none focus:border-blue-600 transition bg-transparent" placeholder="Juan Pérez" required>
                </div>

                <!-- Número Tarjeta -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Número de Tarjeta</label>
                    <div class="flex items-center border-b-2 border-gray-200 focus-within:border-blue-600 transition">
                        <i class="material-icons text-gray-400 mr-2">credit_card</i>
                        <input type="text" class="w-full p-2 focus:outline-none bg-transparent" placeholder="0000 0000 0000 0000" maxlength="19" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Expiración</label>
                        <input type="text" class="w-full border-b-2 border-gray-200 p-2 focus:outline-none focus:border-blue-600 transition bg-transparent" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">CVC</label>
                        <div class="flex items-center border-b-2 border-gray-200 focus-within:border-blue-600 transition">
                            <input type="password" class="w-full p-2 focus:outline-none bg-transparent" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" id="payBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.01] flex justify-center items-center gap-2">
                        <i class="material-icons">lock</i> Pagar y Activar
                    </button>
                    <a href="/suscripciones" class="block text-center text-gray-400 text-sm mt-4 hover:text-gray-600">Cancelar y volver</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Obtener datos de la URL
        const params = new URLSearchParams(window.location.search);
        const plan = params.get('plan') || 'Plan Desconocido';
        const price = params.get('price') || '0';

        document.getElementById('planName').innerText = "Licencia " + plan;
        document.getElementById('planPrice').innerText = "$" + price;

        function processPayment(e) {
            e.preventDefault();
            const btn = document.getElementById('payBtn');
            
            btn.disabled = true;
            btn.innerHTML = '<i class="material-icons animate-spin">refresh</i> Procesando pago...';

            setTimeout(() => {
                // 1. GUARDAR EN MEMORIA LA SUSCRIPCIÓN
                localStorage.setItem('parking_subscription_plan', plan);
                localStorage.setItem('parking_subscription_status', 'active');
                
                alert(' ¡Pago Exitoso!\nTu licencia ha sido activada.');
                
                // 2. REDIRIGIR A LA PANTALLA  "MI PLAN"
                window.location.href = '/suscripciones'; 
            }, 2000);
        }
    </script>
</body>
</html>