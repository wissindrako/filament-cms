<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nuevo contacto</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:ui-sans-serif,system-ui,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:40px 20px;">
    <tr><td align="center">
        <table width="100%" style="max-width:560px;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);">

            {{-- Header --}}
            <tr>
                <td style="background:linear-gradient(135deg,#4f46e5,#7c3aed);padding:32px 40px;">
                    <p style="margin:0;font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#c7d2fe;">Nuevo mensaje de contacto</p>
                    <h1 style="margin:8px 0 0;font-size:1.5rem;font-weight:800;color:#ffffff;letter-spacing:-0.02em;">
                        {{ $data['name'] }}
                    </h1>
                    <p style="margin:4px 0 0;font-size:0.875rem;color:#c7d2fe;">{{ $data['email'] }}</p>
                </td>
            </tr>

            {{-- Body --}}
            <tr>
                <td style="padding:32px 40px;">

                    @if(!empty($data['service']))
                    <table width="100%" style="margin-bottom:24px;">
                        <tr>
                            <td style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:12px 16px;">
                                <p style="margin:0 0 4px;font-size:0.75rem;font-weight:700;color:#6366f1;text-transform:uppercase;letter-spacing:0.08em;">Servicio de interés</p>
                                <p style="margin:0;font-size:0.9375rem;font-weight:600;color:#0f172a;">{{ $data['service'] }}</p>
                            </td>
                        </tr>
                    </table>
                    @endif

                    <p style="margin:0 0 8px;font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.08em;">Mensaje</p>
                    <div style="background:#f8fafc;border-left:3px solid #6366f1;border-radius:0 8px 8px 0;padding:16px 20px;margin-bottom:28px;">
                        <p style="margin:0;font-size:0.9375rem;color:#334155;line-height:1.7;white-space:pre-wrap;">{{ $data['message'] }}</p>
                    </div>

                    <a href="mailto:{{ $data['email'] }}"
                       style="display:inline-block;background:#6366f1;color:#ffffff;font-size:0.875rem;font-weight:700;padding:12px 24px;border-radius:8px;text-decoration:none;">
                        Responder a {{ $data['name'] }}
                    </a>
                </td>
            </tr>

            {{-- Footer --}}
            <tr>
                <td style="padding:20px 40px;border-top:1px solid #f1f5f9;">
                    <p style="margin:0;font-size:0.75rem;color:#94a3b8;">
                        Este mensaje fue enviado desde el formulario de contacto de tu sitio web.
                    </p>
                </td>
            </tr>

        </table>
    </td></tr>
</table>
</body>
</html>
