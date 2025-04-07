@extends('layout.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Product Details</h4>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">← Back</a>
    </div>

    <div class="card-body">
        <div class="mb-3">
            <strong>Name:</strong> {{ $product->name }}
        </div>

        <div class="mb-3">
            <strong>Details:</strong> {{ $product->detail }}
        </div>

        <div class="mb-3">
            <strong>Price:</strong> ${{ $product->price }}
        </div>

        <div class="mb-3">
            <strong>Available Quantity:</strong> {{ $product->quantity }}
        </div>

        <div class="mb-3">
            <strong>Categories:</strong>
            @if($product->categories->count())
                <ul class="mb-0">
                    @foreach($product->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            @else
                <span class="text-muted">No categories assigned</span>
            @endif
        </div>

        <div class="mb-3">
            <strong>Created By:</strong> {{ $product->user->name }}
        </div>

        <div class="mb-3">
            <strong>Product Image:</strong><br>
            <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" width="200">
        </div>
    </div>
</div>
@endsection
