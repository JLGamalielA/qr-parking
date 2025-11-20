<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Iniciar Sesión | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 relative overflow-hidden">
        
        <!-- Barra de carga superior -->
        <div id="loadingBar" class="absolute top-0 left-0 w-full h-1 bg-blue-200 hidden">
            <div class="h-full bg-blue-600 animate-[loading_2s_ease-in-out_infinite]" style="width: 50%"></div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Bienvenido</h2>
            <p class="text-gray-500 text-sm">Gestión de Accesos Segura</p>
        </div>

        <!-- FORMULARIO DE LOGIN NORMAL -->
        <div id="loginSection" class="transition-opacity duration-500">
            <form onsubmit="handleLoginStep1(event)" class="space-y-6">
                
                <!-- Usuario: Email o Teléfono -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Usuario</label>
                    <div class="relative">
                        <i class="material-icons absolute left-3 top-3 text-gray-400">person</i>
                        <input type="text" id="loginUser" class="w-full pl-10 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-blue-500 focus:bg-white focus:outline-none transition" placeholder="Correo o Teléfono" required>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
                    <div class="relative">
                        <i class="material-icons absolute left-3 top-3 text-gray-400">lock</i>
                        <input type="password" class="w-full pl-10 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-blue-500 focus:bg-white focus:outline-none transition" placeholder="••••••••" required>
                    </div>
                    <div class="text-right mt-2">
                        <a href="/recuperar-password" class="text-xs text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                
                <button type="submit" id="btnLogin" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md">
                    Entrar
                </button>
            </form>
            
            <div class="mt-6 text-center border-t pt-4">
                <p class="text-sm text-gray-600">¿No tienes cuenta?</p>
                <a href="/register" class="text-blue-600 font-bold hover:underline">Regístrate aquí</a>
            </div>
        </div>

        <!-- VERIFICACIÓN DE DISPOSITIVO  -->
        <div id="deviceCheckSection" class="hidden text-center space-y-6 animate-fade-in-up">
            <div class="bg-yellow-50 p-4 rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                <i class="material-icons text-4xl text-yellow-600">phonelink_lock</i>
            </div>
            
            <div>
                <h3 class="text-xl font-bold text-gray-800">Dispositivo Nuevo Detectado</h3>
                <p class="text-sm text-gray-600 mt-2 px-4">
                    No reconocemos este dispositivo en tu historial (Tabla: <code class="text-xs bg-gray-100 p-1">vinculos_dispositivo</code>).
                    <br><br>
                    Por seguridad, hemos enviado un código de 6 dígitos a tu correo/teléfono registrado.
                </p>
            </div>

            <form onsubmit="handleVerifyDevice(event)" class="space-y-4">
                <input type="text" class="w-3/4 mx-auto text-center text-2xl tracking-[0.5em] font-mono py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none uppercase" placeholder="______" maxlength="6" required>
                
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition shadow-md">
                    Verificar Dispositivo
                </button>
            </form>
            
            <button onclick="cancel2FA()" class="text-sm text-gray-400 hover:text-gray-600 underline">Cancelar y volver</button>
        </div>

    </div>

    <style>
        @keyframes loading { 0% { left: -50%; } 100% { left: 100%; } }
    </style>

    <script>
        // SIMULACION DE BASE DE DATOS
        
        function handleLoginStep1(e) {
            e.preventDefault();
            
            const user = document.getElementById('loginUser').value;
            const btn = document.getElementById('btnLogin');
            const loading = document.getElementById('loadingBar');

            // Mostrar carga
            btn.disabled = true;
            btn.innerText = 'Verificando credenciales...';
            btn.classList.add('bg-blue-400');
            loading.classList.remove('hidden');

            // Tiempo de respuesta del servidor
            setTimeout(() => {
                
                if (user.toLowerCase().includes('nuevo')) {
                    //  Dispositivo Nuevo
                    console.log('DB: No existe match en vinculos_dispositivo. Iniciando 2FA.');
                    triggerNewDeviceFlow();
                } else {
                    // Dispositivo Conocido
                    console.log('DB: Match encontrado en vinculos_dispositivo. Acceso concedido.');
                    window.location.href = '/dashboard-decision'; 
                }
            }, 1500);
        }

        function triggerNewDeviceFlow() {
            const loginSec = document.getElementById('loginSection');
            const deviceSec = document.getElementById('deviceCheckSection');
            const loading = document.getElementById('loadingBar');

            // Ocultar login
            loading.classList.add('hidden');
            loginSec.classList.add('hidden');
            deviceSec.classList.remove('hidden');
        }

        function handleVerifyDevice(e) {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            btn.innerHTML = 'Validando...';
            
            setTimeout(() => {
                alert('Dispositivo verificado y agregado a "vinculos_dispositivo".');
                window.location.href = '/dashboard-decision';
            }, 1000);
        }

        function cancel2FA() {
            window.location.reload();
        }
    </script>
</body>
</html>