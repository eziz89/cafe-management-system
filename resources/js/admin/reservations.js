document.addEventListener('DOMContentLoaded', () => {

    const search = document.getElementById('reservation-search');
    const status = document.getElementById('reservation-status-filter');
    const sort = document.getElementById('reservation-sort-filter');
    const reset = document.getElementById('reservation-reset');

    if (!search) return;
    
    const params = new URLSearchParams(window.location.search);

    if (search) {
        search.value = params.get('search') || '';
    }

    if (status) {
        status.value = params.get('status') || '';
    }

    if (sort) {
        sort.value = params.get('sort') || 'newest';
    }

    let timeout;

    async function fetchReservations(pageUrl = null) {

        const url = pageUrl ? new URL(pageUrl) : new URL(window.location.href);

        if (search && search.value.trim()) {

            url.searchParams.set(
                'search',
                search.value.trim()
            );

        } else {

            url.searchParams.delete('search');

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

        const wrapper = document.getElementById('reservations-table');

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

    if (search) {

        search.addEventListener('input', () => {

            clearTimeout(timeout);

            timeout = setTimeout(() => {

                fetchReservations();

            }, 300);

        });

    }

    status?.addEventListener('change', () => {

        fetchReservations();

    });

    sort?.addEventListener('change', () => {

        fetchReservations();

    });

    reset?.addEventListener('click', () => {

        if (search) search.value = '';

        if (status) status.value = '';

        if (sort) sort.value = 'newest';

        fetchReservations();

    });

    document.addEventListener('submit', async (e) => {

        if (!e.target.matches('.reservation-status-form')) {
            return;
        }

        e.preventDefault();

        const form = e.target;

        const response = await fetch(form.action, {

            method: 'POST',

            body: new FormData(form),

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }

        });

        const data = await response.json();

        const id = form.dataset.id;

        // Update badge

        const badge = document.getElementById(
            `reservation-status-${id}`
        );

        if (badge) {

            badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);

            badge.classList.remove(
                'bg-gray-200',
                'text-gray-700',
                'bg-green-100',
                'text-green-700',
                'bg-red-100',
                'text-red-700'
            );

            if (data.status === 'confirmed') {

                badge.classList.add(
                    'bg-green-100',
                    'text-green-700'
                );

            }

            if (data.status === 'cancelled') {

                badge.classList.add(
                    'bg-red-100',
                    'text-red-700'
                );

            }

        }

        // Update actions

        const actions =
            document.getElementById(
                `reservation-actions-${id}`
            );

        if (actions) {

            if (data.status === 'confirmed') {

                actions.innerHTML = `
                    <span class="text-green-600 font-semibold">
                        ✓ Reservation confirmed
                    </span>
                `;

            }

            if (data.status === 'cancelled') {

                actions.innerHTML = `
                    <span class="text-red-600 font-semibold">
                        ✕ Reservation cancelled
                    </span>
                `;

            }

        }

    });

    document.addEventListener('click', (e) => {

        const link = e.target.closest('.pagination a');

        if (!link) return;

        e.preventDefault();

        fetchReservations(link.href);

    });

});