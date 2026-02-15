<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Display a listing of alumni (public page).
     */
    public function index(Request $request)
    {
        $query = Alumni::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->where('year_passed', $request->year);
        }

        $alumni = $query->orderBy('year_passed', 'desc')
                        ->paginate(15);

        return view('alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new alumni (public registration).
     */
    public function create()
    {
        return view('alumni.register');
    }

    /**
     * Store a newly created alumni in storage (public registration).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'email' => 'required|email|unique:alumni,email',
            'year_passed' => 'required|integer|min:1990|max:2030',
            'current_job' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'job_time_duration' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'review' => 'nullable|string',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/alumni_photos', $filename);
            $validated['profile_picture'] = $filename;
        }

        Alumni::create($validated);

        return redirect()->route('alumni.index')
                         ->with('success', 'Registration successful! Your profile will be visible in the alumni directory.');
    }

    /**
     * Display the specified alumni profile.
     */
    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.show', compact('alumni'));
    }
}
