@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto pt-4 pb-6">

        <div class="mb-10">
            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Administration
            </p>
            <h1 class="text-4xl font-bold text-stone-900">
                Reservations
            </h1>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

            <div class="flex flex-col md:flex-row gap-4">
        
                <input
                    id="reservation-search"
                    type="text"
                    value="{{ request('search') }}"
                    placeholder="🔍 Search by name or phone..."
                    class="flex-1 px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
        
        
                <select
                    id="reservation-status-filter"
                    class="px-5 py-3 rounded-2xl border border-stone-200">
        
                    <option value="">All Statuses</option>
        
                    <option value="pending">
                        Pending
                    </option>
        
                    <option value="confirmed">
                        Confirmed
                    </option>
        
                    <option value="cancelled">
                        Cancelled
                    </option>
        
                </select>
        
        
                <select
                    id="reservation-sort-filter"
                    class="px-5 py-3 rounded-2xl border border-stone-200">
        
                    <option value="newest">
                        Newest
                    </option>
        
                    <option value="oldest">
                        Oldest
                    </option>
        
                    <option value="guests_desc">
                        Most Guests
                    </option>
        
                    <option value="time">
                        Reservation Time
                    </option>
        
                </select>
        
        
                <button id="reservation-reset" type="button" class="px-4 py-3 rounded-2xl border border-stone-300 hover:bg-stone-100 transition">

                    <div class="flex items-center gap-2">
                        <i data-lucide="circle-x" class="w-5 h-5"></i>
                        Reset
                    </div>
        
                </button>
        
            </div>
        
        </div>

        <div id="reservations-table">
            @include('admin.reservations.partials.table')
        </div>

    </div>

@endsection