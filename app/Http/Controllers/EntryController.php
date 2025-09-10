<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entry;
use App\Models\Project;

class EntryController extends Controller
{
    public function create()
    {
        $projects = Auth::user()->projects()->get();
        return view('entries.create', compact('projects'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'project_id' => 'nullable|exists:projects,id',
            'type' => 'required|in:expense,income',
            'amount' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // If project_id is null, assign default General project
        if (empty($validated['project_id'])) {
            $general = Project::firstOrCreate(
                ['user_id' => Auth::id(), 'name' => 'General']
            );
            $validated['project_id'] = $general->id;
        }

        // Duplicate check
        $duplicate = Auth::user()->entries()
            ->where('description', $request->description)
            ->where('amount', $request->amount)
            ->where('date', '>', now()->subDays(14))
            ->exists();

        if ($duplicate) {
            return back()->withErrors(['description' => 'Possible duplicate entry in last 2 weeks!'])->withInput();
        }

        Auth::user()->entries()->create($validated);

        return redirect()->route('entries.index')->with('message', 'Entry added successfully!');
    }

    public function index(Request $request)
    {
        $projects = Auth::user()->projects()->get();
        $query = Auth::user()->entries();
        if ($request->project_id) {
            $query->where('project_id', $request->project_id);
        }
        if ($request->date_from) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        if ($request->category) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }
        if ($request->type) {
            $query->where('type', $request->type);
        }
        $entries = $query->orderBy('date', 'desc')->get();
        $totalIncome = $entries->where('type', 'income')->sum('amount');
        $totalExpense = $entries->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;
        return view('entries.index', compact('projects', 'entries', 'totalIncome', 'totalExpense', 'profit'));
    }
}
