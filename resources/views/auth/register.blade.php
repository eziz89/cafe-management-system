
@extends('layouts.guest')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">

    <div class="bg-white shadow-xl rounded-3xl p-10 w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-2">
            {{ __('register.register') }}
        </h1>

        <p class="text-gray-500 text-center mb-4">
            {{ __('register.join_us') }}
        </p>

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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium">
                    {{ __('register.name') }}
                </label>
                <input type="text" name="name" class="w-full border border-orange-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-orange-300">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium">
                    {{ __('register.email') }}
                </label>
                <input type="email" name="email" class="w-full border border-orange-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-orange-300">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium">
                    {{ __('register.password') }}
                </label>
                <input type="password" name="password" class="w-full border border-orange-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-orange-300">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-8">
                <label class="block mb-2 text-sm font-medium">
                    {{ __('register.confirm_password') }}
                </label>
                <input type="password" name="password_confirmation" class="w-full border border-orange-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-orange-300">

                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl transition">
                {{ __('register.create_account') }}
            </button>

        </form>

        <p  class="text-sm text-center text-gray-600 mt-4">
            {{ __('register.already_have_an_account') }}

            <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">
            {{ __('register.login') }}
            </a>
        </p>
    </div>

</div>

@endsection