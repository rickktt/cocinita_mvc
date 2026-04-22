<x-app-layout>

<div style="margin-bottom:40px;">
    <h1 style="font-family:'Syne',sans-serif;font-size:36px;font-weight:800;color:white;margin-bottom:8px;">
        Bienvenido, <span style="color:#00aaff;">{{ Auth::user()->name }}</span>
    </h1>
    <p style="color:rgba(255,255,255,0.4);font-size:13px;">
        Conectado como
        <span style="margin-left:6px;padding:2px 10px;border-radius:999px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;border:1px solid rgba(0,170,255,0.4);color:#00aaff;">
            {{ Auth::user()->rol }}
        </span>
    </p>
</div>

{{-- ADMIN --}}
@if(Auth::user()->esAdmin())
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;">

    @php $cards = [
        ['🛡️', 'Panel de Administración', 'Gestión global del sistema', '#'],
        ['👥', 'Gestión de Usuarios', 'Administrar roles y accesos', '#'],
        ['📋', 'Ver Recetas', 'Consultar recetas del sistema', route('recetas.index')],
    ]; @endphp
    @foreach($cards as $card)
    <a href="{{ $card[3] }}" style="display:block;text-decoration:none;background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:24px;transition:all 0.3s;"
        onmouseover="this.style.borderColor='rgba(0,170,255,0.5)';this.style.boxShadow='0 0 25px rgba(0,170,255,0.1)'"
        onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,170,255,0.1);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px;">{{ $card[0] }}</div>
        <h3 style="font-family:'Syne',sans-serif;font-weight:700;color:white;margin-bottom:4px;font-size:15px;">{{ $card[1] }}</h3>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $card[2] }}</p>
    </a>
    @endforeach

</div>
@endif

{{-- COCINERO --}}
@if(Auth::user()->esCocinero())
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;">

    @php $cards = [
        ['🍳', 'Órdenes en Cocina', 'Ver y gestionar las órdenes activas', '#'],
        ['📋', 'Ver Recetas', 'Consultar y crear recetas', route('recetas.index')],
        ['➕', 'Nueva Receta', 'Crear una nueva receta', route('recetas.create')],
    ]; @endphp
    @foreach($cards as $card)
    <a href="{{ $card[3] }}" style="display:block;text-decoration:none;background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:24px;transition:all 0.3s;"
        onmouseover="this.style.borderColor='rgba(0,170,255,0.5)';this.style.boxShadow='0 0 25px rgba(0,170,255,0.1)'"
        onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,170,255,0.1);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px;">{{ $card[0] }}</div>
        <h3 style="font-family:'Syne',sans-serif;font-weight:700;color:white;margin-bottom:4px;font-size:15px;">{{ $card[1] }}</h3>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $card[2] }}</p>
    </a>
    @endforeach

</div>
@endif

{{-- ASISTENTE --}}
@if(Auth::user()->esAsistente())
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;">

    @php $cards = [
        ['📝', 'Órdenes en Cocina', 'Consultar órdenes activas', '#'],
        ['🍽️', 'Presentación de Platillo', 'Revisar emplatado y presentación', '#'],
        ['📋', 'Ver Recetas', 'Consultar las recetas del día', route('recetas.index')],
    ]; @endphp
    @foreach($cards as $card)
    <a href="{{ $card[3] }}" style="display:block;text-decoration:none;background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:24px;transition:all 0.3s;"
        onmouseover="this.style.borderColor='rgba(0,170,255,0.5)';this.style.boxShadow='0 0 25px rgba(0,170,255,0.1)'"
        onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(0,170,255,0.1);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px;">{{ $card[0] }}</div>
        <h3 style="font-family:'Syne',sans-serif;font-weight:700;color:white;margin-bottom:4px;font-size:15px;">{{ $card[1] }}</h3>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $card[2] }}</p>
    </a>
    @endforeach

</div>
@endif

</x-app-layout>
