document.addEventListener('DOMContentLoaded', () => {

    refreshCartCount();

    const emptyCartTemlate = `${document.getElementById('empty-cart-template')?.innerHTML || ''}`;

    document.addEventListener('click', async (e) => {

        const btn = e.target.closest('.add-to-cart-btn');

        if (!btn) return;

        e.preventDefault();

        const dishId = btn.dataset.id;

        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = "...";

        try {
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content

            const response = await fetch(`/cart/add/${dishId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrf,
                    "Accept": "application/json"
                }
            });

            const data = await response.json();

            updateCartBadge(data.cart_count);

            btn.innerHTML = "✓";

            setTimeout(() => {

                btn.innerHTML = originalText;
                btn.disabled = false;

            }, 900);

        } catch (error) {

            console.error(error);

            btn.innerHTML = originalText;
            btn.disabled = false;

        }

    });

    function updateCartBadge(count) {

        const link = document.querySelector('.cart-link');

        let badge = document.getElementById('cart-count');

        if (count > 0) {

            if (!badge) {

                badge = document.createElement('span');

                badge.id = 'cart-count';

                badge.className = 'absolute -top-0 -right-5 min-w-5 h-5 px-1 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center';

                link.appendChild(badge);
            }

            badge.textContent = count;

        } else {

            badge?.remove();

        }

    }

    async function refreshCartCount() {

        try {

            const response = await fetch("/cart/count");

            const data = await response.json();

            updateCartBadge(data.count);

        } catch (error) {

            console.error(error);

        }

    }

    document.addEventListener('click', async (e) => {
        
        const btn = e.target.closest('.cart-increase');
        if (!btn) return;

        const id = btn.dataset.id;
        
        const response = await fetch(`/cart/increase/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        document.getElementById('cart-items').innerHTML = data.cart_html;

        updateSummary(data);
    });

    document.addEventListener('click', async (e) => {

        const btn = e.target.closest('.cart-decrease');
        if (!btn) return;

        const id = btn.dataset.id;

        const response = await fetch(`/cart/decrease/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        document.getElementById('cart-items').innerHTML = data.cart_html;

        updateSummary(data);
    });

    document.addEventListener('click', async (e) => {

        const btn = e.target.closest('.cart-remove');
        if (!btn) return;

        const id = btn.dataset.id;

        const response = await fetch(`/cart/remove/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        document.getElementById('cart-items').innerHTML = data.cart_html;

        updateSummary(data);
    });

    function updateSummary(data) {

        updateCartBadge(data.cart_count);
        document.getElementById('cart-items-count').textContent = data.total_items;
        document.getElementById('cart-total').textContent = '$' + data.total_price;

    }

});