<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR-Parking | Bienvenido</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: sans-serif; }</style>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h-4v-4H8m13-4V7a1 1 0 00-1-1H4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        QR-Parking
                    </a>
                </div>
                <!-- BOTÓN DE ACCESO -->
                <div class="flex items-center">
                    <a href="/login" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition font-medium shadow-lg shadow-blue-500/30 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Gestión de parking</span>
                            <span class="block text-blue-600 xl:inline">inteligente y segura</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Plataforma integral para usuarios y administradores de estacionamientos. Controla accesos, gestiona suscripciones y monitorea tu saldo en tiempo real.
                        </p>
                        <div class="mt-8">
                            <a href="/login" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                Acceder a mi cuenta
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1590674899505-86c5932a8b75?ixlib=rb-1.2.1&auto=format&fit=crop&w=2850&q=80" alt="Parking technology">
        </div>
        <!-- Imagen -->
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1506521781263-d8422e82f27a?ixlib=rb-1.2.1&auto=format&fit=crop&w=2850&q=80" alt="Estacionamiento moderno">
        </div>
    </div>

    <!-- Pie de pagina -->
    <footer class="bg-slate-800 border-t border-slate-700 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <p class="text-center text-base text-slate-400">
                &copy; 2024 QR-Parking System.
            </p>
            <div class="mt-4 flex space-x-4 text-sm text-slate-500">
                <a href="/legal/terminos" class="hover:text-slate-300 transition">Términos y Condiciones</a>
                <span>|</span>
                <a href="/legal/terminos" class="hover:text-slate-300 transition">Aviso de Privacidad</a>
            </div>
        </div>
    </footer>
</body>
</html>
