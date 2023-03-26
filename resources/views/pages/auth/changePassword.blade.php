@extends('layouts.layouts')

@section('title')
    login
@endsection


@section('body')

    <div class="position-absolute top-50 translate-middle text-center col-12 col-md-4 offset-md-4">

        <main class="form-signin w-100 m-auto">
            <form action="/change-password" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please change password</h1>
                <input type="hidden" name="id" value="{{$user->id}}" >

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
                    <div class="col-12 p-1">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Save</button>
                    </div>
                </div>

            </form>
        </main>
    </div>
@endsection
