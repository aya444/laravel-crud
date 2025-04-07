@extends('layout.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Add New Category</h4>
        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">← Back</a>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the following:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Category name">
            </div>

            <div class="mb-4">
                <label class="form-label">Detail</label>
                <textarea name="detail" rows="3" class="form-control" placeholder="Category detail"></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
