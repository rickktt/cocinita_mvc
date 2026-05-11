<x-app-layout>

<div style="margin-bottom:40px;display:flex;justify-content:space-between;align-items:flex-start;">
    <div>
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
    @if(Auth::user()->esAdmin())
    <button onclick="toggleStats()" style="background:#00aaff;border:none;border-radius:8px;padding:10px 20px;color:white;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.3s;"
        onmouseover="this.style.background='#0088cc'" onmouseout="this.style.background='#00aaff'">
        📊 Ver Estadísticas
    </button>
    @endif
</div>

{{-- ADMIN --}}
@if(Auth::user()->esAdmin())
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;margin-bottom:40px;">

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

{{-- SECCIÓN DE ESTADÍSTICAS --}}
<div id="statsSection" style="display:none;margin-top:40px;">
    <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:32px;">
        <h2 style="font-family:'Syne',sans-serif;font-size:24px;font-weight:800;color:white;margin-bottom:24px;">
            📊 Estadísticas del Sistema
        </h2>

        {{-- Estadísticas Generales --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:32px;">
            <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;text-align:center;">
                <p style="color:rgba(255,255,255,0.4);font-size:12px;margin-bottom:8px;">Total Usuarios</p>
                <h3 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:#00aaff;" id="totalUsers">0</h3>
            </div>
            <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;text-align:center;">
                <p style="color:rgba(255,255,255,0.4);font-size:12px;margin-bottom:8px;">Cocineros</p>
                <h3 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:#00aaff;" id="chefCount">0</h3>
            </div>
            <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;text-align:center;">
                <p style="color:rgba(255,255,255,0.4);font-size:12px;margin-bottom:8px;">Asistentes</p>
                <h3 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:#00aaff;" id="assistantCount">0</h3>
            </div>
            <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;text-align:center;">
                <p style="color:rgba(255,255,255,0.4);font-size:12px;margin-bottom:8px;">Total Recetas</p>
                <h3 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:#00aaff;" id="totalRecipes">0</h3>
            </div>
        </div>

        {{-- Gráficas --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(400px,1fr));gap:32px;margin-top:32px;">
            
            {{-- Gráfica de Usuarios por Rol --}}
            <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;">
                <h3 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:white;margin-bottom:20px;">
                    Usuarios por Rol
                </h3>
                <canvas id="rolesChart" style="max-height:300px;"></canvas>
            </div>

            {{-- Gráfica de Usuarios Registrados por Mes --}}
            <div style="background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;">
                <h3 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:white;margin-bottom:20px;">
                    Registros por Mes
                </h3>
                <canvas id="registrationChart" style="max-height:300px;"></canvas>
            </div>
        </div>

        {{-- Tabla de Usuarios Recientes --}}
        <div style="margin-top:32px;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:20px;overflow-x:auto;">
            <h3 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:white;margin-bottom:20px;">
                Usuarios Recientes
            </h3>
            <table style="width:100%;color:rgba(255,255,255,0.8);font-size:13px;">
                <thead>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.1);">
                        <th style="text-align:left;padding:12px 0;color:rgba(255,255,255,0.6);font-weight:600;">Nombre</th>
                        <th style="text-align:left;padding:12px 0;color:rgba(255,255,255,0.6);font-weight:600;">Email</th>
                        <th style="text-align:left;padding:12px 0;color:rgba(255,255,255,0.6);font-weight:600;">Rol</th>
                        <th style="text-align:left;padding:12px 0;color:rgba(255,255,255,0.6);font-weight:600;">Fecha Registro</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                </tbody>
            </table>
        </div>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function toggleStats() {
    const statsSection = document.getElementById('statsSection');
    statsSection.style.display = statsSection.style.display === 'none' ? 'block' : 'none';
    if (statsSection.style.display === 'block') {
        loadStatistics();
    }
}

let rolesChart = null;
let registrationChart = null;

async function loadStatistics() {
    try {
        const response = await fetch('/api/statistics');
        const data = await response.json();

        // Actualizar números
        document.getElementById('totalUsers').textContent = data.totalUsers;
        document.getElementById('chefCount').textContent = data.chefCount;
        document.getElementById('assistantCount').textContent = data.assistantCount;
        document.getElementById('totalRecipes').textContent = data.totalRecipes;

        // Tabla de usuarios recientes
        const tbody = document.getElementById('usersTableBody');
        tbody.innerHTML = '';
        data.recentUsers.forEach(user => {
            const row = document.createElement('tr');
            row.style.borderBottom = '1px solid rgba(255,255,255,0.05)';
            row.innerHTML = `
                <td style="padding:12px 0;">${user.name}</td>
                <td style="padding:12px 0;color:rgba(255,255,255,0.6);">${user.email}</td>
                <td style="padding:12px 0;">
                    <span style="padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;text-transform:uppercase;background:rgba(0,170,255,0.15);color:#00aaff;">
                        ${user.rol}
                    </span>
                </td>
                <td style="padding:12px 0;color:rgba(255,255,255,0.6);">${user.created_at}</td>
            `;
            tbody.appendChild(row);
        });

        // Gráfica de roles
        const rolesCtx = document.getElementById('rolesChart').getContext('2d');
        if (rolesChart) rolesChart.destroy();
        rolesChart = new Chart(rolesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Cocineros', 'Asistentes', 'Administradores'],
                datasets: [{
                    data: [data.chefCount, data.assistantCount, data.adminCount],
                    backgroundColor: [
                        'rgba(0, 170, 255, 0.8)',
                        'rgba(255, 107, 107, 0.8)',
                        'rgba(126, 211, 33, 0.8)'
                    ],
                    borderColor: [
                        '#00aaff',
                        '#ff6b6b',
                        '#7ed321'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'rgba(255,255,255,0.8)',
                            font: { size: 12 }
                        }
                    }
                }
            }
        });

        // Gráfica de registros por mes
        const registrationCtx = document.getElementById('registrationChart').getContext('2d');
        if (registrationChart) registrationChart.destroy();
        registrationChart = new Chart(registrationCtx, {
            type: 'line',
            data: {
                labels: data.monthlyRegistrations.map(m => m.month),
                datasets: [{
                    label: 'Usuarios registrados',
                    data: data.monthlyRegistrations.map(m => m.count),
                    borderColor: '#00aaff',
                    backgroundColor: 'rgba(0, 170, 255, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#00aaff',
                    pointBorderColor: '#fff',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        labels: {
                            color: 'rgba(255,255,255,0.8)',
                            font: { size: 12 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: 'rgba(255,255,255,0.6)',
                            font: { size: 11 }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: 'rgba(255,255,255,0.6)',
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error loading statistics:', error);
        alert('Error al cargar las estadísticas. Verifica la consola.');
    }
}
</script>
