@extends('layouts.dashboard')
@section('content')
<div class="container-lg">
    <form method="POST" action="{{route('admin.posts.update', $post['id'])}}">
        @csrf
        @method('PUT')
        {{-- title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post['title']}}">
        </div>
        {{-- body --}}
        <div class="mb-3">
            <label class="form-label">Body</label>
            <input name="body" type="text" class="form-control" value="{{$post['body']}}">
        </div>
        {{-- categories --}}
            <select name="category_id" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
                <option value="" selected>Uncategorized</option>
                {{-- categories loop --}}
                @foreach ($categories as $category)
                <option value="{{$category->id}}" {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>{{$category->category}}</option>
                @endforeach
            </select>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
