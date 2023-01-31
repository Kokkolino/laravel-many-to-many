@extends('layouts.dashboard')
@section('content')
<div class="container-lg">
    <form method="POST" action="{{route('admin.posts.update', $post['id'])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @error('title')
        <div class="alert alert-danger">
            titolo va in errore
        </div>
        @enderror

        @error('description')
        <div class="alert alert-danger">
            descrizione va in errore
        </div>
        @enderror


        {{-- title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post['title']}}">
        </div>
        {{-- description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input name="description" type="text" class="form-control" value="{{$post['description']}}">
        </div>
        {{-- categories --}}
            <select name="category_id" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
                <option value="" selected>Uncategorized</option>
                {{-- categories loop --}}
                @foreach ($categories as $category)
                <option value="{{$category->id}}" {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>{{$category->category}}</option>
                @endforeach
            </select>
                    {{-- tags --}}
        <div class="form-check mb-4">
            {{-- tags loop --}}
            @foreach ( $tags as $tag)
            <div>
                <input name="tags[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->name}}" {{$post->tags->contains($tag) ? 'checked' : ''}}>
                <label class="form-check-label" for="{{$tag->name}}">
                    {{$tag->name}}
                </label>
            </div>
            @endforeach
          </div>

        {{-- image --}}
        <div class="mb-3">
            <label class="form-label">Upload image</label>
            <input name="upload" type="file" class="form-control-file">
        </div>

        {{-- submit button --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
