<x-app-layout>

<div style="max-width:640px;">
    <div style="margin-bottom:32px;">
        <a href="{{ route('recetas.index') }}" style="color:rgba(255,255,255,0.3);font-size:13px;text-decoration:none;"
            onmouseover="this.style.color='rgba(255,255,255,0.6)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">
            ← Volver a recetas
        </a>
        <h1 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;color:white;margin-top:12px;">Nueva Receta</h1>
    </div>

    <div style="background:#111;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:32px;">
        <form method="POST" action="{{ route('recetas.store') }}">
            @csrf

            <div style="margin-bottom:24px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Título de la receta</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" required
                    placeholder="Ej. Caldo de res con verduras"
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('titulo')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Ingredientes</label>
                <textarea name="ingredientes" rows="5" required
                    placeholder="Lista los ingredientes, uno por línea..."
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;resize:none;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">{{ old('ingredientes') }}</textarea>
                @error('ingredientes')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:32px;">
                <label style="display:block;color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:6px;">Pasos de preparación</label>
                <textarea name="pasos" rows="6" required
                    placeholder="Describe el proceso paso a paso..."
                    style="width:100%;background:#1a1a1a;border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:10px 14px;color:white;font-size:13px;outline:none;box-sizing:border-box;resize:none;"
                    onfocus="this.style.borderColor='#00aaff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">{{ old('pasos') }}</textarea>
                @error('pasos')<p style="margin-top:6px;color:#ff4d4d;font-size:12px;">{{ $message }}</p>@enderror
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit"
                    style="background:#00aaff;border:none;border-radius:8px;padding:10px 24px;color:white;font-size:14px;font-weight:600;cursor:pointer;"
                    onmouseover="this.style.background='#0088cc'" onmouseout="this.style.background='#00aaff'">
                    Guardar receta
                </button>
                <a href="{{ route('recetas.index') }}"
                    style="border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.5);padding:10px 24px;border-radius:8px;font-size:14px;text-decoration:none;transition:all 0.2s;"
                    onmouseover="this.style.borderColor='rgba(255,255,255,0.2)';this.style.color='rgba(255,255,255,0.8)'"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.5)'">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
