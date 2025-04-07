@extends('layout.layout')

@section('content')
<div class="text-center mt-5">
    <h1 class="mb-4">Welcome to the Product CRUD App</h1>

    @guest
        <p class="lead">Please <a href="{{ route('show.login') }}">Login</a> or <a href="{{ route('show.register') }}">Register</a> to continue.</p>
    @endguest

    @auth
        <p class="lead">Welcome back, <strong>{{ auth()->user()->name }}</strong>!</p>
        <div class="d-flex justify-content-center gap-2 mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Manage Categories</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-danger">Logout</button>
            </form>
        </div>
    @endauth
</div>
@endsection
