@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Manage Projects</h1>
    @if(session('message'))
        <p class="text-green-500 mb-4">{{ session('message') }}</p>
    @endif
    <form action="{{ route('projects.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="name" placeholder="Project Name" class="border p-2 rounded @error('name') border-red-500 @enderror" value="{{ old('name') }}">
            @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            <input name="start_date" type="date" class="border p-2 rounded @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}">
            @error('start_date') <p class="text-red-500">{{ $message }}</p> @enderror
            <input name="end_date" type="date" class="border p-2 rounded @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}">
            @error('end_date') <p class="text-red-500">{{ $message }}</p> @enderror
            <textarea name="description" placeholder="Description" class="border p-2 rounded col-span-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Create Project</button>
    </form>
    <table class="w-full table-auto border">
        <thead>
            <tr><th>Name</th><th>Start</th><th>End</th><th>Description</th></tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->start_date ?? 'N/A' }}</td>
                    <td>{{ $project->end_date ?? 'N/A' }}</td>
                    <td>{{ $project->description ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($projects->isEmpty())
        <p class="text-gray-500 mt-4">No projects found. Add one above!</p>
    @endif
</div>
@endsection