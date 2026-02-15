<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    /**
     * Display a listing of alumni in admin panel.
     */
    public function index(Request $request)
    {
        $query = Alumni::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->where('year_passed', $request->year);
        }

        $alumni = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new alumni.
     */
    public function create()
    {
        return view('admin.alumni.create');
    }

    /**
     * Store a newly created alumni in storage.
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

        return redirect()->route('admin.alumni.index')
                         ->with('success', 'Alumni added successfully!');
    }

    /**
     * Show the form for editing the specified alumni.
     */
    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('admin.alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified alumni in storage.
     */
    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'email' => 'required|email|unique:alumni,email,' . $id,
            'year_passed' => 'required|integer|min:1990|max:2030',
            'current_job' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'job_time_duration' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'review' => 'nullable|string',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($alumni->profile_picture) {
                Storage::delete('public/alumni_photos/' . $alumni->profile_picture);
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/alumni_photos', $filename);
            $validated['profile_picture'] = $filename;
        }

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')
                         ->with('success', 'Alumni updated successfully!');
    }

    /**
     * Remove the specified alumni from storage.
     */
    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        // Delete profile picture if exists
        if ($alumni->profile_picture) {
            Storage::delete('public/alumni_photos/' . $alumni->profile_picture);
        }

        $alumni->delete();

        return redirect()->route('admin.alumni.index')
                         ->with('success', 'Alumni deleted successfully!');
    }

    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $totalAlumni = Alumni::count();
        $recentAlumni = Alumni::orderBy('created_at', 'desc')->take(5)->get();
        $alumniByYear = Alumni::selectRaw('year_passed, COUNT(*) as count')
                              ->groupBy('year_passed')
                              ->orderBy('year_passed', 'desc')
                              ->get();

        return view('admin.dashboard', compact('totalAlumni', 'recentAlumni', 'alumniByYear'));
    }
}
