<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cocinita') }} — {{ $title ?? 'Panel' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen" style="background-color:#0a0a0a;font-family:'DM Sans',sans-serif;color:white;">

    {{-- NAVBAR --}}
    <nav style="position:fixed;top:0;width:100%;z-index:50;padding:16px 32px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(255,255,255,0.05);background:rgba(10,10,10,0.85);backdrop-filter:blur(12px);">
        <a href="{{ route('dashboard') }}" style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#00aaff;text-decoration:none;">Cocinita</a>
        <div style="display:flex;align-items:center;gap:20px;">
            <span style="font-size:13px;color:rgba(255,255,255,0.4);">
                {{ Auth::user()->name }}
                <span style="margin-left:8px;padding:2px 10px;border-radius:999px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;border:1px solid rgba(0,170,255,0.4);color:#00aaff;">
                    {{ Auth::user()->rol }}
                </span>
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="font-size:13px;color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.1);padding:6px 16px;border-radius:8px;background:transparent;cursor:pointer;transition:all 0.3s;"
                    onmouseover="this.style.borderColor='#00aaff';this.style.color='#00aaff';"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.5)';">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main style="padding-top:96px;padding-bottom:64px;padding-left:48px;padding-right:48px;max-width:1200px;margin:0 auto;">
        @if(session('success'))
            <div style="margin-bottom:24px;padding:12px 16px;border-radius:8px;background:rgba(0,170,255,0.1);border:1px solid rgba(0,170,255,0.3);color:#00aaff;font-size:14px;">
                {{ session('success') }}
            </div>
        @endif
        {{ $slot }}
    </main>

    <footer style="text-align:center;padding:24px;color:rgba(255,255,255,0.2);font-size:12px;border-top:1px solid rgba(255,255,255,0.05);">
        © {{ date('Y') }} Cocinita — Todos los derechos reservados
    </footer>
</body>
</html>
