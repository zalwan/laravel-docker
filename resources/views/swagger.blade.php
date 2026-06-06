<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Docs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5/swagger-ui.css">
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
    <script>
        const swaggerToken = @json($swaggerToken);

        function authorizeSwagger(token) {
            if (!token || !window.ui) {
                return;
            }

            window.ui.preauthorizeApiKey('bearerAuth', token);
            window.localStorage.setItem('swagger_bearer_token', token);
        }

        window.onload = function () {
            window.ui = SwaggerUIBundle({
                url: "{{ url('/api/openapi.json') }}",
                dom_id: '#swagger-ui',
                presets: [
                    SwaggerUIBundle.presets.apis,
                ],
                layout: 'BaseLayout',
                onComplete: function () {
                    authorizeSwagger(swaggerToken || window.localStorage.getItem('swagger_bearer_token'));
                },
                responseInterceptor: function (response) {
                    const token = response.data?.data?.token;

                    if (token) {
                        authorizeSwagger(token);
                    }

                    return response;
                },
            });
        };
    </script>
</body>
</html>
