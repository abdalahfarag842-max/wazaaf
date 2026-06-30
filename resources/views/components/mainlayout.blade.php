<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wazaaf</title>
   @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/sidebar.js'])
</head>
<body>
    @include('layouts.navbar')
    <div class="page-wrapper" id="pageWrapper">
        {{ $slot }}
    </div>
</body>
</html>
