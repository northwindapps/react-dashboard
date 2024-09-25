<!DOCTYPE html>
<html>
<head>
<title>Your App</title>
    @if (env('VITE_ENABLED', true))
        @viteReactRefresh
        @vite('resources/src/index.jsx') <!-- If your main JS file is renamed to app.jsx -->
    @endif
</head>
<body>
    <div id="root"></div>
</body>
</html>
