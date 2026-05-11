<x-app-layout>

<div style="max-width:700px;">

    <div style="margin-bottom:32px;">
        <a href="{{ route('recetas.index') }}" style="color:rgba(255,255,255,0.3);font-size:13px;text-decoration:none;"
            onmouseover="this.style.color='rgba(255,255,255,0.6)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">
            ← Volver a recetas
        </a>
        <h1 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:white;margin-top:12px;">
            {{ $receta->titulo }}
        </h1>
        <p style="color:rgba(255,255,255,0.3);font-size:13px;margin-top:6px;">
            Por <span style="color:rgba(255,255,255,0.5);">{{ $receta->autor->name }}</span> ·
            {{ $receta->created_at->format('d/m/Y') }}
        </p>
    </div>

    {{-- Ingredientes --}}
    <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:28px;margin-bottom:16px;">
        <p style="color:#00aaff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:14px;">
            Ingredientes
        </p>
        <p style="color:rgba(255,255,255,0.7);font-size:14px;line-height:1.8;white-space:pre-line;">
            {{ $receta->ingredientes }}
        </p>
    </div>

    {{-- Pasos --}}
    <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:28px;margin-bottom:24px;">
        <p style="color:#00aaff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:14px;">
            Pasos de preparación
        </p>
        <p style="color:rgba(255,255,255,0.7);font-size:14px;line-height:1.8;white-space:pre-line;">
            {{ $receta->pasos }}
        </p>
    </div>

    {{-- Botones --}}
    @if(Auth::user()->esCocinero() || Auth::user()->esAdmin())
    <div style="display:flex;gap:12px;">
        <a href="{{ route('recetas.pdf', $receta) }}"
            style="background:rgba(0,170,255,0.12);border:1px solid rgba(0,170,255,0.3);color:#00aaff;text-decoration:none;font-size:13px;font-weight:600;padding:10px 20px;border-radius:8px;"
            onmouseover="this.style.background='rgba(0,170,255,0.2)'"
            onmouseout="this.style.background='rgba(0,170,255,0.12)'">
            📄 Descargar PDF
        </a>
        <a href="{{ route('recetas.edit', $receta) }}"
            style="border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);text-decoration:none;font-size:13px;padding:10px 20px;border-radius:8px;"
            onmouseover="this.style.borderColor='#00aaff';this.style.color='#00aaff'"
            onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.6)'">
            Editar
        </a>
    </div>
    @endif

</div>

</x-app-layout>
