document.addEventListener('DOMContentLoaded', () => {

    const addressSection = document.getElementById('address-section');

    const radios = document.querySelectorAll(
        'input[name="order_type"]'
    );

    function updateAddressVisibility() {

        const address = document.getElementById('address-container');

        if (!address) return;
        
        const selected = document.querySelector(
            'input[name="order_type"]:checked'
        )?.value;

        if (selected === 'delivery') {

            addressSection.classList.remove('hidden');

        } else {

            addressSection.classList.add('hidden');

        }
    }

    radios.forEach(radio => {

        radio.addEventListener('change', updateAddressVisibility);

    });

    updateAddressVisibility();

});