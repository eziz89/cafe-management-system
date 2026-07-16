document.addEventListener('DOMContentLoaded', () => {

    const timeline = document.getElementById('order-timeline');

    if (!timeline) return;

    const orderId = timeline.dataset.orderId;

    setInterval(async () => {

        try {

            const response = await fetch(`/orders/${orderId}/status`);

            const data = await response.json();

            timeline.innerHTML = data.timeline;

            const badge = document.getElementById('order-status-badge');

            if (badge) {
            
                badge.innerHTML = data.badge;
            
            }

        } catch (error) {

            console.error('Order status update error:', error);

        }

    }, 5000);

});