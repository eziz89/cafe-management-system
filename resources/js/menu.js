document.addEventListener('DOMContentLoaded', () => {

    const menuContainer = document.getElementById('menu-container');

    if (!menuContainer) return;

    const loadingOverlay = document.getElementById('menu-loading');

    function showLoading() {

        if (!loadingOverlay) return;

        loadingOverlay.classList.remove('hidden');

    }

    function hideLoading() {

        if (!loadingOverlay) return;

        loadingOverlay.classList.add('hidden');

    }
    
    /**
     * =========================
     * 1. STATE (SOURCE OF TRUTH)
     * =========================
     */
    const params = new URLSearchParams(window.location.search);

    const state = {
        search: params.get('search') || '',
        sort: params.get('sort') || 'newest',
        category: params.get('category') || '',
    };

    /**
     * =========================
     * 2. DOM ELEMENTS
     * =========================
     */
    const searchInput = document.querySelector('input[name="search"]');
    const sortSelect = document.getElementById('sortSelect');
    const resetBtn = document.getElementById('resetBtn');

    let timeout;

    /**
     * =========================
     * 3. INIT UI ON PAGE LOAD
     * =========================
     */
    initializeUI();

    function initializeUI() {

        if (searchInput) {
            searchInput.value = state.search;
        }

        if (sortSelect) {
            sortSelect.value = state.sort;
        }

        if (state.category) {
            const activeBtn = document.querySelector(
                `.category-filter[data-category="${state.category}"]`
            );

            if (activeBtn) setActiveCategory(activeBtn);
        } else {
            const allBtn = document.querySelector(
                `.category-filter[data-category=""]`
            );

            if (allBtn) setActiveCategory(allBtn);
        }
    }

    /**
     * =========================
     * 4. MAIN AJAX ENGINE
     * =========================
     */
    async function updateDishes() {

        const url = new URL(window.location.href);

        Object.keys(state).forEach(key => {

            if (state[key]) {
                url.searchParams.set(key, state[key]);
            } else {
                url.searchParams.delete(key);
            }

        });

        await loadPage(url);

    }

    async function loadPage(url) {

        showLoading();

        try {

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            const data = await response.json();

            document.getElementById('dishes-container').innerHTML = data.grid;

            document.getElementById('menu-info-container').innerHTML = data.info;
            
            document.getElementById('active-filters-container').innerHTML = data.filters;

            hideLoading();

            window.history.replaceState({}, '', url);

        } catch (error) {

            hideLoading();

            console.error(error);

        }

    }

    /**
     * =========================
     * 5. SEARCH (DEBOUNCED)
     * =========================
     */
    if (searchInput) {

        searchInput.addEventListener('input', (e) => {

            clearTimeout(timeout);

            timeout = setTimeout(() => {

                state.search = e.target.value.trim();

                updateDishes();

            }, 300);

        });

    }

    /**
     * =========================
     * 6. SORTING
     * =========================
     */
    if (sortSelect) {

        sortSelect.addEventListener('change', (e) => {

            state.sort = e.target.value;

            updateDishes();

        });

    }

    /**
     * =========================
     * 7. CATEGORY (EVENT DELEGATION — IMPORTANT FIX)
     * =========================
     */
    document.addEventListener('click', (e) => {

        const btn = e.target.closest('.category-filter');

        if (!btn) return;

        e.preventDefault();

        state.category = btn.dataset.category || '';

        setActiveCategory(btn);

        updateDishes();
    });

    /**
     * =========================
     * AJAX PAGINATION
     * =========================
     */
    document.addEventListener('click', async (e) => {
    
        const link = e.target.closest('#pagination-container a');
    
        if (!link) return;
    
        e.preventDefault();
    
        const url = new URL(link.href);
    
        Object.keys(state).forEach(key => {
        
            if (state[key]) {
                url.searchParams.set(key, state[key]);
            }
        
        });
    
        await loadPage(url);
    
    });

    /**
     * =========================
     * 8. RESET
     * =========================
     */
    if (resetBtn) {

        resetBtn.addEventListener('click', (e) => {

            e.preventDefault();

            state.search = '';
            state.sort = 'newest';
            state.category = '';

            if (searchInput) searchInput.value = '';
            if (sortSelect) sortSelect.value = 'newest';

            clearActiveCategoryUI();

            updateDishes();
        });

    }

    /**
     * =========================
     * 9. UI HELPERS
     * =========================
     */
    function setActiveCategory(activeBtn) {

        clearActiveCategoryUI();

        activeBtn.classList.add(
            'bg-orange-100',
            'text-orange-600',
            'font-semibold'
        );
    }

    function clearActiveCategoryUI() {

        document.querySelectorAll('.category-filter').forEach(btn => {

            btn.classList.remove(
                'bg-orange-100',
                'text-orange-600',
                'font-semibold'
            );

        });

    }
    
});