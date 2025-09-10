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
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-xl shadow-lg">
        <thead class="bg-gradient-to-r from-blue-100 to-blue-200">
            <tr>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Date</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Type</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Amount</th>
                <th class="px-6 py-3 border-b text-left text-xs font-semibold text-gray-700 uppercase">Project</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entries as $entry)
                <tr class="even:bg-gray-50 odd:bg-white hover:bg-blue-50 transition">
                    <td class="px-6 py-3 border-b">{{ $entry->date }}</td>
                    <td class="px-6 py-3 border-b">{{ ucfirst($entry->type) }}</td>
                    <td class="px-6 py-3 border-b font-semibold text-green-700">${{ number_format($entry->amount, 2) }}</td>
                    <td class="px-6 py-3 border-b">{{ $entry->project->name ?? 'General' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-3 text-center text-gray-500">No recent entries.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection