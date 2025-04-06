@extends('layout.layout')


@section('content')
    <div class="container">
        <h2>Create New User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Please fix the following issues:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="name">
                        <strong>Name:</strong>
                    </label>
                    <input type="text" name="name" class="form-control" required autofocus value="{{ old('name') }}">
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="email">
                        <strong>Email Address:</strong>
                    </label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="password">
                        <strong>Password:</strong>
                    </label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="password_confirmation">  <!-- has to be named like this -->
                        <strong>Confirm Password:</strong>
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 text-center">
                <button type="submit" class="btn btn-primary">Register</button>
                <p class="mt-3">Already have an account? <a href="{{ route('show.login') }}">Login here</a>.</p>
            </div>

            
        </form>
    </div>
@endsection