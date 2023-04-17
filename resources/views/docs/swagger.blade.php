<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('swagger-ui/swagger-ui.css') }}">
</head>
<body>
<div id="swagger-ui"></div>
<script src="{{ asset('swagger-ui/swagger-ui-bundle.js') }}"></script>
<script src="{{ asset('swagger-ui/swagger-ui-standalone-preset.js') }}"></script>
<script>
    window.onload = function () {
        const ui = SwaggerUIBundle({
            url: "{{ asset('docs/openapi.yaml') }}",
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });
        window.ui = ui;
    };
</script>
</body>
</html>
