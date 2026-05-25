<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        .rating label {
            font-size: 2rem;
            color: #d1d5db;
            cursor: pointer;
            transition: 0.2s;
        }

        .rating label:hover,
        .rating label:hover ~ label {
            color: #f59e0b;
        }

        .rating input:checked ~ label {
            color: #f59e0b;
        }

    </style>
    
</head>
<body class="bg-gray-100">
    
    <x-navbar />
    <div class="max-w-7xl mx-auto px-6">
        
        @yield('content')
    </div>
    <x-footer />

</body>
</html>