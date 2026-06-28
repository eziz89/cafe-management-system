@extends('layouts.admin')

@section('content')

    <section class="min-h-screen bg-stone-100">

        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-4">
                    Administration
                </p>
                <h1 class="text-5xl font-bold text-stone-800">
                    Orders
                </h1>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

                <div class="flex flex-wrap gap-3 items-center">

                    <span class="font-semibold text-stone-700">
                        Filter:
                    </span>

                    <button data-status=""
                        class="order-filter px-4 py-2 rounded-full bg-orange-500 text-white">
                        All
                    </button>

                    <button data-status="pending"
                        class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300">
                        Pending
                    </button>

                    <button data-status="preparing"
                        class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300">
                        Preparing
                    </button>

                    <button data-status="completed"
                        class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300">
                        Completed
                    </button>

                    <button data-status="cancelled"
                        class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300">
                        Cancelled
                    </button>

                </div>

            </div>

            <div class="space-y-8 mb-12">
                <div id="orders-table">
                    @include('admin.orders.partials.orders-table')
                </div>
            </div>
        </div>
    
    </section>

@endsection