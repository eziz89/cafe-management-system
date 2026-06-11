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
<body>
    
    <x-navbar />
        
        @yield('content')

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons()</script>
    <script>
        document.querySelectorAll('.favorite-btn').forEach(button => {
        
            button.addEventListener('click', async function (e) {
            
                e.preventDefault();
                e.stopPropagation();
            
                const dishId = button.dataset.id;
            
                const response = await fetch(`/favorites/${dishId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
            
                const data = await response.json();
            
                if (data.favorited) {
                
                    button.classList.add('bg-red-500', 'text-white');
                    button.classList.remove('bg-white/90', 'text-gray-600');
                
                } else {
                
                    button.classList.remove('bg-red-500', 'text-white');
                    button.classList.add('bg-white/90', 'text-gray-600');
                
                }
            
            });
        
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {

        new Swiper('.categorySwiper', {

            modules: [
                Navigation,
                Pagination,
                Autoplay
            ],

            loop: true,

            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            breakpoints: {

                0: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },

                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },

                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                }

            }

        });

    });
    </script>

</body>
</html>