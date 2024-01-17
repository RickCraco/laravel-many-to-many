@extends('layouts.app')
@section('content')
    <section class="container my-4">
        <h1 class="text-danger">{{ $category->name }}</h1>
        <div class="card w-50 bg-dark text-white border-white">
            <div class="card-body">
                <h5 class="card-title">{{ $category->name }}</h5>
                <p class="card-text">{{ $category->name }}</p>

                <p>Projects related to this category:</p>
               @forelse ($category->projects as $project)
                    <p>{{ $project->title }}</p>
               @empty
                    <p>No projects yet</p>
               @endforelse

                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-danger">Edit</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Back</a>
            </div>
        </div>
    </section>
@endsection