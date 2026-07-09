document.addEventListener('DOMContentLoaded', () => {

    const search = document.getElementById('order-search');

    const reset = document.getElementById('reset-filters');

    if (!search) return;

    let timeout;

    // -----------------------------
    // ACTIVE FILTER STATE
    // -----------------------------
    let activeFilter = new URLSearchParams(window.location.search).get('status') || '';

    const buttons = document.querySelectorAll('.order-filter');

    const statusClasses = {
        pending: 'bg-gray-200 text-gray-700',
        preparing: 'bg-yellow-100 text-yellow-700',
        completed: 'bg-green-100 text-green-700',
        cancelled: 'bg-red-100 text-red-700',
    };

    // -----------------------------
    // FILTER UI
    // -----------------------------
    search.addEventListener('input', () => {

        clearTimeout(timeout);

        timeout = setTimeout(() => {

            fetchOrders(activeFilter);
        }, 300);
    });
    
    function updateActiveButton(status) {

        buttons.forEach(button => {

            button.classList.remove('bg-orange-500', 'text-white');
            button.classList.add('bg-stone-200');

            if (button.dataset.status === status) {
                button.classList.remove('bg-stone-200');
                button.classList.add('bg-orange-500', 'text-white');
            }
        });
    }

    async function fetchOrders(status = activeFilter, pageUrl = null) {

        const url = pageUrl ? new URL(pageUrl) : new URL(window.location.href);

        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }

        if (search.value.trim()) {

            url.searchParams.set(
                'search',
                search.value.trim()
            );
        
        } else {
        
            url.searchParams.delete('search');
        
        }
        
        window.history.replaceState({}, '', url);

        const wrapper = document.getElementById('orders-table');

        wrapper.classList.add('opacity-50');

        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        wrapper.innerHTML = html;

        wrapper.classList.remove('opacity-50');

        updateActiveButton(status);

        activeFilter = status;
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            fetchOrders(button.dataset.status);
        });
    });

    updateActiveButton(activeFilter);

    // -----------------------------
    // SMART ACTION RENDERER
    // -----------------------------
    function renderActions(status, orderId) {

        const base = (value, label, color) => `
            <form class="order-status-form" data-order-id="${orderId}" action="/admin/orders/${orderId}/status"   method="POST">
                <input type="hidden" name="status" value="${value}">
                <button class="${color} px-4 py-2 rounded-xl text-sm">
                    ${label}
                </button>
            </form>
        `;

        if (status === 'pending') {
            return `
                ${base('preparing', 'Start Preparing', 'bg-orange-500 text-white')}
                ${base('cancelled', 'Cancel', 'bg-red-500 text-white')}
            `;
        }

        if (status === 'preparing') {
            return `
                ${base('completed', 'Complete', 'bg-green-500 text-white')}
                ${base('cancelled', 'Cancel', 'bg-red-500 text-white')}
            `;
        }

        return `<span class="text-stone-400 text-sm">No actions</span>`;
    }

    // -----------------------------
    // LIVE STATUS UPDATE (EVENT DELEGATION)
    // -----------------------------
    document.addEventListener('submit', async (e) => {

        if (!e.target.matches('.order-status-form')) return;

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

        const orderId = form.dataset.orderId;

        // -----------------------------
        // UPDATE COUNTERS
        // -----------------------------
        const updateCounter = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.textContent = value;
        };

        updateCounter('all-count', data.counters.all);
        updateCounter('pending-count', data.counters.pending);
        updateCounter('preparing-count', data.counters.preparing);
        updateCounter('completed-count', data.counters.completed);
        updateCounter('cancelled-count', data.counters.cancelled);

        // -----------------------------
        // REMOVE IF FILTER DOESN'T MATCH
        // -----------------------------
        const orderCard = document.getElementById(`order-${orderId}`);

        if (activeFilter && data.status !== activeFilter) {
            if (orderCard) orderCard.remove();
            return;
        }

        // -----------------------------
        // UPDATE BADGE
        // -----------------------------
        const badge = document.getElementById(`order-status-${orderId}`);

        if (badge) {

            badge.textContent =
                data.status.charAt(0).toUpperCase() +
                data.status.slice(1);

            document.getElementById(
                `order-actions-${orderId}`
            ).innerHTML = data.actions;

            badge.classList.remove(
                'bg-gray-200', 'text-gray-700',
                'bg-yellow-100', 'text-yellow-700',
                'bg-green-100', 'text-green-700',
                'bg-red-100', 'text-red-700'
            );

            badge.classList.add(
                ...statusClasses[data.status].split(' ')
            );
        }

        // -----------------------------
        // UPDATE ACTION BUTTONS (NEW)
        // -----------------------------
        const actions = document.getElementById(`order-actions-${orderId}`);

        if (actions) {
            actions.innerHTML = renderActions(data.status, orderId);
        }

        console.log(data);

        const actionsContainer = document.getElementById(
            `order-actions-${orderId}`
        );

        if (actionsContainer && data.actions) {
            actionsContainer.innerHTML = data.actions;
        }
    });

    reset?.addEventListener('click', () => {
        
        search.value = '';

        activeFilter = '';

        updateActiveButton('');
        
        fetchOrders('');

    });

    document.addEventListener('click', (e) => {

        const link = e.target.closest('.pagination a');
        
        if (!link) return;
        
        e.preventDefault();
        
        fetchOrders(activeFilter, link.href);
        
    });

});