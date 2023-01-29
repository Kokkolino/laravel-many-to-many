@extends('layouts.dashboard')
@section('content')
<div class="container-lg">
    <form method="POST" action="{{route('admin.posts.store')}}">
        @csrf
        {{-- title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control">
        </div>
        {{-- body --}}
        <div class="mb-3">
            <label class="form-label">Body</label>
            <input name="body" type="text" class="form-control">
        </div>
        {{-- categories --}}
        <select name="category_id" class="form-select form-select-sm mb-4" aria-label=".form-select-sm example">
            <option value="" selected>Uncategorized</option>
            {{-- categories loop --}}
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
        </select>
        {{-- submit button --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
