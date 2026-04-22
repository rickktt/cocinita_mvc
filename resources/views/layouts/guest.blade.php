<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cocinita') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col" style="background-color:#0a0a0a; font-family:'DM Sans',sans-serif;">

    {{-- Grid background --}}
    <div style="position:fixed;inset:0;background-image:linear-gradient(rgba(0,170,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(0,170,255,0.03) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;"></div>
    {{-- Glow --}}
    <div style="position:fixed;top:33%;left:50%;transform:translate(-50%,-50%);width:600px;height:400px;background:rgba(0,170,255,0.05);border-radius:50%;filter:blur(120px);pointer-events:none;"></div>

    <nav style="position:relative;z-index:10;padding:20px 32px;">
        <a href="/" style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#00aaff;text-decoration:none;">Cocinita</a>
    </nav>

    <main style="position:relative;z-index:10;flex:1;display:flex;align-items:center;justify-content:center;padding:20px;">
        {{ $slot }}
    </main>

    <footer style="position:relative;z-index:10;text-align:center;padding:20px;color:rgba(255,255,255,0.2);font-size:12px;border-top:1px solid rgba(255,255,255,0.05);">
        © {{ date('Y') }} Cocinita — Todos los derechos reservados
    </footer>
</body>
</html>
