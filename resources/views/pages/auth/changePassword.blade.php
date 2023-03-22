@extends('layouts.layouts')

@section('title')
    login
@endsection


@section('body')

    <div class="position-absolute top-50 translate-middle text-center col-12 col-md-4 offset-md-4">

        <main class="form-signin w-100 m-auto">
            <form action="/registration" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please register</h1>
                <div class="form-floating pb-3">
                    <input type="text" class="form-control" placeholder="Your name" name="name">
                    <label for="floatingInput">Your name</label>
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
                @enderror
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
                <div class="form-floating pb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                @error('password')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
                @enderror


                <div class="row mt-3">
                    <div class="col-6 p-1">
                        <a class="w-100 btn btn-lg btn-primary" href=/login>login</a>
                    </div>
                    <div class="col-6 p-1">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    </div>
                </div>

            </form>
        </main>
    </div>
@endsection
