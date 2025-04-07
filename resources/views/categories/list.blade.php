@extends('layout.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">← Home</a>
    <a href="{{ route('categories.create') }}" class="btn btn-success">Create New Category</a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->user->name }}</td>

                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                <a class="btn btn-info" href="{{ route('categories.show', $category->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>
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

<div class="mt-3">
    {{ $categories->links() }}
</div>

@endsection
