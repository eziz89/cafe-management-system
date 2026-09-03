let audioContext = null;

/**
 * Create or get the browser audio context.
 */
function getAudioContext() {

    if (!audioContext) {

        const AudioContext =
            window.AudioContext ||
            window.webkitAudioContext;

        if (!AudioContext) {
            return null;
        }

        audioContext = new AudioContext();
    }

    return audioContext;
}


/**
 * Unlock audio after the admin interacts with the page.
 *
 * Browsers usually block automatic audio until
 * the user has interacted with the page.
 */
async function unlockAudio() {

    const context = getAudioContext();

    if (!context) return;

    if (context.state === 'suspended') {
        await context.resume();
    }

}


/**
 * Listen for the first user interaction.
 */
document.addEventListener(
    'pointerdown',
    unlockAudio,
    {
        once: true,
        passive: true
    }
);

document.addEventListener(
    'keydown',
    unlockAudio,
    {
        once: true
    }
);


/**
 * Play a subtle notification sound.
 */
async function playNotificationSound() {

    const context = getAudioContext();

    if (!context) return;

    if (context.state === 'suspended') {

        try {
            await context.resume();
        } catch (error) {
            console.warn(
                'Could not unlock notification sound:',
                error
            );

            return;
        }

    }

    const now = context.currentTime;

    /*
     * First tone
     */
    const oscillator1 =
        context.createOscillator();

    const gain1 =
        context.createGain();

    oscillator1.type = 'sine';

    oscillator1.frequency.setValueAtTime(
        880,
        now
    );

    gain1.gain.setValueAtTime(
        0,
        now
    );

    gain1.gain.linearRampToValueAtTime(
        0.15,
        now + 0.02
    );

    gain1.gain.exponentialRampToValueAtTime(
        0.001,
        now + 0.35
    );

    oscillator1.connect(gain1);
    gain1.connect(context.destination);

    oscillator1.start(now);
    oscillator1.stop(now + 0.35);


    /*
     * Second tone
     */
    const oscillator2 =
        context.createOscillator();

    const gain2 =
        context.createGain();

    oscillator2.type = 'sine';

    oscillator2.frequency.setValueAtTime(
        1174,
        now + 0.12
    );

    gain2.gain.setValueAtTime(
        0,
        now + 0.12
    );

    gain2.gain.linearRampToValueAtTime(
        0.12,
        now + 0.14
    );

    gain2.gain.exponentialRampToValueAtTime(
        0.001,
        now + 0.5
    );

    oscillator2.connect(gain2);
    gain2.connect(context.destination);

    oscillator2.start(now + 0.12);
    oscillator2.stop(now + 0.5);

}


/**
 * Start reusable live refresh.
 */
export function startLiveRefresh({
    url,
    container,
    itemSelector,
    interval = 5000,
    highlightClass = 'live-new-item'
}) {

    const target = document.querySelector(container);

    if (!target) {
        console.log('Container not found:', container);
        return;
    }

    let firstRefresh = true;

    async function refresh() {

        try {

            // Remember items currently visible.
            const existingItems = new Set(
                [...target.querySelectorAll(itemSelector)]
                    .map(item => item.id)
                    .filter(Boolean)
            );

            // Preserve the current page and filters.
            const liveUrl = new URL(
                url,
                window.location.origin
            );

            const currentParams = new URLSearchParams(
                window.location.search
            );

            currentParams.forEach((value, key) => {
                liveUrl.searchParams.set(key, value);
            });

            const response = await fetch(liveUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            if (!response.ok) {
                throw new Error(
                    `Live refresh failed: ${response.status}`
                );
            }

            const html = await response.text();

            // Replace current table/card contents.
            target.innerHTML = html;

            let hasNewItems = false;

            target
                .querySelectorAll(itemSelector)
                .forEach(item => {

                    if (!existingItems.has(item.id)) {

                        // Don't announce items during the initial refresh.
                        if (!firstRefresh) {
                            hasNewItems = true;

                            item.classList.add(
                                highlightClass
                            );

                            setTimeout(() => {

                                item.classList.remove(
                                    highlightClass
                                );

                            }, 3000);
                        }

                    }

                });

            // Play sound only after the initial load.
            if (!firstRefresh && hasNewItems) {
                playNotificationSound();
            }

            firstRefresh = false;

        } catch (error) {

            console.error(
                'Live refresh failed:',
                error
            );

        }

    }

    // Initial load.
    refresh();

    // Continue refreshing.
    setInterval(
        refresh,
        interval
    );
}