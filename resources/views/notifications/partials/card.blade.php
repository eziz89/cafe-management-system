<div
    id="notification-{{ $notification->id }}"
    class="bg-white rounded-3xl shadow-md hover:shadow-xl transition p-8 mb-6 border

    {{ $notification->is_read
        ? 'border-transparent opacity-80'
        : 'border-orange-300'
    }}"
>

    <div class="flex justify-between items-start">

        <div>

            <h2 class="text-2xl font-bold text-stone-800">

                {{ $notification->title }}

            </h2>

            <p class="text-stone-500 mt-3 leading-relaxed">

                {{ $notification->message }}

            </p>

        </div>

        @unless($notification->is_read)

            <span
                class="bg-orange-100
                    text-orange-600
                    text-xs
                    font-bold
                    px-3
                    py-1
                    rounded-full">

                NEW

            </span>

        @endunless

    </div>

    <div class="flex justify-between items-center mt-8">

        <span class="text-stone-400 text-sm">

            {{ $notification->created_at->diffForHumans() }}

        </span>

    </div>

</div>