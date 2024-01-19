@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Edit {{$project->title}}</h1>
        <form action="{{ route('admin.projects.update', $project) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
     <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                required minlength="3" maxlength="200" value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

    <div class="mb-3">
        <label for="body">Body</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="10">
        {{ old('body', $project->body) }}
        </textarea>
        @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
                <label for="img">Image</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" id="img" value="{{old('img', $project->img)}}">
                @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
    </div>

    <div class="mb-3">
        <label for="category">Select a category</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 text-white">
    @foreach ($technologies as $item)
                <div class="d-inline-block m-3 @error('technologies') is-invalid @enderror">
                    @if ($errors->any())
                        <input type="checkbox" name="technologies[]" value="{{ $item->id }}"
                            @if (isset($technologies) && in_array($item->id, old('technologies', $project->technologies))) checked @endif>
                    @else
                        <input type="checkbox" name="technologies[]" value="{{ $item->id }}"
                            @if (isset($technologies) && $project->technologies->contains($item->id)) checked @endif>
                    @endif

                    <label for="technologies">{{ $item->name }} <i class="{{ $item->icon }}"></i></label>
                </div>
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