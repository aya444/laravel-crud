<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product CRUD Application</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">
    {{-- Header --}}
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="{{ route('products.index') }}">Product CRUD</a>

            @if (Route::currentRouteName() === 'products.index' && auth()->check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @endif
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>

</html>