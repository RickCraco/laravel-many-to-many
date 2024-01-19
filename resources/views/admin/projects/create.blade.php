@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Project Create</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
     <div class="mb-3 text-white">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                required minlength="3" maxlength="200" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

    <div class="mb-3 text-white">
        <label for="body">Body</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="10">
        {{ old('body') }}
        </textarea>
        @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 text-white">
                <label for="img">Image</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" id="img" value="{{old('img')}}">
                @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
    </div>
    <div class="mb-3 text-white">
        <label for="category">Select a category</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 text-white">
            @foreach ($technologies as $technology)
                <input type="checkbox" class="mx-2 @error('technologies') is-invalid @enderror" name="technologies[]" id="technologies" value="{{ $technology->id }}" {{in_array($technology->id, old('technologies', [])), old('technologies', []) ? 'checked' : ''}}>
                <label for="technologies">{{ $technology->name }} <i class="{{ $technology->icon }}"></i></label>
            @endforeach
            @error('technologies')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <button type="reset" class="btn btn-primary">Reset</button>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </section>
@endsection