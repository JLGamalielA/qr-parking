    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Usuarios B2C | Super Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>body { font-family: 'Segoe UI', sans-serif; }</style>
    </head>
    <body class="bg-gray-900 text-gray-100 font-sans p-8">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Usuarios Registrados (B2C)</h1>
                    <p class="text-gray-400 text-sm">Base de datos de conductores y billeteras digitales.</p>
                </div>
                <div class="flex gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Buscar por email o teléfono..." class="bg-gray-800 border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:border-blue-500 w-64">
                        <i class="material-icons absolute left-3 top-2.5 text-gray-500 text-sm">search</i>
                    </div>
                    <a href="/super-admin" class="text-gray-400 hover:text-white flex items-center gap-2 px-3 py-2 bg-gray-800 rounded-lg border border-gray-700 hover:bg-gray-700 transition">
                        <i class="material-icons text-sm">arrow_back</i> Volver
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Saldo Total en Billeteras</p>
                        <h3 class="text-xl font-bold text-green-400">$850,200.00</h3>
                    </div>
                    <i class="material-icons text-green-500 opacity-50">account_balance_wallet</i>
                </div>
                <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Usuarios Premium</p>
                        <h3 class="text-xl font-bold text-yellow-400">1,250</h3>
                    </div>
                    <i class="material-icons text-yellow-500 opacity-50">diamond</i>
                </div>
                <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Nuevos (Mes)</p>
                        <h3 class="text-xl font-bold text-blue-400">+340</h3>
                    </div>
                    <i class="material-icons text-blue-500 opacity-50">group_add</i>
                </div>
            </div>

            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-xl">
                <table class="min-w-full text-sm text-left text-gray-300">
                    <thead class="bg-gray-900 text-gray-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Usuario</th>
                            <th class="px-6 py-4">Contacto</th>
                            <th class="px-6 py-4">Membresía</th>
                            <th class="px-6 py-4">Saldo Billetera</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        
                        <!-- Usuario 1 -->
                        <tr class="hover:bg-gray-750 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white">JP</div>
                                    <div>
                                        <p class="font-bold text-white">Juan Pérez</p>
                                        <p class="text-xs text-gray-500">Registrado: 10 Nov 2024</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-white">juan@correo.com</p>
                                <p class="text-xs text-gray-500">55 1234 5678</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-900 text-yellow-200 px-2 py-1 rounded text-xs border border-yellow-700 flex items-center w-fit gap-1">
                                    <i class="material-icons text-[10px]">star</i> Gold
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-green-400 font-bold">$520.00</td>
                            <td class="px-6 py-4"><span class="text-green-400 bg-green-900/30 px-2 py-1 rounded text-xs">Activo</span></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button class="text-blue-400 hover:text-white" title="Ver Historial"><i class="material-icons text-sm">history</i></button>
                                <button class="text-gray-400 hover:text-white" title="Editar"><i class="material-icons text-sm">edit</i></button>
                            </td>
                        </tr>

                        <!-- Usuario 2 -->
                        <tr class="hover:bg-gray-750 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-purple-600 flex items-center justify-center font-bold text-white">ML</div>
                                    <div>
                                        <p class="font-bold text-white">María López</p>
                                        <p class="text-xs text-gray-500">Registrado: 05 Oct 2024</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-white">maria@test.com</p>
                                <p class="text-xs text-gray-500">55 9876 5432</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs border border-gray-600">Gratis</span>
                            </td>
                            <td class="px-6 py-4 font-mono text-white font-bold">$20.00</td>
                            <td class="px-6 py-4"><span class="text-green-400 bg-green-900/30 px-2 py-1 rounded text-xs">Activo</span></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button class="text-blue-400 hover:text-white"><i class="material-icons text-sm">history</i></button>
                                <button class="text-gray-400 hover:text-white"><i class="material-icons text-sm">edit</i></button>
                            </td>
                        </tr>

                        <!-- Usuario 3 -->
                        <tr class="hover:bg-gray-750 transition bg-red-900/10">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center font-bold text-white">XX</div>
                                    <div>
                                        <p class="font-bold text-gray-300">Usuario Susp.</p>
                                        <p class="text-xs text-red-400">Reportado por fraude</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-400">fake@user.com</p>
                                <p class="text-xs text-gray-500">--</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs border border-gray-600">Gratis</span>
                            </td>
                            <td class="px-6 py-4 font-mono text-gray-500">$0.00</td>
                            <td class="px-6 py-4"><span class="text-red-400 bg-red-900/30 px-2 py-1 rounded text-xs">Bloqueado</span></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button class="text-green-400 hover:text-green-200" title="Desbloquear"><i class="material-icons text-sm">lock_open</i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <!-- Paginación simple -->
            <div class="mt-4 flex justify-end gap-2">
                <button class="px-3 py-1 bg-gray-800 border border-gray-700 rounded text-gray-400 hover:text-white disabled:opacity-50">Prev</button>
                <button class="px-3 py-1 bg-gray-800 border border-gray-700 rounded text-white hover:text-white">1</button>
                <button class="px-3 py-1 bg-gray-800 border border-gray-700 rounded text-gray-400 hover:text-white">2</button>
                <button class="px-3 py-1 bg-gray-800 border border-gray-700 rounded text-gray-400 hover:text-white">Next</button>
            </div>

        </div>
    </body>
    </html>