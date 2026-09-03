const button = document.getElementById('mobile-menu-button');
const menu = document.getElementById('mobile-menu');
const close = document.getElementById('mobile-menu-close');
const overlay = document.getElementById('mobile-overlay');


function openMenu() {

    menu.classList.remove('translate-x-full');
    overlay.classList.remove('hidden');

}


function closeMenu() {

    menu.classList.add('translate-x-full');
    overlay.classList.add('hidden');

}


if(button && menu && close && overlay){

    button.addEventListener('click', openMenu);

    close.addEventListener('click', closeMenu);

    overlay.addEventListener('click', closeMenu);

}

const accountButton = document.getElementById('mobile-account-button');
const accountMenu = document.getElementById('mobile-account-menu');
const accountArrow = document.getElementById('account-arrow');


if(accountButton && accountMenu){

    accountButton.addEventListener('click', () => {

        accountMenu.classList.toggle('hidden');

        accountArrow.classList.toggle('rotate-180');

    });

}