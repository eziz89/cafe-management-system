import { createIcons } from 'lucide';
import './admin/dishes';
import './admin/orders';
import './admin/reservations';

document.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flash-message');

    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';

            setTimeout(() => flash.remove(), 500);
        }, 3000);
    }
});

const adminMenuBtn = document.getElementById('admin-menu-btn');
const adminMobileMenu = document.getElementById('admin-mobile-menu');

if (adminMenuBtn && adminMobileMenu) {

    adminMenuBtn.addEventListener('click', () => {
        adminMobileMenu.classList.toggle('hidden');
    });

}

createIcons();