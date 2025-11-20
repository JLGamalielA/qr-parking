<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| RUTAS DE ACCESO Y AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

// Pantalla de Bienvenida 
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Autenticación Manuales
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');
Route::get('/recuperar-password', function () { return view('forgot_password'); });

// --- RUTA DE LOGOUT (Crucial para el menú) ---
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (Solo usuarios logueados)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 1. PANEL ADMINISTRATIVO (El nuevo diseño Volt)
    // Esta es la ÚNICA definición de dashboard que debe existir.
    Route::get('/dashboard', function () {
        return view('modules.admin.dashboard');
    })->name('dashboard');

    // 2. USUARIO / CONDUCTOR
    Route::get('/mi-cuenta', function () { return view('dashboard_user'); });
    Route::get('/mi-cuenta/historial', function () { return view('user.history'); });
    Route::get('/mi-cuenta/membresias', function () { return view('user.memberships'); });
    Route::get('/mi-cuenta/perfil', function () { return view('user.profile'); });

    // 3. OPERACIÓN ESTACIONAMIENTO
    Route::get('/entrada', function () { return view('entry'); });
    Route::get('/salida', function () { return view('exit'); }); // Solo una definición

    // 4. GESTIÓN ADMINISTRATIVA
    Route::get('/admin/solicitudes', function () { return view('admin.requests'); });
    Route::get('/admin/planes', function () { return view('admin.plans'); });
    Route::get('/admin/tarifas', function () { return view('admin.tariffs'); });
    Route::get('/admin/bitacora', function () { return view('admin.logs'); });
    
    // 5. ADMINISTRACIÓN DEL SOFTWARE
    Route::get('/suscripciones', function () { return view('subscriptions'); });
    Route::get('/admin/metodos-pago', function () { return view('admin.payment_methods'); });
    Route::get('/payment/checkout', function () { return view('payment.checkout'); });

    // 6. SUPER ADMIN
    Route::get('/super-admin', function () { return view('super_admin'); });
    Route::get('/super-admin/estacionamientos', function () { return view('super_admin.parkings'); });
    Route::get('/super-admin/configuracion', function () { return view('super_admin.config'); });
    Route::get('/super-admin/usuarios', function () { return view('super_admin.users'); });
});

/*
|--------------------------------------------------------------------------
| RUTAS PUBLICAS / LEGALES
|--------------------------------------------------------------------------
*/
Route::get('/legal/terminos', function () {
    return view('legal');
});

// Redirección inteligente basada en rol (Opcional)
Route::get('/dashboard-decision', function () {
    // Lógica simulada para decidir a dónde ir
    $rol = 'usuario'; 
    
    if ($rol === 'super_admin') {
        return redirect('/super-admin');
    } elseif ($rol === 'estacionamiento') {
        return redirect('/dashboard');
    } else {
        return redirect('/mi-cuenta');
    }
});

// Fallback para error 404
Route::fallback(function () {
    return view('errors.404');
});