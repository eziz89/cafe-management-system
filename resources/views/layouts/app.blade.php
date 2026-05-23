<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    
    <x-navbar />
    <div class="max-w-7xl mx-auto px-6">
        
        @yield('content')
    </div>
    <x-footer />

</body>
</html>