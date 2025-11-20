<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Términos y Privacidad | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="max-w-4xl mx-auto px-6 py-12">
        
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-2 text-blue-600">
                <i class="material-icons">gavel</i>
                <span class="font-bold text-xl">QR-Parking Legal</span>
            </div>
            <button onclick="smartBack()" class="text-gray-500 hover:text-gray-800 flex items-center gap-1 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 transition">
                <i class="material-icons text-sm">arrow_back</i> Volver
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-h-[600px] flex flex-col">
            
            <!-- NAVEGACIÓN -->
            <div class="flex border-b border-gray-200 bg-gray-50">
                <button onclick="switchTab('terms')" id="tab-terms" class="flex-1 px-6 py-4 font-bold text-blue-600 border-b-2 border-blue-600 bg-white hover:bg-gray-50 transition">
                    Términos y Condiciones
                </button>
                <button onclick="switchTab('privacy')" id="tab-privacy" class="flex-1 px-6 py-4 font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-100 transition">
                    Aviso de Privacidad
                </button>
            </div>

            <div class="p-8 overflow-y-auto flex-1">
                
                <!-- TÉRMINOS Y CONDICIONES -->
                <div id="content-terms" class="space-y-6 text-sm leading-relaxed text-gray-600 animate-fade-in">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Términos y Condiciones de Uso</h2>
                    
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">1. Aceptación del Servicio</h3>
                        <p>Al descargar, acceder o utilizar la plataforma QR-Parking, usted acepta estar legalmente vinculado por estos términos. El servicio se proporciona para facilitar el acceso, control y pago en estacionamientos afiliados.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">2. Cuentas y Seguridad</h3>
                        <p>Usted es responsable de mantener la confidencialidad de su contraseña. QR-Parking no se hace responsable por accesos no autorizados derivados de negligencia en el cuidado de sus credenciales o dispositivos.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">3. Pagos y Tarifas</h3>
                        <p>Las tarifas de estacionamiento son establecidas por cada establecimiento. QR-Parking cobra una comisión por servicio tecnológico detallada en cada transacción. Al agregar un método de pago, usted autoriza los cargos automáticos al salir de un estacionamiento.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">4. Responsabilidad Civil</h3>
                        <p>QR-Parking actúa únicamente como intermediario tecnológico. Cualquier daño, robo o incidente ocurrido dentro de las instalaciones del estacionamiento es responsabilidad del operador del mismo y del usuario, conforme a la ley aplicable.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">5. Cancelaciones</h3>
                        <p>Las suscripciones Premium pueden cancelarse en cualquier momento desde el perfil de usuario. No existen reembolsos parciales por periodos no utilizados.</p>
                    </div>
                </div>

                <!-- AVISO DE PRIVACIDAD -->
                <div id="content-privacy" class="hidden space-y-6 text-sm leading-relaxed text-gray-600 animate-fade-in">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Aviso de Privacidad Integral</h2>
                    
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 mb-6">
                        <p class="text-blue-800 text-xs font-bold uppercase mb-1">Identidad del Responsable</p>
                        <p><strong>QR-Parking S.A. de C.V.</strong>, con domicilio en Sierra de Ixtlan 104, Estado de México, es responsable del uso y protección de sus datos personales.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">¿Qué datos recabamos?</h3>
                        <ul class="list-disc pl-5 space-y-1">
                            <li><strong>Datos de Identificación:</strong> Nombre completo, número de teléfono celular.</li>
                            <li><strong>Datos del Vehículo:</strong> Número de placa, modelo y color (para control de accesos).</li>
                            <li><strong>Datos Patrimoniales:</strong> Historial de pagos, datos de tarjetas bancarias (tokenizados y procesados vía Stripe/PayPal).</li>
                            <li><strong>Datos de Ubicación:</strong> Geolocalización en tiempo real para sugerir estacionamientos cercanos.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">¿Para qué usamos sus datos?</h3>
                        <p>Las finalidades principales son:</p>
                        <ul class="list-disc pl-5 space-y-1 mt-2">
                            <li>Crear su cuenta y perfil de usuario único.</li>
                            <li>Procesar pagos automáticos de tarifas de estacionamiento.</li>
                            <li>Emitir comprobantes fiscales y facturas.</li>
                            <li>Validar su identidad mediante autenticación de dos factores (SMS/Email).</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Transferencia de Datos</h3>
                        <p>Sus datos pueden ser compartidos con:</p>
                        <ul class="list-disc pl-5 space-y-1 mt-2">
                            <li><strong>Operadores de Estacionamiento:</strong> Solo se comparte su número de placa y hora de entrada para fines operativos.</li>
                            <li><strong>Proveedores de Pago:</strong> Para procesar los cargos bancarios de forma segura.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Derechos ARCO</h3>
                        <p>Usted tiene derecho a Acceder, Rectificar, Cancelar u Oponerse al tratamiento de sus datos. Para ejercer estos derechos, envíe un correo a <strong>privacidad@qr-parking.com</strong>.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>

        function smartBack() {
            if (window.history.length > 1 && document.referrer) {
                window.history.back();
            } else {
                try {
                    window.close();
                } catch(e) {}
                
                // Ir al inicio
                setTimeout(() => {
                    window.location.href = '/';
                }, 100);
            }
        }
        function switchTab(tab) {
            // Referencias
            const btnTerms = document.getElementById('tab-terms');
            const btnPrivacy = document.getElementById('tab-privacy');
            const contentTerms = document.getElementById('content-terms');
            const contentPrivacy = document.getElementById('content-privacy');

            const activeClass = ['text-blue-600', 'border-blue-600', 'bg-white', 'font-bold'];
            const inactiveClass = ['text-gray-500', 'border-transparent', 'font-medium'];

            if (tab === 'terms') {
                // Mostrar Términos
                contentTerms.classList.remove('hidden');
                contentPrivacy.classList.add('hidden');

                btnTerms.classList.add(...activeClass);
                btnTerms.classList.remove(...inactiveClass);
                btnPrivacy.classList.remove(...activeClass);
                btnPrivacy.classList.add(...inactiveClass);
            } else {
                // Mostrar Privacidad
                contentPrivacy.classList.remove('hidden');
                contentTerms.classList.add('hidden');

                btnPrivacy.classList.add(...activeClass);
                btnPrivacy.classList.remove(...inactiveClass);
                btnTerms.classList.remove(...activeClass);
                btnTerms.classList.add(...inactiveClass);
            }
        }
    </script>

</body>
</html>