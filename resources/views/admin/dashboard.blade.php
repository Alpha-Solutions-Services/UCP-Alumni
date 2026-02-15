@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h1>
    <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Statistics Cards -->
<div class="grid md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 mb-1">Total Alumni</p>
                <h3 class="text-3xl font-bold text-blue-600">{{ $totalAlumni }}</h3>
            </div>
            <i class="bi bi-people-fill text-5xl text-blue-600 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 mb-1">Employed Alumni</p>
                <h3 class="text-3xl font-bold text-green-600">{{ \App\Models\Alumni::whereNotNull('current_job')->count() }}</h3>
            </div>
            <i class="bi bi-briefcase-fill text-5xl text-green-600 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 mb-1">Companies</p>
                <h3 class="text-3xl font-bold text-purple-600">{{ \App\Models\Alumni::distinct('company_name')->whereNotNull('company_name')->count() }}</h3>
            </div>
            <i class="bi bi-building text-5xl text-purple-600 opacity-20"></i>
        </div>
    </div>
</div>

<!-- Recent Alumni -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-8">
    <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
        <h3 class="text-xl font-bold text-gray-900">Recent Registrations</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Year</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Department</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Registered</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentAlumni as $alum)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $alum->full_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->email }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->year_passed }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->department }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No alumni registered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Alumni by Year -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
    <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
        <h3 class="text-xl font-bold text-gray-900">Alumni by Year</h3>
    </div>
    <div class="p-6">
        <div class="grid md:grid-cols-4 gap-4">
            @foreach($alumniByYear as $yearData)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                <p class="text-2xl font-bold text-blue-600">{{ $yearData->year_passed }}</p>
                <p class="text-gray-600">{{ $yearData->count }} Alumni</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
