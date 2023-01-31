
@extends('layouts.dashboard')
@section('content')

    <div class="container-lg">
        <a href="{{route('admin.posts.create')}}">
            <i class="fa-solid fa-square-plus fs-2"></i>
            Add post
        </a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Category</th>
                <th scope="col">Tags</th>
                <th scope="col">Settings</th>
            </tr>
            </thead>
            <tbody>
                {{-- foreach --}}
            @foreach($posts as $post)

            <tr>
                {{-- id --}}
                <th class="col-1" scope="row">{{$post->id}}</th>
                {{-- title-> route to show --}}
                <td class="col-3">
                    <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
                </td>
                {{-- description --}}
                <td class="col-3">{{$post->description}}</td>
                {{-- category --}}
                @if (is_null($post->category))
                <td class="col-2">N/D</td>
                @else
                <td class="col-2">{{$post->category['category']}}</td>
                @endif
                {{-- tags --}}
                <td class="col-2">
                    {{-- if null --}}
                    @if (is_null($post->tags))
                        N/D
                    @else
                    {{-- else -> loop --}}
                        @foreach ($post->tags as $tag)
                        <span class="badge bg-light text-dark mb-1">{{ $tag['name'] }}</span>
                        @endforeach
                    @endif


                </td>
                {{-- settings --}}
                <td class="flex justify-content-between gap-3 col-1">
                    {{-- edit --}}
                    <a class="col-4 fs-5" href="{{route('admin.posts.edit', $post->id)}}" alt="edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    {{-- delete --}}
                    <form method="POST" class="col-4 d-inline-flex" action="{{route('admin.posts.destroy', $post->id)}}">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-link text-danger m-0 p-0 col-4">
                            <i class="fa-sharp fa-solid fa-square-minus fs-5"></i>
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
            {{-- endforeach; --}}
            </tbody>
        </table>
        <div>
            {{$posts->links()}}
        </div>
    </div>
@endsection
