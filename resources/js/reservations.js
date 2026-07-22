console.log('reservations.js loaded');
async function pollReservationStatus(id)
{
    try {

        console.log('Polling reservation:', id);

        const response = await fetch(`/reservations/${id}/status`);

        const data = await response.json();

        console.log(data);

        const badge = document.getElementById(
            `reservation-badge-${id}`
        );

        if (badge) {
            badge.innerHTML = data.badge;
        }

    } catch (error) {

        console.error('Reservation status error:', error);

    }
}

const reservationCards = document.querySelectorAll('[id^="reservation-card-"]');

reservationCards.forEach(card => {

    const id = card.dataset.id;
    const status = card.dataset.status;

    if(status === 'pending') {

        pollReservationStatus(id);

        setInterval(() => {

            pollReservationStatus(id);

        }, 5000);

    }

});