<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entry;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $projects = $user->projects()->get();
        $entries = $user->entries()->latest()->take(5)->get();
        $totalIncome = $user->entries()->where('type', 'income')->sum('amount');
        $totalExpense = $user->entries()->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;
        return view('dashboard', compact('projects', 'entries', 'totalIncome', 'totalExpense', 'profit'));
    }
}
