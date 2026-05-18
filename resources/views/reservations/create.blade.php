@extends('layouts.app')

@section('content')

    <section class="bg-neutral-950 min-h-screen py-20 px-8">
    
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div>
                <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold mb-4">
                    Reservation
                </p>
                <h1 class="text-6xl font-bold text-white leading-tight mb-8">
                    Reserve Your
                    Perfect Dining
                    Experience.
                </h1>
                <p class="text-neutral-400 text-lg leading-relaxed mb-10">
                    Enjoy a comfortable atmosphere, carefully prepared dishes,
                    and seamless table reservations designed for memorable moments.
                </p>
    
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-orange-500/20 flex items-center justify-center text-2xl">
                            🍽️
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">
                                Premium Dining
                            </h3>
                            <p class="text-neutral-400">
                                Comfortable and elegant atmosphere.
                            </p>
                        </div>
                    </div>
    
                    <div class="flex items-center gap-4">
    
                        <div class="w-14 h-14 rounded-2xl bg-orange-500/20 flex items-center justify-center text-2xl">
                            ⏰
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">
                                Fast Reservation
                            </h3>
                            <p class="text-neutral-400">
                                Reserve your table within seconds.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="bg-neutral-900/80 backdrop-blur border border-neutral-800 rounded-[2rem] p-10 shadow-2xl">
                <h2 class="text-3xl font-bold text-white mb-8">
                    Book a Table
                </h2>
                <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                    @csrf
    
                    <div>
                        <label class="text-neutral-300 block mb-2">
                            Name
                        </label>
                        <input type="text" name="name"
                               class="w-full bg-neutral-800 border border-neutral-700
                                    rounded-2xl px-5 py-4 text-white
                                    focus:outline-none focus:border-orange-500">
                    </div>
                    <div>
                        <label class="text-neutral-300 block mb-2">
                            Phone
                        </label>
                        <input type="text" name="phone"
                               class="w-full bg-neutral-800 border border-neutral-700
                                    rounded-2xl px-5 py-4 text-white
                                    focus:outline-none focus:border-orange-500">
                    </div>
    
                    <div>
                        <label class="text-neutral-300 block mb-2">
                            Guests
                        </label>
                        <input type="number" name="guests"
                               class="w-full bg-neutral-800 border border-neutral-700
                                    rounded-2xl px-5 py-4 text-white
                                    focus:outline-none focus:border-orange-500">
                    </div>
    
                    <div>
                        <label class="text-neutral-300 block mb-2">
                            Reservation Time
                        </label>
                        <input type="datetime-local" name="reservation_time"
                               class="w-full bg-neutral-800 border border-neutral-700
                                    rounded-2xl px-5 py-4 text-white
                                    focus:outline-none focus:border-orange-500">
                    </div>
    
                    <button type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-600
                                hover:shadow-lg hover:shadow-orange-500/30
                                text-white py-4 rounded-2xl font-semibold
                                transition duration-300">
                        Confirm Reservation
                    </button>
                </form>
            </div>
        </div>
    
    </section>

@endsection