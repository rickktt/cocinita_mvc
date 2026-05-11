<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Receta — {{ $receta->titulo }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1a1a1a;
            padding: 40px;
            background: #fff;
        }

        /* Encabezado */
        .header {
            border-bottom: 3px solid #00aaff;
            padding-bottom: 16px;
            margin-bottom: 28px;
        }

        .header .brand {
            font-size: 13px;
            color: #00aaff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 800;
            color: #0a0a0a;
            margin-bottom: 6px;
        }

        .header .meta {
            font-size: 12px;
            color: #888;
        }

        /* Secciones */
        .section {
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #00aaff;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e5e5;
        }

        .section-content {
            font-size: 13px;
            line-height: 1.8;
            color: #333;
            white-space: pre-line;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 12px;
            border-top: 1px solid #e5e5e5;
            font-size: 11px;
            color: #aaa;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="brand">Cocinita — Ficha de Receta</div>
        <h1>{{ $receta->titulo }}</h1>
        <div class="meta">
            Creado por: {{ $receta->autor->name }} &nbsp;·&nbsp;
            Fecha: {{ $receta->created_at->format('d/m/Y') }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Ingredientes</div>
        <div class="section-content">{{ $receta->ingredientes }}</div>
    </div>

    <div class="section">
        <div class="section-title">Pasos de Preparación</div>
        <div class="section-content">{{ $receta->pasos }}</div>
    </div>

    <div class="footer">
        © {{ date('Y') }} Cocinita — Documento generado automáticamente
    </div>

</body>
</html>
