🚗 QR-Parking - Sistema de Gestión de Estacionamientos

Este proyecto es para una plataforma  de estacionamientos inteligentes construida con Laravel. Incluye portales para administradores, dueños de negocio y usuarios finales, etc.

---Requisitos Previos

Para ejecutar este proyecto correctamente en tu computadora, necesitas tener instalado lo siguiente:

PHP: Versión 8.1 o superior.

Composer: El gestor de dependencias de PHP.

Servidor Local: Se recomienda usar Laragon (Windows), XAMPP, o Docker.

Navegador Web: Google Chrome, Firefox, Edge o Safari.

---Guía de Instalación y Ejecución

Sigue estos pasos para levantar el proyecto desde cero:

Instalar Dependencias de PHP:
Abre tu terminal en la carpeta del proyecto y ejecuta:

composer install


Configurar el Entorno:

Busca el archivo .env.example y haz una copia llamada .env.
Genera la llave de encriptación de Laravel:

php artisan key:generate


Limpiar Cachés (Si hay errores visuales):

php artisan view:clear
php artisan route:clear


Iniciar el Servidor:
Ejecuta el siguiente comando para prender el servidor de desarrollo:

php artisan serve


Acceder:
Abre tu navegador y entra a: http://127.0.0.1:8000

---Estructura del Proyecto

El código visual se encuentra organizado en resources/views/:

1. Accesos Públicos

welcome.blade.php: Landing page.

login.blade.php / register.blade.php: Autenticación.

forgot_password.blade.php: Recuperación de cuenta.

legal.blade.php: Términos y Privacidad.

2. Portal del Conductor 

Ubicación: resources/views/ y resources/views/user/

Dashboard: dashboard_user.blade.php (QR, Mapa, Wallet).

Perfil: user/profile.blade.php (Datos, Tarjetas, Seguridad).

Membresías: user/memberships.blade.php (Compra de planes Premium).

Historial: user/history.blade.php.

3. Panel del Estacionamiento 

Ubicación: resources/views/ y resources/views/admin/

Operación: entry.blade.php (Entrada) y exit.blade.php (Salida/Cobro).

Gestión: admin/plans.blade.php (Pensiones), admin/tariffs.blade.php (Precios), admin/requests.blade.php (Solicitudes).

SaaS (Pagos al sistema): subscriptions.blade.php y admin/payment_methods.blade.php.

Auditoría: admin/logs.blade.php.

4. Panel Super Admin (Dueño de la Plataforma)

Ubicación: resources/views/super_admin/

Gestión global de clientes, ingresos y configuración de precios (parkings, config, users).

---Funcionalidades 

Roles: Puedes probar los diferentes paneles cambiando la variable $rol en la ruta /dashboard-decision dentro de routes/web.php.

Suscripciones SaaS: Si "compras" un plan en el panel de estacionamiento, la página recordará tu compra al recargar.

Membresía Usuario: Si compras "Gold" en el perfil de usuario, el dashboard cambiará para mostrar tu tarjeta de socio.

Wallet: El saldo se actualiza visualmente al "recargar", aunque se reinicia al cerrar la pestaña 