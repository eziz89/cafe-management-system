@extends('layouts.admin')

@section('content')

<section class="min-h-screen bg-stone-100">

    <div class="max-w-7xl mx-auto pt-4 pb-8">
        
        <div class="mb-10">
            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Administration
            </p>

            <h1 class="text-4xl font-bold text-stone-900">
                Orders
            </h1>
        </div>
        
        @include('admin.orders.partials.filter-bar')

        <div id="orders-table">

            @include('admin.orders.partials.orders-table')

        </div>

    </div>

</section>

@endsection