@extends('layouts.guest')

@section('content')

<div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-bold mb-6">
        {{ __('login.login') }}
    </h1>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{  session('success') }}
        </div>
            
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="{{ __('login.email') }}" class="w-full border p-3 rounded-lg mb-4">
        <input type="password" name="password" placeholder="{{ __('login.password') }}" class="w-full border p-3 rounded-lg mb-4">
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl transition">
            {{ __('login.login') }}
        </button>
    </form>

    <p class="text-sm text-center text-gray-600 mt-4">
        {{ __("login.don't_have_an_account") }}

        <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">
            {{ __('login.create_account') }}
        </a>
    </p>

</div>

@endsection