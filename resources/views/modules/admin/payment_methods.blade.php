<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Métodos de Pago | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r flex flex-col z-10 flex-shrink-0">
        <div class="h-16 bg-blue-900 flex items-center justify-center text-white font-bold shadow-md tracking-wider">
            ADMIN PARKING
        </div>
        <nav class="flex-1 py-4 overflow-y-auto">
            <ul class="space-y-1">
                <li>
                    <a href="/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 transition">
                        <i class="material-icons mr-3 text-gray-400">dashboard</i> Volver al menú
                    </a>
                </li>
                <li>
                    <a href="/suscripciones" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 transition">
                        <i class="material-icons mr-3 text-gray-400">receipt_long</i> Mi Facturación 
                    </a>
                </li>
                <!-- Activo -->
                <li>
                    <a href="#" class="flex items-center px-6 py-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600 font-medium">
                        <i class="material-icons mr-3">credit_card</i> Métodos de Pago
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- CONTENIDO -->
    <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
        
        <div class="p-8 max-w-5xl mx-auto w-full">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Billetera Digital</h1>
                    <p class="text-gray-500 text-sm">Gestiona las tarjetas para el pago de tu licencia de software.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10" id="cardsContainer">
                
                <!-- Tarjeta 1 -->
                <div id="card-1" class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl p-6 text-white shadow-lg relative overflow-hidden group transition transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 p-4">
                        <i class="material-icons text-white opacity-20 text-4xl">contactless</i>
                    </div>
                    
                    <div class="flex justify-between items-start mb-8">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-8 opacity-80">
                        <span class="bg-white/20 text-xs px-2 py-1 rounded backdrop-blur-sm">Principal</span>
                    </div>

                    <div class="mt-auto">
                        <p class="font-mono text-xl tracking-widest mb-1">•••• •••• •••• 4242</p>
                        <div class="flex justify-between items-end text-xs text-gray-400">
                            <span id="holder-1">JUAN PÉREZ</span>
                            <span id="exp-1">EXP 12/25</span>
                        </div>
                    </div>

                    <div class="absolute inset-0 bg-black/80 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition duration-300">
                        <!-- Botón Editar -->
                        <button onclick="openEditModal(1, '4242', '12/25', 'JUAN PÉREZ')" class="text-white border border-white/30 hover:bg-white hover:text-black px-3 py-1 rounded text-xs transition flex items-center gap-1">
                            <i class="material-icons text-xs">edit</i> Editar
                        </button>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div id="card-2" class="bg-gradient-to-r from-blue-700 to-blue-600 rounded-xl p-6 text-white shadow-lg relative overflow-hidden group transition transform hover:-translate-y-1">
                    <div class="absolute top-0 right-0 p-4">
                        <i class="material-icons text-white opacity-20 text-4xl">contactless</i>
                    </div>
                    
                    <div class="flex justify-between items-start mb-8">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-6 opacity-90 bg-white/90 rounded px-1">
                    </div>

                    <div class="mt-auto">
                        <p class="font-mono text-xl tracking-widest mb-1">•••• •••• •••• 8821</p>
                        <div class="flex justify-between items-end text-xs text-blue-100">
                            <span id="holder-2">EMPRESA S.A.</span>
                            <span id="exp-2">EXP 09/26</span>
                        </div>
                    </div>
                     <div class="absolute inset-0 bg-blue-900/90 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition duration-300">
                        <button onclick="makePrincipal(2)" class="bg-white text-blue-900 px-3 py-1 rounded font-bold text-xs shadow hover:bg-blue-50">Hacer Principal</button>
                        
                        <!-- Botón Editar -->
                        <button onclick="openEditModal(2, '8821', '09/26', 'EMPRESA S.A.')" class="text-white border border-white/30 hover:bg-white hover:text-blue-900 px-3 py-1 rounded text-xs transition flex items-center gap-1">
                            <i class="material-icons text-xs">edit</i> Editar
                        </button>
                    </div>
                </div>

                <!-- Agregar Metodo de Pago -->
                <button onclick="openAddModal()" class="border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center text-gray-400 hover:border-blue-500 hover:text-blue-500 hover:bg-blue-50 transition h-full min-h-[180px]">
                    <i class="material-icons text-4xl mb-2">add_circle_outline</i>
                    <span class="font-medium">Añadir nuevo método</span>
                </button>
            </div>

        </div>
    </main>

    <!-- AGREGAR TARJETA -->
    <div id="addCardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Nueva Tarjeta</h3>
                <button onclick="document.getElementById('addCardModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="saveCard(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Número de Tarjeta</label>
                        <div class="relative">
                            <i class="material-icons absolute left-3 top-3 text-gray-400 text-sm">credit_card</i>
                            <input type="text" class="w-full border pl-10 p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="0000 0000 0000 0000" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Expiración</label>
                            <input type="text" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="MM/AA" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">CVC</label>
                            <input type="password" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="123" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Titular</label>
                        <input type="text" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="Como aparece en la tarjeta" required>
                    </div>
                </div>
                <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-700 transition shadow-lg">Guardar Tarjeta</button>
            </form>
        </div>
    </div>

    <!-- EDITAR TARJETA -->
    <div id="editCardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Editar Tarjeta</h3>
                <button onclick="document.getElementById('editCardModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="updateCard(event)">
                <input type="hidden" id="editCardId">
                <div class="space-y-4">
                    <div class="bg-blue-50 p-3 rounded text-sm text-blue-800 mb-2 flex items-start gap-2">
                        <i class="material-icons text-sm mt-0.5">info</i>
                        <p>Por seguridad, solo puedes actualizar la fecha de expiración y el nombre del titular. Para cambiar el número, agrega una nueva tarjeta.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Termina en</label>
                        <input type="text" id="editCardLast4" class="w-full border p-3 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Expiración</label>
                            <input type="text" id="editCardExp" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">CVC</label>
                            <input type="password" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="***">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Titular</label>
                        <input type="text" id="editCardHolder" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" required>
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="deleteCard()" class="flex-1 border border-red-200 text-red-600 font-bold py-3 rounded-lg hover:bg-red-50 transition">Eliminar</button>
                    <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-lg">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        function openAddModal() {
            document.getElementById('addCardModal').classList.remove('hidden');
        }

        //edición con datos precargados
        function openEditModal(id, last4, exp, holder) {
            document.getElementById('editCardId').value = id;
            document.getElementById('editCardLast4').value = '•••• ' + last4;
            document.getElementById('editCardExp').value = exp;
            document.getElementById('editCardHolder').value = holder;
            
            document.getElementById('editCardModal').classList.remove('hidden');
        }

        function saveCard(e) {
            e.preventDefault();
            alert('Tarjeta guardada exitosamente.');
            document.getElementById('addCardModal').classList.add('hidden');
            location.reload(); 
        }

        function updateCard(e) {
            e.preventDefault();
            const id = document.getElementById('editCardId').value;
            const newExp = document.getElementById('editCardExp').value;
            const newHolder = document.getElementById('editCardHolder').value;

            // Actualizar visualmente 
            if(document.getElementById('holder-' + id)) {
                document.getElementById('holder-' + id).innerText = newHolder.toUpperCase();
                document.getElementById('exp-' + id).innerText = 'EXP ' + newExp;
            }

            alert('Datos de tarjeta actualizados.');
            document.getElementById('editCardModal').classList.add('hidden');
        }

        function deleteCard() {
            const id = document.getElementById('editCardId').value;
            
            if(confirm('¿Estás seguro de eliminar esta tarjeta? Si es tu método principal, el servicio podría interrumpirse.')) {
                // Eliminar visualmente
                const cardElement = document.getElementById('card-' + id);
                if(cardElement) {
                    cardElement.remove();
                }
                alert('Tarjeta eliminada correctamente.');
                document.getElementById('editCardModal').classList.add('hidden');
            }
        }

        function makePrincipal(id) {
            if(confirm('¿Establecer como método de pago principal?')) {
                alert('Método de pago actualizado.');
                location.reload();
            }
        }
    </script>
</body>
</html>