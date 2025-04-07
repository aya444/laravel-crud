@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div style="height: 30px;"></div>

    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $category->name }}
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $category->detail }}
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Created By:</strong>
                {{ $category->user->name }}
            </div>
        </div>
    </div>

    <div style="height: 30px;"></div>

    <div class="row mt-4">
        <div class="col-12">
            <h4>Products in this Category</h4>
            @if($category->products->count() > 0)
                <table class="table table-bordered">
                    <thead>
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
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}" width="50" alt="Product img">
                                </td>
                                <td>{{ $product->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No products found in this category</div>
            @endif
        </div>
    </div>
@endsection

