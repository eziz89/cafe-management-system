document.addEventListener('DOMContentLoaded', () => {

    if (!document.querySelector('[id^="order-badge-"]'))
        return;

    setInterval(async () => {

        try {
        
            const response = await fetch('/my-orders/statuses');
        
            const orders = await response.json();
        
            orders.forEach(order => {
            
                const badge = document.getElementById(
                    `order-badge-${order.id}`
                );
            
                if (badge) {
                
                    badge.innerHTML = order.badge;
                
                }
            
            });
        
        } catch (error) {

        console.error(error);

        }
    
    }, 5000);

});