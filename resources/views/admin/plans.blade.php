<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Planes de Usuarios | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Membresías y Pensiones</h1>
                <p class="text-gray-500 text-sm">Crea paquetes recurrentes para tus clientes frecuentes.</p>
            </div>
            <div class="flex gap-3">
                <a href="/dashboard" class="px-4 py-2 text-gray-600 hover:bg-white rounded-lg transition flex items-center gap-2">
                    <i class="material-icons text-sm">arrow_back</i> Volver
                </a>
                <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 shadow-lg shadow-blue-500/30 transition transform hover:scale-105">
                    <i class="material-icons text-sm">add</i> Nuevo Plan
                </button>
            </div>
        </div>

        <!-- LISTA DE PLANES ACTIVOS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Plan 1: Pensión Completa -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden relative group">
                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition">
                    <i class="material-icons text-6xl text-blue-600">directions_car</i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded uppercase">Mensual</span>
                        <div class="flex gap-2">
                            <button class="text-gray-400 hover:text-blue-600"><i class="material-icons text-sm">edit</i></button>
                            <button class="text-gray-400 hover:text-red-500"><i class="material-icons text-sm">delete</i></button>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-1">Pensión 24/7</h3>
                    <p class="text-sm text-gray-500 mb-6">Acceso ilimitado día y noche.</p>
                    
                    <div class="flex items-end gap-1 mb-6">
                        <span class="text-3xl font-bold text-gray-800">$1,200</span>
                        <span class="text-gray-500 text-sm mb-1">/mes</span>
                    </div>

                    <div class="border-t pt-4 flex justify-between items-center">
                        <span class="text-xs text-gray-500">Suscriptores Activos</span>
                        <span class="flex items-center gap-1 font-bold text-gray-700">
                            <i class="material-icons text-xs text-green-500">people</i> 12
                        </span>
                    </div>
                </div>
            </div>

            <!-- Plan 2: Nocturno -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden relative group">
                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition">
                    <i class="material-icons text-6xl text-indigo-600">nights_stay</i>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-1 rounded uppercase">Mensual</span>
                        <div class="flex gap-2">
                            <button class="text-gray-400 hover:text-blue-600"><i class="material-icons text-sm">edit</i></button>
                            <button class="text-gray-400 hover:text-red-500"><i class="material-icons text-sm">delete</i></button>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-1">Pensión Nocturna</h3>
                    <p class="text-sm text-gray-500 mb-6">Solo de 20:00 a 08:00 hrs.</p>
                    
                    <div class="flex items-end gap-1 mb-6">
                        <span class="text-3xl font-bold text-gray-800">$800</span>
                        <span class="text-gray-500 text-sm mb-1">/mes</span>
                    </div>

                    <div class="border-t pt-4 flex justify-between items-center">
                        <span class="text-xs text-gray-500">Suscriptores Activos</span>
                        <span class="flex items-center gap-1 font-bold text-gray-700">
                            <i class="material-icons text-xs text-green-500">people</i> 45
                        </span>
                    </div>
                </div>
            </div>

            <!-- Crear Nuevo (Placeholder visual) -->
            <button onclick="openCreateModal()" class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 text-gray-400 hover:border-blue-400 hover:text-blue-500 transition group h-full min-h-[250px]">
                <div class="bg-gray-100 p-4 rounded-full mb-3 group-hover:bg-blue-50 transition">
                    <i class="material-icons text-3xl">add</i>
                </div>
                <span class="font-bold">Crear Nuevo Plan</span>
            </button>

        </div>
    </div>

    <!-- MODAL CREAR PLAN -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all scale-100">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Nuevo Paquete</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="savePlan(event)" class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nombre del Plan</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej. Pase Fin de Semana" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Precio</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input type="number" class="w-full border border-gray-300 rounded-lg p-2 pl-6 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="0.00" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Periodo</label>
                        <select class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="mensual">Mensual</option>
                            <option value="semanal">Semanal</option>
                            <option value="anual">Anual</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Beneficios / Descripción</label>
                    <textarea class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none h-24" placeholder="Describe las reglas (ej. horario limitado, lugar reservado...)"></textarea>
                </div>

                <div class="bg-blue-50 p-3 rounded-lg flex gap-3 items-start">
                    <i class="material-icons text-blue-600 text-sm mt-0.5">info</i>
                    <p class="text-xs text-blue-800">Al crear este plan, aparecerá visible en la app de los usuarios cercanos a tu ubicación.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeCreateModal()" class="flex-1 py-3 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition">Cancelar</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition">Publicar Plan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        function savePlan(e) {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="material-icons animate-spin text-sm">refresh</i> Guardando...';

            setTimeout(() => {
                alert('Plan publicado exitosamente.\n(DB: INSERT INTO planes WHERE ambito="usuario" AND estacionamiento_id=X)');
                closeCreateModal();
                btn.disabled = false;
                btn.innerText = originalText;
            }, 1000);
        }
    </script>
</body>
</html>