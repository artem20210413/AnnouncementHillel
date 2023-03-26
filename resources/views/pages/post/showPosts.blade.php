@extends('layouts.layouts')

@section('title')
    Show
@endsection


@section('body')
    <div class="text-center">
        <div class="row mt-3">
            <div class="text-left col-6">
                <p>Author: {{$user->name}}</p>
            </div>
            <div class="text-right col-6">
                <p>{{$post->created_at}}</p>
            </div>
        </div>
        <h1>{{$post->title}}</h1>
        <p>{{$post->description}}</p>

        @can('isShow', $post)
            <div class="row m-5">
                <div class="col-6">
                    <a href="/edit/{{$post->id}}" class="btn btn-primary">Edit</a>
                </div>
                <div class="col-6">
                    <form action="/delete/{{$post->id}}" method="Post">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                </div>
            </div>
        @endcan

    </div>
@endsection
