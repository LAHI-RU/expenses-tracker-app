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
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-xl shadow-lg">
        <thead class="bg-gradient-to-r from-purple-100 to-purple-200">
            <tr>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Name</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Start Date</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">End Date</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
                <tr class="even:bg-gray-50 odd:bg-white hover:bg-purple-50 transition">
                    <td class="px-6 py-3 border-b">{{ $project->name }}</td>
                    <td class="px-6 py-3 border-b">{{ $project->start_date ?? 'N/A' }}</td>
                    <td class="px-6 py-3 border-b">{{ $project->end_date ?? 'N/A' }}</td>
                    <td class="px-6 py-3 border-b">{{ $project->description ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-3 text-center text-gray-500">No projects found. Add one above!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection