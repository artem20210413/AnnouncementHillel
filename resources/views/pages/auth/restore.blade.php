@extends('layouts.layouts')

@section('title')
    login
@endsection


@section('body')

    <div class="position-absolute top-50 translate-middle text-center col-12 col-md-4 offset-md-4">

        <main class="form-signin w-100 m-auto">
            <form action="/restore" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Restore password</h1>
                <div class="form-floating pb-3">
                    <input type="email" class="form-control" placeholder="name@example.com" name="email">
                    <label for="floatingInput">Email address</label>
                </div>
                @error('emails')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
                @enderror
                <div class="row mt-3">
                    <div class="col-6 p-3">
                        <a class="w-100 btn btn-lg btn-warning" href=/login>Login</a>
                    </div>
                    <div class="col-6 p-3">
                        <a class="w-100 btn btn-lg btn-warning" href=/registration>Registration</a>
                    </div>
                    <div class="col-12   p-3">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Restore password</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

@endsection
