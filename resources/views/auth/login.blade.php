<x-guest-layout>
<div style="width:100%;max-width:440px;">
    <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:40px;box-shadow:0 0 40px rgba(0,170,255,0.08);">

        <h1 style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800;color:#00aaff;margin-bottom:6px;">Bienvenido</h1>
        <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-bottom:32px;">Acceso al sistema de cocina</p>

        @if(session('status'))
            <div style="margin-bottom:16px;color:#00aaff;font-size:13px;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="tucorreo@ejemplo.com"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('email')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Contraseña</label>
                <input type="password" name="password" required
                    placeholder="••••••••"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('password')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            <div style="display:flex;align-items:center;gap:8px;margin-bottom:24px;">
                <input type="checkbox" name="remember" id="remember" style="accent-color:#00aaff;">
                <label for="remember" style="color:rgba(255,255,255,0.4);font-size:13px;">Recordarme</label>
            </div>

            <button type="submit"
                style="width:100%;background:#00aaff;border:none;border-radius:8px;padding:12px;color:white;font-size:14px;font-weight:600;cursor:pointer;transition:all 0.3s;"
                onmouseover="this.style.background='#0088cc'" onmouseout="this.style.background='#00aaff'">
                Iniciar sesión
            </button>

            <p style="text-align:center;color:rgba(255,255,255,0.4);font-size:13px;margin-top:20px;">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" style="color:#00aaff;text-decoration:none;margin-left:4px;">Regístrate</a>
            </p>

            @if(Route::has('password.request'))
            <p style="text-align:center;margin-top:10px;">
                <a href="{{ route('password.request') }}" style="color:rgba(255,255,255,0.3);font-size:12px;text-decoration:none;">¿Olvidaste tu contraseña?</a>
            </p>
            @endif
        </form>
    </div>
</div>
</x-guest-layout>
