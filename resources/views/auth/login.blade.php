@extends('layouts.guest')

@section('content')

<div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg">

    <h1 class="text-3xl font-bold mb-6">
        Login
    </h1>

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="Email" class="w-full border p-3 rounded-lg mb-4">
        <input type="password" name="password" placeholder="Password" class="w-full border p-3 rounded-lg mb-4">
        <button class="bg-black text-white px-6 py-3 rounded-lg w-full">
            Login
        </button>
    </form>

</div>

@endsection