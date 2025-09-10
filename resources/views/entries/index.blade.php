@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Track Entries</h1>
    <form action="{{ route('entries.index') }}" method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <select name="project_id" class="border p-2 rounded">
            <option value="">All Projects</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
            @endforeach
        </select>
        <input name="date_from" type="date" placeholder="From Date" class="border p-2 rounded" value="{{ request('date_from') }}">
        <input name="date_to" type="date" placeholder="To Date" class="border p-2 rounded" value="{{ request('date_to') }}">
        <input name="category" placeholder="Category" class="border p-2 rounded" value="{{ request('category') }}">
        <select name="type" class="border p-2 rounded">
            <option value="">All Types</option>
            <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Expense</option>
            <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Income</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded shadow">Total Income: ${{ $totalIncome }}</div>
        <div class="bg-red-100 p-4 rounded shadow">Total Expenses: ${{ $totalExpense }}</div>
        <div class="bg-blue-100 p-4 rounded shadow">Profit: ${{ $profit }}</div>
    </div>
    <table class="w-full table-auto border">
        <thead>
            <tr><th>Date</th><th>Type</th><th>Amount</th><th>Category</th><th>Description</th><th>Project</th></tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry->date }}</td>
                    <td>{{ ucfirst($entry->type) }}</td>
                    <td>${{ $entry->amount }}</td>
                    <td>{{ $entry->category ?? 'N/A' }}</td>
                    <td>{{ $entry->description }}</td>
                    <td>{{ $entry->project->name ?? 'General' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($entries->isEmpty())
        <p class="text-gray-500 mt-4">No entries found.</p>
    @endif
</div>
@endsection