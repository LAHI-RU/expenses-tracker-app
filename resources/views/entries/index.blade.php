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
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-xl shadow-lg">
        <thead class="bg-gradient-to-r from-green-100 to-green-200">
            <tr>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Date</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Type</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Amount</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Category</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Description</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Project</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entries as $entry)
                <tr class="even:bg-gray-50 odd:bg-white hover:bg-green-50 transition">
                    <td class="px-6 py-3 border-b">{{ $entry->date }}</td>
                    <td class="px-6 py-3 border-b">{{ ucfirst($entry->type) }}</td>
                    <td class="px-6 py-3 border-b font-semibold text-green-700">${{ number_format($entry->amount, 2) }}</td>
                    <td class="px-6 py-3 border-b">{{ $entry->category ?? 'N/A' }}</td>
                    <td class="px-6 py-3 border-b">{{ $entry->description }}</td>
                    <td class="px-6 py-3 border-b">{{ $entry->project->name ?? 'General' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-3 text-center text-gray-500">No entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection