@extends('layout.layout')

@section('content')
    <div class="text-center">
        <h1>Welcome to the Product CRUD App</h1>

        @guest
            <p class="mt-4">Please <a href="{{ route('show.login') }}">Login</a> or <a
                    href="{{ route('show.register') }}">Register</a> to manage your products.</p>
        @endguest


        @auth
            <p class="mt-4">Welcome back, {{ auth()->user()->name }}!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-link">Logout</button>
            </form>
        @endauth

    </div>
@endsection