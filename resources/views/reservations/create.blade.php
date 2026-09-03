
@extends('layouts.app')

@section('content')

    <section class="bg-gray-50">
            
        <div class="min-h-screen py-10">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 grid lg:grid-cols-2 gap-10 lg:gap-20 items-center">

                <div>

                    <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold mb-4">
                        {{ __('reservation.reservation') }}
                    </p>

                    <h1 class="sm:text-6xl text-4xl font-bold text-neutral-900 leading-tight sm:mb-6 mb-4">
                        {{ __('reservation.reservation_title') }}
                    </h1>

                    <p class="text-neutral-500 text-base sm:text-lg leading-relaxed sm:mb-10 mb-6">
                        {{ __('reservation.reservations_description') }}
                    </p>

                    <div class="space-y-6">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl text-white bg-orange-500/50 flex items-center justify-center text-2xl">
                                <i data-lucide="utensils" class="w-6 h-6"></i>
                            </div>

                            <div>

                                <h3 class="text-neutral-800 font-semibold text-lg">
                                    {{ __('reservation.reservation_feature_1') }}
                                </h3>

                                <p class="text-neutral-500">
                                    {{ __('reservation.reservation_feature_1_description') }}
                                </p>
                                
                            </div>

                        </div>

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 text-white rounded-2xl bg-orange-500/50 flex items-center justify-center text-2xl">
                                <i data-lucide="clock-3" class="w-6 h-6"></i>
                            </div>

                            <div>

                                <h3 class="text-neutral-800 font-semibold text-lg">
                                    {{ __('reservation.reservation_feature_2') }}
                                </h3>

                                <p class="text-neutral-500">
                                    {{ __('reservation.reservation_feature_2_description') }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-[2rem] p-10 shadow-xl">

                    <h2 class="text-3xl font-bold text-neutral-900 mb-8">
                        {{ __('reservation.reservation_book') }}
                    </h2>

                    @if(session('success'))

                        <div class="bg-green-100 text-green-700 px-6 py-4 rounded-2xl mb-6">
                            {{ session('success') }}
                        </div>

                    @endif

                    @if($errors->any())

                        <div class="bg-red-100 text-red-700 px-6 py-4 rounded-2xl mb-6">

                            <ul class="list-disc ml-6 space-y-2">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif 

                    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>

                            <label class="text-neutral-900 font-semibold block mb-2">
                                {{ __('reservation.name') }}
                            </label>

                            <input type="text" name="name" class="w-full bg-white border border-orange-500 rounded-2xl px-5 py-4 text-neutral-900 focus:outline-none focus:border-orange-500">
                        
                        </div>

                        <div>

                            <label class="text-neutral-900 font-semibold block mb-2">
                                {{ __('reservation.phone') }}
                            </label>

                            <input type="text" name="phone" class="w-full bg-white border border-orange-500 rounded-2xl px-5 py-4 text-neutral-900 focus:outline-none focus:border-orange-500">
                        
                        </div>

                        <div>

                            <label class="text-neutral-900 font-semibold block mb-2">
                                {{ __('reservation.guests') }}
                            </label>

                            <input type="number" name="guests" class="w-full bg-white border border-orange-500 rounded-2xl px-5 py-4 text-neutral-900 focus:outline-none focus:border-orange-500">
                        
                        </div>

                        <div>

                            <label class="text-neutral-900 font-semibold block mb-2">
                                {{ __('reservation.reservation_time') }}
                            </label>

                            <input type="datetime-local" name="reservation_time" class="w-full bg-white border border-orange-500 rounded-2xl px-5 py-4 text-neutral-900 focus:outline-none focus:border-orange-500">
                        
                        </div>

                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white py-4 rounded-2xl font-semibold transition duration-300">
                            {{ __('reservation.reservation_confirm') }}
                        </button>

                    </form>

                </div>

            </div>

        </div>
    
    </section>

@endsection