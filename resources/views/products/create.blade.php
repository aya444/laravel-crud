@extends('layout.layout')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add New Product</h4>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">← Back</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Please fix the following errors:
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Product Name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail:</label>
                    <textarea name="detail" class="form-control" rows="3" placeholder="Product Details"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price:</label>
                    <input type="number" name="price" class="form-control" placeholder="Price">
                </div>

                <div class="mb-3">
                    <label class="form-label">Available Quantity:</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Categories (Optional):</label>
                    @foreach($categories as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                id="category_{{ $category->id }}">
                            <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>


                <div class="mb-4">
                    <label class="form-label">Product Image:</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Create Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection