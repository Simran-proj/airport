<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Email</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4E56C0; color: white; padding: 20px; text-align: center; border-radius: 10px; }
        .content { padding: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Correo de Prueba</h1>
        </div>
        
        <div class="content">
            <h2>¡Hola!</h2>
            <p>Este es un correo de prueba enviado desde Mailtrap.</p>
            <p>Fecha y hora: {{ now()->format('Y-m-d H:i:s') }}</p>
            <p>Si recibes esto, ¡el correo funciona correctamente! 🎉</p>
        </div>
        
        <div style="margin-top: 30px; text-align: center; color: #666; font-size: 12px;">
            <p>Heathrow Air Park - Sistema de correos</p>
        </div>
    </div>
</body>
</html>