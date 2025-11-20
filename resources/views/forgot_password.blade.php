<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Recuperar Contraseña | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-6">
            <div class="bg-blue-100 p-3 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i class="material-icons text-3xl text-blue-600">lock_reset</i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">¿Olvidaste tu contraseña?</h2>
            <p class="text-gray-500 text-sm mt-2">No te preocupes, te enviaremos las instrucciones para restablecerla.</p>
        </div>

        <form onsubmit="sendRecoveryLink(event)" class="space-y-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                <input type="email" id="recoveryEmail" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-blue-500 focus:outline-none transition" placeholder="ejemplo@correo.com" required>
            </div>
            
            <button type="submit" id="btnSend" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md">
                Enviar enlace de recuperación
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/login" class="text-sm text-gray-500 hover:text-gray-800 flex items-center justify-center gap-1 transition">
                <i class="material-icons text-sm">arrow_back</i> Volver al inicio de sesión
            </a>
        </div>
    </div>

    <script>
        function sendRecoveryLink(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSend');
            const email = document.getElementById('recoveryEmail').value;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="material-icons animate-spin text-sm">refresh</i> Enviando...';
            
            setTimeout(() => {
                alert(`Hemos enviado un correo a ${email} con un enlace para crear una nueva contraseña.`);
                window.location.href = '/login';
            }, 1500);
        }
    </script>
</body>
</html>