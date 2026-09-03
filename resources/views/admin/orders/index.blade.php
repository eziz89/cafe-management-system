@extends('layouts.admin')

@section('content')

<section class="min-h-screen bg-stone-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 pb-6">
        
        <div class="mb-6">
            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Administrasiýa
            </p>

            <h1 class="text-4xl font-bold text-stone-900">
                Sargytlar
            </h1>
        </div>
        
        @include('admin.orders.partials.filter-bar')

        <div id="table">

            @include('admin.orders.partials.table')

        </div>

    </div>

</section>

@endsection