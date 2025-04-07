@extends('layout.layout')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Category Details</h4>
        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">← Back</a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Name:</strong> {{ $category->name }}
        </div>
        <div class="mb-3">
            <strong>Details:</strong> {{ $category->detail }}
        </div>
        <div class="mb-3">
            <strong>Created By:</strong> {{ $category->user->name }}
        </div>
    </div>
</div>

{{-- Products Table --}}
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Products in this Category</h5>
    </div>
    <div class="card-body p-0">
        @if($category->products->count() > 0)
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Created By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td><img src="{{ asset('storage/' . $product->image) }}" width="50" class="img-thumbnail" alt="Product"></td>
                            <td>{{ $product->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-3">
                <div class="alert alert-info mb-0 text-center">No products found in this category.</div>
            </div>
        @endif
    </div>
</div>

@endsection
