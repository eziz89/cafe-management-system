document.addEventListener('DOMContentLoaded', () => {

    const search = document.getElementById('dish-search');
    const category = document.getElementById('category-filter');
    const reset = document.getElementById('reset-filters');
    const status = document.getElementById('status-filter');
    const sort = document.getElementById('sort-filter');

    if (!search) return;
    
    const params = new URLSearchParams(window.location.search);

    let timeout;

    status?.addEventListener('change', () => {
        fetchDishes();
    });
    
    sort?.addEventListener('change', () => {
        fetchDishes();
    });

    if (search) {

        search.addEventListener('input', () => {

            clearTimeout(timeout);

            timeout = setTimeout(() => {
                fetchDishes();
            }, 300);

        });

    }

    async function fetchDishes(pageUrl = null) {

        const url = pageUrl
            ? new URL(pageUrl)
            : new URL(window.location.href);

        if (search && search.value.trim()) {

            url.searchParams.set(
                'search',
                search.value.trim()
            );
        
        } else {
        
            url.searchParams.delete('search');
        
        }


        if (category && category.value) {
        
            url.searchParams.set(
                'category',
                category.value
            );
        
        } else {
        
            url.searchParams.delete('category');
        
        }


        if (status && status.value) {
        
            url.searchParams.set(
                'status',
                status.value
            );
        
        } else {
        
            url.searchParams.delete('status');
        
        }


        if (sort && sort.value && sort.value !== 'newest') {
        
            url.searchParams.set(
                'sort',
                sort.value
            );
        
        } else {
        
            url.searchParams.delete('sort');
        
        }

        window.history.replaceState({}, '', url);

        const wrapper = document.getElementById('dishes-table');

        wrapper.classList.add('opacity-50');

        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        wrapper.innerHTML = html;

        wrapper.classList.remove('opacity-50');
    }

    if (category) {

        category.addEventListener('change', () => {
            fetchDishes();
        });
    }   

    if (reset) {

        reset.addEventListener('click', () => {

            if (search) {
                search.value = '';
            }
            
            if (category) {
                category.value = '';
            }
            
            if (status) {
                status.value = '';
            }
            
            if (sort) {
                sort.value = 'newest';
            }

            fetchDishes();

        });
    }

    if (status) {
        status.value = params.get('status') || '';
    }
    
    if (sort) {
        sort.value = params.get('sort') || 'newest';
    }

    document.addEventListener('click', (e) => {

        const link = e.target.closest('a[href*="page"]');

        if (!link) return;

        e.preventDefault();

        console.log('Pagination clicked:', link.href);

        fetchDishes(link.href);

    });

    const dishStatusClasses = {
        available: "bg-green-100 text-green-700",
        coming_soon: "bg-yellow-100 text-yellow-700",
        out_of_stock: "bg-red-100 text-red-700",
    };

    document.addEventListener("change", async (e) => {

        if (!e.target.matches(".dish-status-select")) {
            return;
        }
    
        const form = e.target.closest(".dish-status-form");
    
        if (!form) {
            return;
        }
    
        try {
        
            const response = await fetch(form.action, {
                method: "POST",
                body: new FormData(form),
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json",
                },
            });
        
            if (!response.ok) {
                throw new Error(`Status update failed: ${response.status}`);
            }
        
            const data = await response.json();
        
            const dishId = form.dataset.dishId;
        
            const badges = document.querySelectorAll(
                `.dish-status-badge[data-dish-id="${dishId}"]`
            );
        
            badges.forEach((badge) => {
            
                badge.classList.remove(
                    "bg-green-100",
                    "text-green-700",
                    "bg-yellow-100",
                    "text-yellow-700",
                    "bg-red-100",
                    "text-red-700"
                );
            
                if (data.status === "available") {
                
                    badge.classList.add(
                        "bg-green-100",
                        "text-green-700"
                    );
                
                    badge.innerHTML = `
                        <i data-lucide="circle-check" class="w-4 h-4"></i>
                        Available
                    `;
                
                } else if (data.status === "coming_soon") {
                
                    badge.classList.add(
                        "bg-yellow-100",
                        "text-yellow-700"
                    );
                
                    badge.innerHTML = `
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        Coming Soon
                    `;
                
                } else {
                
                    badge.classList.add(
                        "bg-red-100",
                        "text-red-700"
                    );
                
                    badge.innerHTML = `
                        <i data-lucide="circle-x" class="w-4 h-4"></i>
                        Out of Stock
                    `;
                
                }
            
            });
        
            if (window.lucide) {
                lucide.createIcons();
            }
        
        } catch (error) {
        
            console.error("Dish status update failed:", error);
        
        }
    
    });

});