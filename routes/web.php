<?php

use Illuminate\Support\Facades\Route;

// ACCESO Y AUTENTICACIÓN 
// Pantalla de Bienvenida 
Route::get('/', function () {
    return view('welcome');
});
// Pantalla de Inicio de Sesión
Route::get('/login', function () {
    return view('login');
});
// Pantalla de Registro
Route::get('/register', function () {
    return view('register');
});
// Recuperar Contraseña
Route::get('/recuperar-password', function () {
    return view('forgot_password');
});
// Términos Legales
Route::get('/legal/terminos', function () {
    return view('legal');
});


// USUARIO 
// Conductor
Route::get('/mi-cuenta', function () {
    return view('dashboard_user');
});
// Historial de Visitas
Route::get('/mi-cuenta/historial', function () {
    return view('user.history'); 
});
// Tienda de Membresías
Route::get('/mi-cuenta/membresias', function () {
    return view('user.memberships'); 
});

// Perfil y Seguridad
Route::get('/mi-cuenta/perfil', function () {
    return view('user.profile'); 
});
// Lector de Salida (Cobro y QR)
Route::get('/salida', function () {
    return view('exit');
});

// ESTACIONAMIENTO 
// Principal 
Route::get('/dashboard', function () {
    return view('dashboard');
});


// Lector de Entrada (Generar Boleto)
Route::get('/entrada', function () {
    return view('entry');
});

// Lector de Salida (Cobro y QR)
Route::get('/salida', function () {
    return view('exit');
});

// --- CLIENTES Y NEGOCIO ---
// Buzón de Solicitudes 
Route::get('/admin/solicitudes', function () {
    return view('admin.requests'); 
});
// Gestión de Planes para Usuarios 
Route::get('/admin/planes', function () {
    return view('admin.plans');
});
// Configuración de Tarifas 
Route::get('/admin/tarifas', function () {
    return view('admin.tariffs');
});
// Bitácora de Accesos
Route::get('/admin/bitacora', function () {
    return view('admin.logs');
});


// ADMINISTRACIÓN DEL SOFTWARE
// Panel de Suscripción
Route::get('/suscripciones', function () {
    return view('subscriptions');
});
// Gestión de Métodos de Pago 
Route::get('/admin/metodos-pago', function () {
    return view('admin.payment_methods');
});
// Pago 
Route::get('/payment/checkout', function () {
    return view('payment.checkout');
});


// SUPER ADMIN
Route::get('/super-admin', function () {
    return view('super_admin');
});
// Gestión de Estacionamientos
Route::get('/super-admin/estacionamientos', function () {
    return view('super_admin.parkings');
});
// Configuración de Precios 
Route::get('/super-admin/configuracion', function () {
    return view('super_admin.config');
});
// Usuarios Finales
Route::get('/super-admin/usuarios', function () {
    return view('super_admin.users');
});


// Fallback error 404 
Route::fallback(function () {
    return view('errors.404');
});
Route::get('/dashboard-decision', function () {
    
    // -----------------------------------------------------------
    // USUARIOS EXISTENTES:
    // 'super_admin'    -> Panel General de Negocio (Tú)
    // 'estacionamiento' -> Panel de Administración de un Parking (Cliente)
    // 'usuario'        -> App del Conductor (Usuario Final)
    // -----------------------------------------------------------
    
    $rol = 'usuario'; //Cambiar para ver otros usuarios
    
    if ($rol === 'super_admin') {
        return redirect('/super-admin');
    } elseif ($rol === 'estacionamiento') {
        return redirect('/dashboard');
    } else {
        return redirect('/mi-cuenta');
    }
});