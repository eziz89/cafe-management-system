
document.addEventListener('DOMContentLoaded', () => {

    const search = document.getElementById('dish-search');
    const category = document.getElementById('category-filter');

    if (!search || !category) return;

    const params = new URLSearchParams(window.location.search);

    search.value = params.get('search') || '';

    category.value = params.get('category') || '';

    let timeout;

    search.addEventListener('input', function () {

        clearTimeout(timeout);

        timeout = setTimeout(fetchDishes, 300);

    });

    category.addEventListener('change', () => {
        fetchDishes();
    });

    async function fetchDishes() {

        const url = new URL(window.location.pathname, window.location.origin);

        if (search.value.trim()) {
            url.searchParams.set('search', search.value.trim());
        } else {
            url.searchParams.delete('search');
        }

        if (category.value) {
            url.searchParams.set('category', category.value);
        } else {
            url.searchParams.delete('category');
        }

        window.history.replaceState({}, '', url);
        
        const table = document.getElementById('dishes-table');

        const wrapper = document.getElementById('table-wrapper');

        wrapper.classList.add('opacity-50');
        
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        document.getElementById('dishes-table').innerHTML = html;
            
        wrapper.classList.remove('opacity-50');
    }

});