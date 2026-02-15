@extends('layouts.app')

@section('title', 'Alumni Directory - UCP Portal')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-br from-white to-gray-100 py-8 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">
            <i class="bi bi-people-fill me-2"></i>Alumni Directory
        </h2>
        
        <!-- Search and Filter -->
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('alumni.index') }}" method="GET" class="flex flex-wrap gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, department, or company..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                
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
    </div>
</section>

<!-- Alumni Grid -->
<section class="py-12">
    <div class="container mx-auto px-4">
        @if($alumni->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($alumni as $alum)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition">
                    @if($alum->profile_picture)
                        <img src="{{ asset('storage/alumni_photos/' . $alum->profile_picture) }}" class="w-full h-48 object-cover" alt="{{ $alum->full_name }}">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white text-6xl font-bold">{{ substr($alum->full_name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-gray-900 mb-3">{{ $alum->full_name }}</h5>
                        <p class="text-gray-600 mb-2"><i class="bi bi-calendar3 me-2 text-blue-600"></i><strong>Year:</strong> {{ $alum->year_passed }}</p>
                        <p class="text-gray-600 mb-2"><i class="bi bi-mortarboard me-2 text-purple-600"></i><strong>Dept:</strong> {{ $alum->department }}</p>
                        @if($alum->current_job)
                            <p class="text-gray-600 mb-2"><i class="bi bi-briefcase me-2 text-green-600"></i><strong>Job:</strong> {{ $alum->current_job }}</p>
                        @endif
                        @if($alum->company_name)
                            <p class="text-gray-600 mb-4"><i class="bi bi-building me-2 text-orange-600"></i><strong>Company:</strong> {{ $alum->company_name }}</p>
                        @endif
                        <a href="{{ route('alumni.show', $alum->id) }}" class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg font-semibold hover:bg-blue-700 transition">
                            <i class="bi bi-eye me-2"></i>View Profile
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $alumni->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="bi bi-inbox text-6xl text-gray-400 mb-4"></i>
                <p class="text-xl text-gray-600">No alumni found.</p>
            </div>
        @endif
    </div>
</section>
@endsection
