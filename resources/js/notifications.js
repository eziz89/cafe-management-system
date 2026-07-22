async function loadNotifications() {

    try {

        const response = await fetch('/notifications/unread');

        const data = await response.json();

        const badge = document.getElementById('notification-count');

        if (!badge) return;

        if (data.count > 0) {

            badge.textContent = data.count;

            badge.classList.remove('hidden');

        } else {

            badge.classList.add('hidden');

        }

    } catch (error) {

        console.error(error);

    }

}

document.addEventListener('DOMContentLoaded', () => {

    loadNotifications();

    pollNotifications();

    setInterval(() => {

        loadNotifications();

        pollNotifications();

    }, 5000);

});

document.addEventListener('click', async (e) => {

    const btn = e.target.closest('.notification-read');

    if (!btn) return;

    const id = btn.dataset.id;

    const response = await fetch(`/notifications/${id}/read`, {

        method: 'POST',

        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .content,

            'Accept': 'application/json',
        }

    });

    const data = await response.json();

    if (!data.success) return;

    const card = document.getElementById(`notification-${id}`);

    card.classList.remove('border-orange-300');

    card.classList.add(
        'border-transparent',
        'opacity-80'
    );

    btn.remove();

    const badge = card.querySelector('span.bg-orange-100');

    if (badge) badge.remove();

    loadNotifications();

});

let shownNotifications = JSON.parse(localStorage.getItem('shown_notifications')) || [];

function showToast(notification) {

    const container = document.getElementById('toast-container');

    if (!container) return;

    let icon = '🔔';
    let color = 'border-orange-500';

    if (notification.type === 'order_status') {

        icon = '🍳';

        color = 'border-orange-500';

    }

    if (notification.type === 'promotion') {

        icon = '🎁';

        color = 'border-green-500';

    }

    if (notification.type === 'announcement') {

        icon = '📢';

        color = 'border-blue-500';

    }

    const toast = document.createElement('div');

    toast.className = `
        bg-white
        rounded-2xl
        shadow-2xl
        border-l-4
        ${color}
        p-5
        w-96
        transform
        translate-x-full
        transition-all
        duration-500
    `;

    toast.innerHTML = `

        <div class="flex gap-4">

            <div class="text-3xl">
                ${icon}
            </div>

            <div>

                <h3 class="font-bold text-stone-800">
                    ${notification.title}
                </h3>

                <p class="text-stone-500 mt-1">
                    ${notification.message}
                </p>

            </div>

        </div>

    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);

    setTimeout(() => {

        toast.classList.add('translate-x-full');

        setTimeout(() => {
            toast.remove();
        }, 500);

    }, 5000);

}

function getNotificationIcon(type)
{
    switch(type)
    {
        case 'order_status':
            return '🍳';

        case 'promotion':
            return '🎉';

        case 'announcement':
            return '📢';


        default:
            return '🔔';
    }
}

async function pollNotifications()
{
    try {
        const response = await fetch('/notifications/poll');

        const data = await response.json();

        data.notifications.forEach(async notification => {

            if (!shownNotifications.includes(notification.id)) {
            
                showToast(notification);
            
                shownNotifications.push(notification.id);

                localStorage.setItem('shown_notifications', JSON.stringify(shownNotifications));
            
            }
        
        });

    }

    catch(error)
    {
        console.error(error);
    }

}