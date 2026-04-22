<x-guest-layout>
<div style="width:100%;max-width:440px;">
    <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:40px;box-shadow:0 0 40px rgba(0,170,255,0.08);">

        <h1 style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800;color:#00aaff;margin-bottom:6px;">Registro</h1>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-bottom:32px;">Crea tu cuenta de cocina</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nombre --}}
            <div style="margin-bottom:20px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    placeholder="Tu nombre"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('name')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div style="margin-bottom:20px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    placeholder="tucorreo@ejemplo.com"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('email')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            {{-- Password --}}
            <div style="margin-bottom:20px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Contraseña</label>
                <input type="password" name="password" required
                    placeholder="Mínimo 8 caracteres"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('password')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            {{-- Confirmar password --}}
            <div style="margin-bottom:24px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" required
                    placeholder="Repite tu contraseña"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
            </div>

            {{-- Rol --}}
            <div style="margin-bottom:28px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:12px;">Rol</label>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">

                    <label style="cursor:pointer;">
                        <input type="radio" name="rol" value="Cocinero"
                            {{ old('rol') == 'Cocinero' ? 'checked' : '' }}
                            style="display:none;"
                            onchange="selectRol(this)">
                        <div id="card-cocinero" onclick="document.querySelector('[value=Cocinero]').checked=true;selectRol(document.querySelector('[value=Cocinero]'));"
                            style="border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:16px;text-align:center;background:#1a1a1a;transition:all 0.2s;cursor:pointer;">
                            <span style="font-size:24px;display:block;margin-bottom:6px;">👨‍🍳</span>
                            <span style="color:white;font-size:13px;font-weight:500;">Cocinero</span>
                        </div>
                    </label>

                    <label style="cursor:pointer;">
                        <input type="radio" name="rol" value="Asistente"
                            {{ old('rol') == 'Asistente' ? 'checked' : '' }}
                            style="display:none;"
                            onchange="selectRol(this)">
                        <div id="card-asistente" onclick="document.querySelector('[value=Asistente]').checked=true;selectRol(document.querySelector('[value=Asistente]'));"
                            style="border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:16px;text-align:center;background:#1a1a1a;transition:all 0.2s;cursor:pointer;">
                            <span style="font-size:24px;display:block;margin-bottom:6px;">🍽️</span>
                            <span style="color:white;font-size:13px;font-weight:500;">Asistente</span>
                        </div>
                    </label>

                </div>
                @error('rol')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                style="width:100%;background:#00aaff;border:none;border-radius:8px;padding:12px;color:white;font-size:14px;font-weight:600;cursor:pointer;"
                onmouseover="this.style.background='#0088cc'" onmouseout="this.style.background='#00aaff'">
                Crear cuenta
            </button>

            <p style="text-align:center;color:rgba(255,255,255,0.4);font-size:13px;margin-top:20px;">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" style="color:#00aaff;text-decoration:none;margin-left:4px;">Inicia sesión</a>
            </p>
        </form>
    </div>
</div>

<script>
function selectRol(input) {
    document.getElementById('card-cocinero').style.borderColor = 'rgba(255,255,255,0.1)';
    document.getElementById('card-cocinero').style.background = '#1a1a1a';
    document.getElementById('card-asistente').style.borderColor = 'rgba(255,255,255,0.1)';
    document.getElementById('card-asistente').style.background = '#1a1a1a';

    var card = document.getElementById('card-' + input.value.toLowerCase());
    if (card) {
        card.style.borderColor = '#00aaff';
        card.style.background = 'rgba(0,170,255,0.1)';
    }
}
// Marcar el seleccionado al cargar si hay old()
document.addEventListener('DOMContentLoaded', function() {
    var checked = document.querySelector('input[name="rol"]:checked');
    if (checked) selectRol(checked);
});
</script>
</x-guest-layout>
