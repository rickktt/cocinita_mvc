<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Controlador de Sesión Predeterminado
    |--------------------------------------------------------------------------
    |
    | Controlador predeterminado de sesión (file, database, redis, etc.)
    |
    | Soportados: "file", "cookie", "database", "redis", "memcached"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Duración de la Sesión
    |--------------------------------------------------------------------------
    |
    | Número de minutos que la sesión permanece activa antes de expirar
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Encriptación de Sesión
    |--------------------------------------------------------------------------
    |
    | Encriptar automáticamente todos los datos de sesión
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Ubicación de Archivos de Sesión
    |--------------------------------------------------------------------------
    |
    | Directorio donde se almacenan los archivos de sesión
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Conexión de BD de Sesión
    |--------------------------------------------------------------------------
    |
    | Conexión de BD para almacenar sesiones
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabla de BD de Sesión
    |--------------------------------------------------------------------------
    |
    | Tabla para almacenar datos de sesión en la BD
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Almacén de Caché de Sesión
    |--------------------------------------------------------------------------
    |
    | Almacén de caché usado para mantener datos de sesión
    |
    | Afecta: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Lotería de Limpieza de Sesión
    |--------------------------------------------------------------------------
    |
    | Probabilidad de limpiar sesiones antiguas (odds de 2 en 100)
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nombre de Cookie de Sesión
    |--------------------------------------------------------------------------
    |
    | Nombre de la cookie de sesión creada por el framework
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Ruta de Cookie de Sesión
    |--------------------------------------------------------------------------
    |
    | Ruta en la que la cookie será accesible
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Dominio de Cookie de Sesión
    |--------------------------------------------------------------------------
    |
    | Dominio y subdominios donde la cookie de sesión está disponible
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Solo Cookies HTTPS
    |--------------------------------------------------------------------------
    |
    | Si está habilitado, las cookies de sesión se enviarán sólo por HTTPS
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Sólo Acceso HTTP
    |--------------------------------------------------------------------------
    |
    | Si está habilitado, JavaScript no puede acceder al valor de la cookie
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Cookies Same-Site
    |--------------------------------------------------------------------------
    |
    | Control de comportamiento de cookies en solicitudes cross-site (CSRF)
    |
    | Soportados: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Cookies Particionadas
    |--------------------------------------------------------------------------
    |
    | Las cookies particionadas se atan al sitio de nivel superior
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | Serializaci\u00f3n de Sesi\u00f3n
    |--------------------------------------------------------------------------
    |
    | Estrategia de serializaci\u00f3n para datos de sesi\u00f3n (json o php)
    |
    | Soportados: \"json\", \"php\"
    |
    */

    'serialization' => 'json',

];
