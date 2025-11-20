<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Crear Cuenta | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .invalid { border-color: #ef4444; animation: shake 0.2s ease-in-out; }
        .valid { border-color: #22c55e; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-blue-900 p-6 text-center">
            <h2 class="text-2xl font-bold text-white tracking-wide">Registro Seguro</h2>
            <p class="text-blue-200 text-sm mt-1">Crea tu identidad digital en QR-Parking</p>
        </div>

        <div class="p-8">
            <form id="registerForm" onsubmit="handleRegister(event)" class="space-y-6">
                
                <!-- IDENTIDAD -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre Completo *</label>
                        <div class="relative">
                            <i class="material-icons absolute left-3 top-3 text-gray-400">person</i>
                            <input type="text" name="nombre" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" placeholder="Ej. Juan Pérez" required>
                        </div>
                    </div>

                    <!-- Fecha Nacimiento -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Nacimiento</label>
                        <div class="relative">
                            <i class="material-icons absolute left-3 top-3 text-gray-400">calendar_today</i>
                            <input type="date" name="fecha_nacimiento" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none transition">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Opcional. Para validar mayoría de edad.</p>
                    </div>
                </div>

                <!-- CONTACTO Y UNICIDAD  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico *</label>
                        <div class="relative">
                            <i class="material-icons absolute left-3 top-3 text-gray-400">email</i>
                            <input type="email" id="emailInput" onblur="simulateUniqueCheck(this, 'email')" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none transition" placeholder="juan@correo.com" required>
                            <!-- Icono de estado -->
                            <i id="emailStatus" class="material-icons absolute right-3 top-3 text-gray-400 text-sm hidden">check_circle</i>
                        </div>
                        <p id="emailFeedback" class="text-xs text-red-500 mt-1 hidden">Este correo ya está registrado.</p>
                    </div>

                    <!-- Teléfono  -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono Celular *</label>
                        <div class="relative">
                            <i class="material-icons absolute left-3 top-3 text-gray-400">smartphone</i>
                            <input type="tel" id="phoneInput" onblur="simulateUniqueCheck(this, 'phone')" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none transition" placeholder="55 1234 5678" required>
                            <i id="phoneStatus" class="material-icons absolute right-3 top-3 text-gray-400 text-sm hidden">check_circle</i>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Será usado para verificar tu identidad (2FA).</p>
                    </div>
                </div>

                <!-- SEGURIDAD -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña *</label>
                    <div class="relative">
                        <i class="material-icons absolute left-3 top-3 text-gray-400">lock</i>
                        <input type="password" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 outline-none transition" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- TIPO DE CUENTA  -->
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <span class="block text-sm font-bold text-blue-900 mb-2">Tipo de Cuenta *</span>
                    <div class="flex gap-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="rol" value="usuario" class="text-blue-600 focus:ring-blue-500" checked>
                            <span class="ml-2 text-sm text-gray-700">Conductor / Usuario</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="rol" value="estacionamiento" class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Dueño de Estacionamiento</span>
                        </label>
                    </div>
                </div>

                <!--LEGAL  -->
                <div class="border-t pt-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" id="legalCheck" onchange="toggleSubmit()" class="mt-1 h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <span class="text-sm text-gray-600">
                            He leído y acepto los <a href="/legal/terminos" target="_blank" class="text-blue-600 hover:underline font-medium">Términos y Condiciones</a> y el <a href="/legal/terminos" target="_blank" class="text-blue-600 hover:underline font-medium">Aviso de Privacidad</a>. Entiendo que al registrarme se guardará una constancia de esta aceptación.
                        </span>
                    </label>
                </div>

                <button type="submit" id="submitBtn" disabled class="w-full bg-gray-400 cursor-not-allowed text-white font-bold py-3 rounded-lg transition duration-300 shadow-lg flex justify-center items-center gap-2">
                    <span>Registrar Cuenta</span>
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/login" class="text-sm text-blue-600 hover:underline">¿Ya tienes cuenta? Inicia Sesión</a>
            </div>
        </div>
    </div>

    <script>
        function toggleSubmit() {
            const check = document.getElementById('legalCheck');
            const btn = document.getElementById('submitBtn');
            if (check.checked) {
                btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                btn.classList.add('bg-blue-600', 'hover:bg-blue-700');
                btn.disabled = false;
            } else {
                btn.classList.add('bg-gray-400', 'cursor-not-allowed');
                btn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                btn.disabled = true;
            }
        }

        // Simulación de validación en base de datos
        function simulateUniqueCheck(input, type) {
            const feedback = type === 'email' ? document.getElementById('emailFeedback') : null;
            const statusIcon = document.getElementById(type + 'Status');
            
            // Limpiar estado previo
            input.classList.remove('valid', 'invalid');
            statusIcon.classList.add('hidden');
            if(feedback) feedback.classList.add('hidden');

            if (input.value.length > 0) {
                setTimeout(() => {
                    if (type === 'email' && input.value === 'test@test.com') {
                        input.classList.add('invalid');
                        if(feedback) feedback.classList.remove('hidden');
                        statusIcon.innerText = 'error';
                        statusIcon.classList.remove('hidden', 'text-green-500');
                        statusIcon.classList.add('text-red-500');
                    } else {
                        input.classList.add('valid');
                        statusIcon.innerText = 'check_circle';
                        statusIcon.classList.remove('hidden', 'text-red-500');
                        statusIcon.classList.add('text-green-500');
                    }
                }, 500);
            }
        }

        function handleRegister(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Procesando...';
            
            setTimeout(() => {
                alert('Registro Exitoso.\nSe ha creado el registro en "aceptaciones_legales_usuarios".');
                window.location.href = '/login';
            }, 1500);
        }
    </script>
</body>
</html>