@extends('layout.layout')

@section('content')

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('welcome') }}" style="margin-bottom: 10px">Home Page</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>List Products</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Available Quantity</th>
            <th>Created By</th>
            <th>Action</th>
        </tr>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td><img src="{{ asset('storage/' . $product->image) }}" width="50" alt="Product img"></td>
                <td>{{ $product->price }}</td>
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

    </table>
    {{ $products->links() }}


@endsection