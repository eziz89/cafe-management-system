<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gubadag Fitçi</title>

    @vite([
        'resources/css/app.css',
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

        @keyframes custom-wave {
            0%, 100% { transform: rotate(0deg); }
            20%, 60% { transform: rotate(-15deg); }
            40%, 80% { transform: rotate(15deg); }
        }
        
        .wave-effect {
            animation: custom-wave 1.5s ease-in-out infinite;
            transform-origin: 80% 80%; /* Pivots naturally from the base of the palm */
            display: inline-block;
        }

    </style>
    
</head>

<body data-authenticated="{{ auth()->check() ? 'true' : 'false' }}" class="overflow-x-hidden">
    
    <x-navbar />
        
        @yield('content')

    <x-footer />

    <div id="toast-container"
        class="fixed top-6 right-6 z-50 space-y-4">
    </div>

</body>
</html>