@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Welcome to FireLedger Pro</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded shadow">Total Income: ${{ $totalIncome }}</div>
        <div class="bg-red-100 p-4 rounded shadow">Total Expenses: ${{ $totalExpense }}</div>
        <div class="bg-blue-100 p-4 rounded shadow">Profit: ${{ $profit }}</div>
    </div>
    <h2 class="text-2xl font-semibold mb-2">Recent Entries</h2>
    <table class="w-full table-auto border">
        <thead>
            <tr><th>Date</th><th>Type</th><th>Amount</th><th>Project</th></tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
                <tr>
                    <td>{{ $entry->date }}</td>
                    <td>{{ ucfirst($entry->type) }}</td>
                    <td>${{ $entry->amount }}</td>
                    <td>{{ $entry->project->name ?? 'General' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($entries->isEmpty())
        <p class="text-gray-500 mt-4">No recent entries.</p>
    @endif
</div>
@endsection