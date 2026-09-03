@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto pb-6 px-4 sm:px-0">

        <div class="sm:mb-10 mb-6">
            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Administrasiýa
            </p>
            <h1 class="text-3xl sm:text-4xl font-bold text-stone-900">
                Bronlamalar
            </h1>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

            <div class="flex flex-col md:flex-row gap-4">
        
                <div class="relative flex-1">

                    <i data-lucide="search"
                       class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-stone-400">
                    </i>
                
                    <input
                        id="reservation-search"
                        type="text"
                        value="{{ request('search') }}"
                        placeholder="Search by name or phone..."
                        class="w-full pl-12 pr-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
                
                </div>
        
                <select
                    id="reservation-status-filter"
                    class="px-5 py-3 rounded-2xl border border-stone-200">
        
                    <option value="">Ähli ýagdaýlar</option>
        
                    <option value="pending">
                        Garaşylanlar
                    </option>
        
                    <option value="confirmed">
                        Tassyklananlar
                    </option>
        
                    <option value="cancelled">
                        Ýatyrylanlar
                    </option>
        
                </select>
        
        
                <select
                    id="reservation-sort-filter"
                    class="px-5 py-3 rounded-2xl border border-stone-200">
        
                    <option value="newest">
                        Täzeler
                    </option>
        
                    <option value="oldest">
                        Köneler
                    </option>
        
                    <option value="guests_desc">
                        Iň köp myhmanlylar
                    </option>
        
                    <option value="time">
                        Bronlama wagty
                    </option>
        
                </select>
        
        
                <button 
                    id="reservation-reset" 
                    type="button"
                    class="w-full md:w-auto px-4 py-3 rounded-2xl border border-stone-300 hover:bg-stone-100 transition">

                    <div class="flex items-center justify-center gap-2">
                        <i data-lucide="circle-x" class="w-5 h-5"></i>
                        Täzelemek
                    </div>

                </button>
        
            </div>
        
        </div>

        <div id="reservations-table">

            @include('admin.reservations.partials.table')
            
        </div>

    </div>

@endsection