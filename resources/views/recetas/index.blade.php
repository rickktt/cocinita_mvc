<x-app-layout>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <div>
        <h1 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:white;margin-bottom:4px;">Recetas</h1>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $recetas->count() }} receta(s) en el sistema</p>
    </div>
    @if(Auth::user()->esCocinero() || Auth::user()->esAdmin())
    <a href="{{ route('recetas.create') }}"
        style="background:#00aaff;color:white;text-decoration:none;font-size:13px;font-weight:600;padding:10px 20px;border-radius:8px;transition:all 0.3s;"
        onmouseover="this.style.background='#0088cc'" onmouseout="this.style.background='#00aaff'">
        + Nueva receta
    </a>
    @endif
</div>

@if($recetas->isEmpty())
    <div style="text-align:center;padding:80px 0;color:rgba(255,255,255,0.3);">
        <span style="font-size:48px;display:block;margin-bottom:16px;">🍽️</span>
        <p style="font-family:'Syne',sans-serif;font-size:18px;">Aún no hay recetas registradas.</p>
    </div>
@else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
        @foreach($recetas as $receta)
        <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:24px;display:flex;flex-direction:column;gap:16px;transition:border-color 0.3s;"
            onmouseover="this.style.borderColor='rgba(255,255,255,0.15)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'">

            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:17px;font-weight:700;color:white;margin-bottom:4px;">{{ $receta->titulo }}</h2>
                <p style="color:rgba(255,255,255,0.3);font-size:12px;">
                    Por <span style="color:rgba(255,255,255,0.5);">{{ $receta->autor->name }}</span> ·
                    {{ $receta->created_at->diffForHumans() }}
                </p>
            </div>

            <div>
                <p style="color:#00aaff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px;">Ingredientes</p>
                <p style="color:rgba(255,255,255,0.6);font-size:13px;line-height:1.6;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $receta->ingredientes }}</p>
            </div>

            <div>
                <p style="color:#00aaff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:6px;">Pasos</p>
                <p style="color:rgba(255,255,255,0.6);font-size:13px;line-height:1.6;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $receta->pasos }}</p>
            </div>

            @if(Auth::user()->esCocinero() || Auth::user()->esAdmin())
            <div style="display:flex;gap:8px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.05);margin-top:auto;">
                <a href="{{ route('recetas.edit', $receta) }}"
                    style="flex:1;text-align:center;font-size:13px;border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);padding:8px;border-radius:8px;text-decoration:none;transition:all 0.2s;"
                    onmouseover="this.style.borderColor='#00aaff';this.style.color='#00aaff'"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.6)'">
                    Editar
                </a>
                <form method="POST" action="{{ route('recetas.destroy', $receta) }}" style="flex:1;" onsubmit="return confirm('¿Eliminar esta receta?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="width:100%;font-size:13px;border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);padding:8px;border-radius:8px;background:transparent;cursor:pointer;transition:all 0.2s;"
                        onmouseover="this.style.borderColor='rgba(255,77,77,0.5)';this.style.color='#ff4d4d'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.6)'">
                        Eliminar
                    </button>
                </form>
            </div>
            @endif

        </div>
        @endforeach
    </div>
@endif

</x-app-layout>
