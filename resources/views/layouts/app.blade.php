<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Canteen</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/app.js',
    ])

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
<body>
    
    <x-navbar />
        
        @yield('content')

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons()</script>
    
</body>
</html>