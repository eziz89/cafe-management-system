@extends('layouts.app')

@section('content')

<div class="bg-stone-100 min-h-screen">

    <div class="max-w-5xl mx-auto py-16 px-6">

        <div class="flex justify-between items-center mb-10">

            <div>

                <p class="uppercase tracking-[0.3em] text-orange-500 font-semibold text-sm">
                    Notification Center
                </p>

                <h1 class="text-5xl font-bold text-stone-800 mt-2">
                    Notifications
                </h1>

            </div>

        </div>

        @forelse($notifications as $notification)

            @include('notifications.partials.card')

        @empty

            @include('notifications.partials.empty')

        @endforelse

        <div class="mt-10">

            {{ $notifications->links() }}

        </div>

    </div>

</div>

@endsection