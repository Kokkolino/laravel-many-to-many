@extends('layouts.dashboard')
@section('content')
<div class="container-lg">

    <form method="POST" action="{{route('admin.posts.store')}}" enctype="multipart/form-data">
        @csrf

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
            <input name="title" type="text" class="form-control">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input name="description" type="text" class="form-control">
        </div>

        {{-- categories --}}
        <select name="category_id" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
            <option value="" selected>Uncategorized</option>

            {{-- categories loop --}}
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
        </select>

        {{-- tags --}}
        <div class="form-check mb-4">

            {{-- tags loop --}}
            @foreach ( $tags as $tag)
            <div>
                <input name="tags[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->name}}">
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
