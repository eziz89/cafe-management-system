document.querySelectorAll('.favorite-btn').forEach(button => {
    
    button.addEventListener('click', async function (e) {
    
        e.preventDefault();
        e.stopPropagation();
    
        const dishId = button.dataset.id;
    
        const response = await fetch(`/favorites/${dishId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':
                    document
                        .querySelector('meta[name="csrf-token"]')
                        .content,

                'Content-Type':
                    'application/json',

                'Accept':
                    'application/json',

                'X-Requested-With':
                    'XMLHttpRequest'
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