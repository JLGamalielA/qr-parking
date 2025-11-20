<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Página no encontrada | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center text-center px-4">

    <div class="max-w-lg">
        <div class="relative mb-8 inline-block">
            <i class="material-icons text-9xl text-gray-300">directions_car</i>
            <div class="absolute -bottom-2 -right-2 bg-red-500 text-white rounded-full w-12 h-12 flex items-center justify-center border-4 border-gray-100">
                <i class="material-icons text-2xl">priority_high</i>
            </div>
        </div>

        <h1 class="text-6xl font-extrabold text-gray-800 mb-2">404</h1>
        <h2 class="text-2xl font-bold text-gray-700 mb-4">¡Ups! Te has perdido en el estacionamiento.</h2>
        <p class="text-gray-500 mb-8">La página que buscas no existe, ha sido movida o el lugar de estacionamiento ya fue ocupado.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                <i class="material-icons text-sm">home</i> Volver al Inicio
            </a>
            <a href="javascript:history.back()" class="bg-white text-gray-700 border border-gray-300 px-6 py-3 rounded-xl font-bold hover:bg-gray-50 transition flex items-center justify-center gap-2">
                Regresar
            </a>
        </div>
    </div>

</body>
</html>