@extends('layouts.layouts')

@section('title')
    List
@endsection


<style>

</style>
@section('body')
    @if(Illuminate\Support\Facades\Auth::check())
        <div class="m-3">
            <a href="/edit" class="btn btn-primary">Create Ad</a>
        </div>
    @endif

    @if(isset($successMessage))
        <div class="alert alert-success">
            <ul>
                <li>{{$successMessage}}</li>
            </ul>
        </div>
    @endif

    @error('name')
    <div class="alert alert-danger mt-3">
        <ul>
            <li>{{$message}}</li>
        </ul>
    </div>
    @enderror

    <table class="table table table-hover mt-5">
        <thead>
        <tr>
            <th scope="col">title</th>
            <th scope="col">description</th>
            <th scope="col">author</th>
            <th scope="col">created_at</th>
            <th scope="col"></th>
        </tr>
        </thead>

        <tbody style="cursor: pointer;">
        @foreach($posts as $el)
            <a href="">
                <tr>
                    <form action="" method="POST">

                        <td><a href="/{{$el->id}}/show">{{$el->title}}</a></td>
                        <td>{{$el->description}}</td>
                        <td>{{$el->user->name}}</td>
                        <td>{{$el->created_at}}</td>
                        <td>@can('isShow', $el)<a href="/edit/{{$el->id}}" class="btn btn-primary">Edit</a>@endcan</td>
                    </form>
                </tr>
            </a>
        @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-center">

        {{ $posts->links("pagination::bootstrap-5") }}
    </div>
@endsection
