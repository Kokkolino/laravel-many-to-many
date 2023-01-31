
@extends('layouts.dashboard')
@section('content')

    <div class="container-lg row flex justify-content-between mx-auto gap-5">
        {{-- create a new post --}}
        <a href="{{route('admin.posts.create')}}">
            <i class="fa-solid fa-square-plus fs-2"></i>
            Add new post
        </a>

        @foreach ($posts as $post)
        {{-- cards --}}
        <div class="card col-5 pt-3" style="width: 18rem;">
            {{-- image --}}
            @if ($post->image)
            <img src="{{asset("storage/$post->image")}}" class="card-img-top" alt="...">
            @else

            @endif
            <div class="card-body">
                {{-- title --}}
                <h5 class="card-title">{{$post->title}}</h5>
                {{-- description --}}
                <p class="card-text">{{$post->description}}</p>
                {{-- go to post --}}
                <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary mb-1">Go to post</a>
                <div class="d-flex justify-content-between">
                    {{-- edit --}}
                    <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-info">Edit</a>
                    {{-- delete --}}
                    <form method="POST" class=" d-inline-flex" action="{{route('admin.posts.destroy', $post->id)}}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" action class="btn btn-danger">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{-- paginate --}}
        <div>
            {{$posts->links()}}
        </div>
    </div>
@endsection
