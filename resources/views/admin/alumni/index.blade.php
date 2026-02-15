@extends('layouts.admin')

@section('title', 'Manage Alumni')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Alumni Management</h1>
        <p class="text-gray-600">View and manage all registered alumni</p>
    </div>
    <a href="{{ route('admin.alumni.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg">
        <i class="bi bi-plus-circle me-2"></i>Add New Alumni
    </a>
</div>

<!-- Search and Filter -->
<div class="bg-white border border-gray-200 rounded-xl p-6 mb-6 shadow-sm">
    <form action="{{ route('admin.alumni.index') }}" method="GET" class="flex flex-wrap gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or department..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
        
        <select name="year" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            <option value="">All Years</option>
            @for($year = date('Y'); $year >= 1990; $year--)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>
        
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
            <i class="bi bi-search me-2"></i>Search
        </button>
    </form>
</div>

<!-- Alumni Table -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Year</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Department</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Company</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($alumni as $alum)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-600">{{ $alum->id }}</td>
                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $alum->full_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->email }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->year_passed }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->department }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $alum->company_name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('alumni.show', $alum->id) }}" target="_blank" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.alumni.edit', $alum->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.alumni.destroy', $alum->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this alumni?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">No alumni found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($alumni->hasPages())
<div class="mt-6">
    {{ $alumni->links() }}
</div>
@endif
@endsection
