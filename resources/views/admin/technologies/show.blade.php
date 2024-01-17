@extends('layouts.app')
@section('content')
    <section class="container my-4">
        <h1 class="text-danger">{{ $technology->name }}</h1>
        <div class="card w-50 bg-dark text-white border-white">
            <div class="card-body">
                <h5 class="card-title">{{ $technology->name }}</h5>
                <p class="card-text">{{ $technology->name }}</p>
                
                <p>Projecs related to this technology : </p>

               @forelse ($technology->projects as $project)
                    <p>{{ $project->title  }}</p>
               @empty
                    <p>No projects yet</p>
               @endforelse

                <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-danger">Edit</a>
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-danger">Back</a>
            </div>
        </div>
    </section>
@endsection