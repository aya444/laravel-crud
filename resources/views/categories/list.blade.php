@extends('layout.layout')

@section('content')

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('welcome') }}" style="margin-bottom: 10px">Home Page</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>List Categories</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
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
            <th>Created By</th>
            <th>Action</th>
        </tr>

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

    </table>
    {{ $categories->links() }}


@endsection
