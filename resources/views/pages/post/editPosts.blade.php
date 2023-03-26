@extends('layouts.layouts')

@section('title')
    Show
@endsection


@section('body')
    <div class="text-center mt-3">
        <form action="/save" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="id" value="{{isset($post)?$post->id:0}}">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{isset($post)?$post->title:""}}">
                @error('title')
                <div class="alert alert-danger mt-3">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
                @enderror
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="description"
                          style="height: 100px">{{isset($post)?$post->description:""}}</textarea>
                <label for="floatingTextarea2">Description</label>
                @error('description')
                <div class="alert alert-danger mt-3">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">@if(isset($post))Save @else Create @endif</button>
        </form>
        <div class="col">

        </div>
    </div>
@endsection
