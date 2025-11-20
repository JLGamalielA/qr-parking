<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Perfil | QR-Parking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>body { font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <a href="/mi-cuenta" class="text-gray-500 hover:text-blue-600 flex items-center gap-2">
                    <i class="material-icons">arrow_back</i> Volver
                </a>
                <h1 class="font-bold text-lg">Ajustes de Cuenta</h1>
                <div class="w-8"></div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8 space-y-8">

        <!-- 1. PERFIL BÁSICO -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">JP</div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900" id="profileName">Juan Pérez</h2>
                    <p class="text-gray-500 text-sm" id="profileEmail">juan@correo.com</p>
                    <p class="text-gray-500 text-sm" id="profilePhone">+52 55 1234 5678</p>
                </div>
                <!-- BOTÓN EDITAR PERFIL -->
                <button onclick="openEditProfileModal()" class="ml-auto text-blue-600 text-sm font-medium hover:underline bg-blue-50 px-3 py-1 rounded-lg transition">
                    Editar
                </button>
            </div>
        </section>

        <!-- MÉTODOS DE PAGO -->
        <section>
            <div class="flex justify-between items-center mb-3 ml-2">
                <h3 class="text-sm font-bold text-gray-500 uppercase">Mis Métodos de Pago</h3>
                <button onclick="openAddCardModal()" class="text-blue-600 text-xs font-bold flex items-center hover:underline">
                    <i class="material-icons text-sm mr-1">add_circle</i> Agregar
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden" id="paymentMethodsList">
                
                <!-- Tarjeta 1 (Con ID para editar) -->
                <div id="card-1" class="p-4 border-b border-gray-100 flex justify-between items-center hover:bg-gray-50 transition">
                     <div class="flex items-center gap-3">
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-600"><i class="material-icons">credit_card</i></div>
                        <div>
                            <p class="font-bold text-gray-800" id="card-num-1">Visa •••• 4242</p>
                            <p class="text-xs text-gray-500" id="card-exp-1">Expira 12/25</p>
                        </div>
                     </div>
                     <div class="flex items-center gap-2">
                        <button onclick="openEditCardModal(1, '4242', '12/25', 'Juan Pérez')" class="text-gray-400 hover:text-blue-600 p-2 rounded-full transition" title="Editar">
                            <i class="material-icons text-sm">edit</i>
                        </button>
                        <button onclick="deletePaymentMethod(this)" class="text-gray-400 hover:text-red-500 p-2 rounded-full transition" title="Eliminar">
                            <i class="material-icons text-sm">delete</i>
                        </button>
                     </div>
                </div>

                <!-- Tarjeta 2 -->
                <div id="card-2" class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                     <div class="flex items-center gap-3">
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-800 font-bold text-xs italic w-10 text-center">Pay</div>
                        <div>
                            <p class="font-bold text-gray-800">PayPal</p>
                            <p class="text-xs text-gray-500">juan@correo.com</p>
                        </div>
                     </div>
                     <div class="flex items-center gap-2">
                        <button onclick="deletePaymentMethod(this)" class="text-gray-400 hover:text-red-500 p-2 rounded-full transition" title="Eliminar">
                            <i class="material-icons text-sm">delete</i>
                        </button>
                     </div>
                </div>

            </div>
        </section>

        <!--ROLES Y MEMBRESÍAS -->
        <section>
            <h3 class="text-sm font-bold text-gray-500 uppercase mb-3 ml-2">Mis Roles Especiales</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Rol Activo -->
                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-100 p-2 rounded-lg text-yellow-700"><i class="material-icons">local_shipping</i></div>
                        <div>
                            <p class="font-bold text-gray-800">Proveedor Autorizado</p>
                            <p class="text-xs text-gray-500">Hotel Real • Acceso Carga</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded font-bold">Activo</span>
                </div>
                <!-- Botón Solicitar -->
                <div class="p-4 border-t border-gray-100 text-center">
                    <button onclick="openRequestModal()" class="text-blue-600 font-bold text-sm flex items-center justify-center gap-2 hover:underline">
                        <i class="material-icons text-sm">add_circle</i> Solicitar Nuevo Acceso
                    </button>
                </div>
            </div>
        </section>

        <!-- SEGURIDAD -->
        <section>
            <h3 class="text-sm font-bold text-gray-500 uppercase mb-3 ml-2">Dispositivos Conectados</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <i class="material-icons text-green-500">smartphone</i>
                        <div>
                            <p class="font-bold text-gray-800">iPhone 13 (Este dispositivo)</p>
                            <p class="text-xs text-green-600">Activo ahora • CDMX</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <i class="material-icons text-gray-400">laptop_mac</i>
                        <div>
                            <p class="font-bold text-gray-800">MacBook Pro</p>
                            <p class="text-xs text-gray-500">Última vez: Ayer 14:30</p>
                        </div>
                    </div>
                    <button onclick="removeDevice(this)" class="text-red-500 hover:bg-red-50 p-2 rounded-full transition" title="Cerrar Sesión">
                        <i class="material-icons text-sm">logout</i>
                    </button>
                </div>
            </div>
        </section>

    <div class="text-center pt-8 pb-12">
        <button onclick="logoutFromDevice()" class="text-red-500 font-bold text-sm hover:underline hover:text-red-700 transition flex items-center justify-center gap-2 mx-auto">
            <i class="material-icons text-sm">power_settings_new</i> Cerrar Sesión en este dispositivo
        </button>
    </div>

    </div>

    <!-- EDITAR PERFIL -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[80] p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Editar Perfil</h3>
                <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="saveProfile(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nombre Completo</label>
                        <input type="text" id="editNameInput" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Correo Electrónico</label>
                        <input type="email" id="editEmailInput" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Teléfono</label>
                        <input type="tel" id="editPhoneInput" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" required>
                    </div>
                </div>
                <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-700 transition shadow-lg">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- SOLICITUD ROLES -->
    <div id="requestModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[60] p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all scale-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg">Solicitar Acceso Especial</h3>
                <button onclick="closeRequestModal()" class="text-gray-400"><i class="material-icons">close</i></button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Estacionamiento</label>
                    <input type="text" class="w-full border rounded-lg p-3 outline-none focus:border-blue-500" placeholder="Buscar lugar...">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tipo de Rol</label>
                    <select class="w-full border rounded-lg p-3 outline-none bg-white">
                        <option>Proveedor</option>
                        <option>Residente</option>
                        <option>Empleado</option>
                        <option>Taxi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Motivo / Justificación</label>
                    <textarea class="w-full border rounded-lg p-3 outline-none focus:border-blue-500 h-24" placeholder="Ej. Entrega de mercancía los lunes..."></textarea>
                </div>
                <button onclick="submitRequest()" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">Enviar Solicitud</button>
            </div>
        </div>
    </div>

    <!-- AGREGAR TARJETA -->
    <div id="addCardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[70] p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Nueva Tarjeta</h3>
                <button onclick="closeAddCardModal()" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="saveNewCard(event)">
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
                        <input type="text" class="w-full border p-3 rounded-lg outline-none focus:border-blue-500 transition" placeholder="Nombre como aparece en la tarjeta" required>
                    </div>
                </div>
                <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-700 transition shadow-lg">Guardar Tarjeta</button>
            </form>
        </div>
    </div>

    <!-- EDITAR TARJETA -->
    <div id="editCardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[70] p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Editar Tarjeta</h3>
                <button onclick="closeEditCardModal()" class="text-gray-400 hover:text-gray-600"><i class="material-icons">close</i></button>
            </div>
            
            <form onsubmit="updateCard(event)">
                <input type="hidden" id="editCardId">
                <div class="space-y-4">
                    <div class="bg-blue-50 p-3 rounded text-sm text-blue-800 mb-2 flex items-start gap-2">
                        <i class="material-icons text-sm mt-0.5">info</i>
                        <p>Por seguridad, solo puedes actualizar la fecha de expiración y el nombre del titular.</p>
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
                <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-700 transition shadow-lg">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        // --- EDITAR PERFIL ---
        function openEditProfileModal() {
            const name = document.getElementById('profileName').innerText;
            const email = document.getElementById('profileEmail').innerText;
            const phone = document.getElementById('profilePhone').innerText;

            document.getElementById('editNameInput').value = name;
            document.getElementById('editEmailInput').value = email;
            document.getElementById('editPhoneInput').value = phone;

            document.getElementById('editProfileModal').classList.remove('hidden');
        }

        function saveProfile(e) {
            e.preventDefault();
            const newName = document.getElementById('editNameInput').value;
            const newEmail = document.getElementById('editEmailInput').value;
            const newPhone = document.getElementById('editPhoneInput').value;

            document.getElementById('profileName').innerText = newName;
            document.getElementById('profileEmail').innerText = newEmail;
            document.getElementById('profilePhone').innerText = newPhone;

            alert('Perfil actualizado correctamente.');
            document.getElementById('editProfileModal').classList.add('hidden');
        }

        // --- MÉTODOS DE PAGO ---
        function deletePaymentMethod(btn) {
            if(confirm("¿Estás seguro de eliminar este método de pago?")) {
                const row = btn.closest('div[id^="card-"]') || btn.closest('div.flex.justify-between');
                if (row) {
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }
            }
        }

        // AGREGAR TARJETA
        function openAddCardModal() {
            document.getElementById('addCardModal').classList.remove('hidden');
        }
        function closeAddCardModal() {
            document.getElementById('addCardModal').classList.add('hidden');
        }
        function saveNewCard(e) {
            e.preventDefault();
            alert("Tarjeta agregada exitosamente.");
            const list = document.getElementById('paymentMethodsList');
            const newCard = document.createElement('div');
            newCard.id = 'card-new-' + Date.now();
            newCard.className = "p-4 border-b border-gray-100 flex justify-between items-center hover:bg-gray-50 transition";
            newCard.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600"><i class="material-icons">credit_card</i></div>
                    <div>
                        <p class="font-bold text-gray-800" id="card-num-new">Nueva Tarjeta •••• 0000</p>
                        <p class="text-xs text-gray-500" id="card-exp-new">Expira 12/30</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="openEditCardModal('new', '0000', '12/30', 'Juan Pérez')" class="text-gray-400 hover:text-blue-600 p-2 rounded-full transition" title="Editar"><i class="material-icons text-sm">edit</i></button>
                    <button onclick="deletePaymentMethod(this)" class="text-gray-400 hover:text-red-500 p-2 rounded-full transition" title="Eliminar"><i class="material-icons text-sm">delete</i></button>
                </div>
            `;
            list.insertBefore(newCard, list.firstChild);
            closeAddCardModal();
        }

        //  EDITAR TARJETA
        function openEditCardModal(id, last4, exp, holder) {
            document.getElementById('editCardId').value = id;
            document.getElementById('editCardLast4').value = '•••• ' + last4;
            document.getElementById('editCardExp').value = exp;
            document.getElementById('editCardHolder').value = holder;
            document.getElementById('editCardModal').classList.remove('hidden');
        }
        function closeEditCardModal() {
            document.getElementById('editCardModal').classList.add('hidden');
        }
        function updateCard(e) {
            e.preventDefault();
            const id = document.getElementById('editCardId').value;
            const newExp = document.getElementById('editCardExp').value;
            
            const expElement = document.getElementById('card-exp-' + id);
            if(expElement) {
                expElement.innerText = 'Expira ' + newExp;
            }
            alert('Tarjeta actualizada.');
            closeEditCardModal();
        }


        // --- Funciones ---

        function logoutFromDevice() {
            if(confirm("¿Estás seguro que quieres cerrar tu sesión?")) {
                alert("Cerrando sesión...");
                window.location.href = '/login'; 
            }
        }
        function removeDevice(btn) {
            if(confirm("¿Cerrar sesión en este dispositivo?")) {
                const row = btn.closest('div.p-4');
                row.style.opacity = '0';
                setTimeout(() => row.remove(), 300);
            }
        }

        function openRequestModal() {
            document.getElementById('requestModal').classList.remove('hidden');
        }

        function closeRequestModal() {
            document.getElementById('requestModal').classList.add('hidden');
        }

        function submitRequest() {
            const btn = document.querySelector('#requestModal button');
            btn.innerText = "Enviando...";
            setTimeout(() => {
                alert("Solicitud enviada al administrador del estacionamiento.");
                closeRequestModal();
                btn.innerText = "Enviar Solicitud";
            }, 1000);
        }
    </script>
</body>
</html>