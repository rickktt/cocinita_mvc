<x-app-layout>

{{-- ═══════════════════════════════════════════
     GRÁFICA — Solo Cocineros y Admin
═══════════════════════════════════════════ --}}
@if(Auth::user()->esCocinero() || Auth::user()->esAdmin())
<div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:20px;padding:28px;margin-bottom:36px;">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
        <h2 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#fff;margin:0;">
            🔥 Producción de Recetas
        </h2>
        <span style="font-size:11px;color:rgba(255,255,255,0.2);background:#1a1a1a;padding:4px 12px;border-radius:999px;border:1px solid rgba(255,255,255,0.07);">
            Panel de cocina
        </span>
    </div>
    <p style="font-size:13px;color:rgba(255,255,255,0.35);margin:0 0 24px;">
        Recetas registradas por cada cocinero
    </p>

    {{-- Stats --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:24px;">
        <div style="background:#1a1a1a;border-radius:12px;padding:16px;border:1px solid rgba(255,255,255,0.06);">
            <div style="font-size:11px;color:rgba(255,255,255,0.35);text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">🍽️ Total recetas</div>
            <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:#00aaff;">{{ $cocineros->sum('recetas_count') }}</div>
        </div>
        <div style="background:#1a1a1a;border-radius:12px;padding:16px;border:1px solid rgba(255,255,255,0.06);">
            <div style="font-size:11px;color:rgba(255,255,255,0.35);text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">👨‍🍳 Cocineros</div>
            <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:#1D9E75;">{{ $cocineros->count() }}</div>
        </div>
        <div style="background:#1a1a1a;border-radius:12px;padding:16px;border:1px solid rgba(255,255,255,0.06);">
            <div style="font-size:11px;color:rgba(255,255,255,0.35);text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">🏆 Top chef</div>
            <div style="font-family:'Syne',sans-serif;font-size:16px;font-weight:800;color:#D85A30;padding-top:6px;">
                {{ $cocineros->sortByDesc('recetas_count')->first()?->name ?? '—' }}
            </div>
        </div>
    </div>

    {{-- Leyenda --}}
    @php
        $totalRecetas = $cocineros->sum('recetas_count') ?: 1;
        $colores = ['#00aaff','#1D9E75','#D85A30','#7F77DD','#BA7517','#D4537E'];
    @endphp
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:20px;">
        @foreach($cocineros as $i => $cocinero)
        @php $color = $colores[$i % count($colores)]; @endphp
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:rgba(255,255,255,0.5);background:#1a1a1a;border-radius:999px;padding:5px 12px;border:1px solid rgba(255,255,255,0.07);">
            <span style="width:8px;height:8px;border-radius:50%;background:{{ $color }};flex-shrink:0;"></span>
            {{ $cocinero->name }}
            <strong style="color:#fff;margin-left:2px;">{{ round(($cocinero->recetas_count / $totalRecetas) * 100) }}%</strong>
        </div>
        @endforeach
    </div>

    @if($cocineros->isEmpty())
        <div style="text-align:center;padding:40px 0;color:rgba(255,255,255,0.3);font-size:14px;">
            No hay cocineros con recetas aún.
        </div>
    @else
        {{-- Gráfica dona --}}
        <div style="position:relative;width:100%;height:260px;margin-bottom:24px;">
            <canvas id="ckChart" role="img" aria-label="Gráfica de dona mostrando recetas por cocinero">Producción de recetas por cocinero.</canvas>
        </div>

        {{-- Barras animadas --}}
        @php $maxCount = $cocineros->max('recetas_count') ?: 1; @endphp
        <div style="display:flex;flex-direction:column;gap:10px;">
            @foreach($cocineros as $i => $cocinero)
            @php
                $color = $colores[$i % count($colores)];
                $pct   = max(round(($cocinero->recetas_count / $maxCount) * 100), 3);
            @endphp
            <div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                    <span style="font-size:13px;color:rgba(255,255,255,0.65);">👨‍🍳 {{ $cocinero->name }}</span>
                    <span style="font-size:13px;font-weight:500;color:{{ $color }};">
                        {{ $cocinero->recetas_count }} receta{{ $cocinero->recetas_count != 1 ? 's' : '' }}
                    </span>
                </div>
                <div style="background:rgba(255,255,255,0.05);border-radius:999px;height:8px;overflow:hidden;">
                    <div class="ck-bar" data-w="{{ $pct }}"
                        style="height:100%;width:0%;background:{{ $color }};border-radius:999px;transition:width 1s cubic-bezier(.4,0,.2,1);">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
        <script>
        (function(){
            const labels = @json($cocineros->pluck('name'));
            const counts = @json($cocineros->pluck('recetas_count'));
            const total  = counts.reduce((a,b)=>a+b,0)||1;
            const colors = ['#00aaff','#1D9E75','#D85A30','#7F77DD','#BA7517','#D4537E'];
            const bgs    = colors.map(c=>c+'99');

            new Chart(document.getElementById('ckChart'),{
                type:'doughnut',
                data:{
                    labels,
                    datasets:[{ data:counts, backgroundColor:bgs, borderColor:colors, borderWidth:2, hoverOffset:10 }]
                },
                options:{
                    responsive:true, maintainAspectRatio:false, cutout:'68%',
                    plugins:{
                        legend:{ display:false },
                        tooltip:{
                            backgroundColor:'#1a1a1a', borderColor:'rgba(255,255,255,0.1)', borderWidth:1,
                            titleColor:'#fff', bodyColor:'rgba(255,255,255,0.6)',
                            callbacks:{ label: ctx=>`  ${ctx.parsed} recetas (${Math.round(ctx.parsed/total*100)}%)` }
                        }
                    }
                },
                plugins:[{
                    id:'center',
                    afterDraw(chart){
                        const {ctx,chartArea:{left,top,width,height}}=chart;
                        ctx.save();
                        ctx.font='800 28px Syne,sans-serif';
                        ctx.fillStyle='#fff';
                        ctx.textAlign='center';
                        ctx.textBaseline='middle';
                        ctx.fillText(total, left+width/2, top+height/2-10);
                        ctx.font='400 12px DM Sans,sans-serif';
                        ctx.fillStyle='rgba(255,255,255,0.35)';
                        ctx.fillText('recetas', left+width/2, top+height/2+16);
                        ctx.restore();
                    }
                }]
            });

            setTimeout(()=>{
                document.querySelectorAll('.ck-bar').forEach(el=>{ el.style.width=el.dataset.w+'%'; });
            },200);
        })();
        </script>
    @endif

</div>
@endif

{{-- ═══════════════════════════════════════════
     ENCABEZADO
═══════════════════════════════════════════ --}}
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
    <div>
        <h1 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:white;margin-bottom:4px;">Recetas</h1>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;">{{ $recetas->count() }} receta(s) en el sistema</p>
    </div>
    @if(Auth::user()->esCocinero() || Auth::user()->esAdmin())
    <a href="{{ route('recetas.create') }}"
        style="background:#00aaff;color:white;text-decoration:none;font-size:13px;font-weight:600;padding:10px 20px;border-radius:8px;"
        onmouseover="this.style.background='#0088cc'" onmouseout="this.style.background='#00aaff'">
        + Nueva receta
    </a>
    @endif
</div>

{{-- ═══════════════════════════════════════════
     CARDS
═══════════════════════════════════════════ --}}
@if($recetas->isEmpty())
    <div style="text-align:center;padding:80px 0;color:rgba(255,255,255,0.3);">
        <span style="font-size:48px;display:block;margin-bottom:16px;">🍽️</span>
        <p style="font-family:'Syne',sans-serif;font-size:18px;">Aún no hay recetas registradas.</p>
    </div>
@else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
        @foreach($recetas as $receta)
        <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:24px;display:flex;flex-direction:column;gap:16px;"
            onmouseover="this.style.borderColor='rgba(255,255,255,0.15)'"
            onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'">

            <div>
                <h2 style="font-family:'Syne',sans-serif;font-size:17px;font-weight:700;color:white;margin-bottom:4px;">{{ $receta->titulo }}</h2>
                <p style="color:rgba(255,255,255,0.3);font-size:12px;">
                    Por <span style="color:rgba(255,255,255,0.5);">{{ $receta->autor->name }}</span> · {{ $receta->created_at->diffForHumans() }}
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
            <div style="display:flex;flex-direction:column;gap:8px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.05);margin-top:auto;">
                <a href="{{ route('recetas.pdf', $receta) }}"
                    style="display:block;text-align:center;font-size:13px;font-weight:600;background:rgba(0,170,255,0.12);border:1px solid rgba(0,170,255,0.3);color:#00aaff;padding:8px;border-radius:8px;text-decoration:none;"
                    onmouseover="this.style.background='rgba(0,170,255,0.2)'"
                    onmouseout="this.style.background='rgba(0,170,255,0.12)'">
                    📄 Descargar PDF
                </a>
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('recetas.edit', $receta) }}"
                        style="flex:1;text-align:center;font-size:13px;border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);padding:8px;border-radius:8px;text-decoration:none;"
                        onmouseover="this.style.borderColor='#00aaff';this.style.color='#00aaff'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.6)'">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('recetas.destroy', $receta) }}" style="flex:1;" onsubmit="return confirm('¿Eliminar esta receta?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="width:100%;font-size:13px;border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.6);padding:8px;border-radius:8px;background:transparent;cursor:pointer;"
                            onmouseover="this.style.borderColor='rgba(255,77,77,0.5)';this.style.color='#ff4d4d'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.6)'">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
            @endif

        </div>
        @endforeach
    </div>
@endif

</x-app-layout>
