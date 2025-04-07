@extends('layout.layout')

@section('content')

    {{-- Home & Create Buttons --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a class="btn btn-primary" href="{{ route('welcome') }}">Home Page</a>

        <a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by product, category, or user"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    {{-- Success Message --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    {{-- Product Table --}}
    @if ($products->count() > 0)
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ asset('storage/' . $product->image) }}" width="50" alt="Product img"
                                        class="rounded"></td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->user->name }}</td>
                                <td>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    @else
        <div class="alert alert-warning text-center">No products found.</div>
    @endif
@endsection