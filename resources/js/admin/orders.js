document.addEventListener('DOMContentLoaded', () => {

    const buttons = document.querySelectorAll('.order-filter');

    if (!buttons.length) return;

    async function fetchOrders(status = '') {

        const url = new URL(window.location.href);

        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
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
    }

    function updateActiveButton(status) {

        buttons.forEach(button => {

            button.classList.remove(
                'bg-orange-500',
                'text-white'
            );

            button.classList.add(
                'bg-stone-200'
            );

            if (button.dataset.status === status) {

                button.classList.remove('bg-stone-200');

                button.classList.add(
                    'bg-orange-500',
                    'text-white'
                );

            }

        });

    }

    buttons.forEach(button => {

        button.addEventListener('click', () => {

            fetchOrders(button.dataset.status);

        });

    });

    const params = new URLSearchParams(window.location.search);

    updateActiveButton(params.get('status') || '');

});