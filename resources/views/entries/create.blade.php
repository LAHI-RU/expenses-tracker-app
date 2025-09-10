@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Entry</h1>
    @if(session('message'))
        <p class="text-green-500 mb-4">{{ session('message') }}</p>
    @endif
    <form action="{{ route('entries.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="date" type="date" class="border p-2 rounded @error('date') border-red-500 @enderror" value="{{ old('date', now()->format('Y-m-d')) }}">
            @error('date') <p class="text-red-500">{{ $message }}</p> @enderror
            <select name="project_id" class="border p-2 rounded @error('project_id') border-red-500 @enderror">
                @php
                    $general = $projects->firstWhere('name', 'General');
                @endphp
                <option value="{{ $general ? $general->id : '' }}" {{ old('project_id') == ($general->id ?? '') ? 'selected' : '' }}>
                    General
                </option>
                @foreach($projects as $project)
                    @if(!$general || $project->id !== $general->id)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endif
                @endforeach
            </select>

            @error('project_id') <p class="text-red-500">{{ $message }}</p> @enderror
            <select name="type" class="border p-2 rounded @error('type') border-red-500 @enderror">
                <option value="expense" {{ old('type', 'expense') == 'expense' ? 'selected' : '' }}>Expense</option>
                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
            </select>
            @error('type') <p class="text-red-500">{{ $message }}</p> @enderror
            <input name="amount" type="number" step="0.01" placeholder="Amount" class="border p-2 rounded @error('amount') border-red-500 @enderror" value="{{ old('amount') }}">
            @error('amount') <p class="text-red-500">{{ $message }}</p> @enderror
            <input name="category" placeholder="Category (e.g., labor)" class="border p-2 rounded @error('category') border-red-500 @enderror" value="{{ old('category') }}">
            @error('category') <p class="text-red-500">{{ $message }}</p> @enderror
            <input name="description" id="description" placeholder="Description" class="border p-2 rounded col-span-2 @error('description') border-red-500 @enderror" value="{{ old('description') }}">
            @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
            <textarea name="notes" placeholder="Notes" class="border p-2 rounded col-span-2 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
            @error('notes') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        <button type="button" id="voice-btn" class="bg-gray-500 text-white px-4 py-2 mt-4 rounded">🎤 Voice Input</button>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-4 rounded">Save</button>
    </form>
    <script>
        if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US';
            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript.toLowerCase();
                const descriptionInput = document.getElementById('description');
                descriptionInput.value = transcript;
                // Simple parsing for fields
                if (transcript.includes('expense')) document.querySelector('select[name="type"]').value = 'expense';
                if (transcript.includes('income')) document.querySelector('select[name="type"]').value = 'income';
                const amountMatch = transcript.match(/\d+(\.\d{1,2})?/);
                if (amountMatch) document.querySelector('input[name="amount"]').value = amountMatch[0];
                if (transcript.includes('labor')) document.querySelector('input[name="category"]').value = 'labor';
                // Add project name matching if time allows (e.g., loop through options)
            };
            document.getElementById('voice-btn').addEventListener('click', () => recognition.start());
        } else {
            alert('Voice recognition not supported in this browser. Please use Chrome.');
        }
    </script>
</div>
@endsection