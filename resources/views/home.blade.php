@extends('layouts.app')

@section('title', 'Home - UCP Alumni Portal')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-white to-gray-100 py-16 border-b border-gray-200">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-6 animate-fade-in">
            <img src="{{ asset('images/ucp-logo.png') }}" alt="UCP Logo" class="mx-auto" style="max-height: 150px;">
        </div>
        <h1 class="text-5xl font-bold text-gray-900 mb-4">Department Alumni Portal</h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Connecting graduates, fostering growth, and building a stronger community</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('alumni.create') }}" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition">
                <i class="bi bi-person-plus me-2"></i>Register as Alumni
            </a>
            <a href="{{ route('alumni.index') }}" class="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-600 hover:text-white hover:shadow-lg transform hover:-translate-y-0.5 transition">
                <i class="bi bi-people me-2"></i>View Alumni Directory
            </a>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center hover:shadow-lg hover:-translate-y-1 transition">
                <i class="bi bi-people-fill text-6xl text-blue-600 mb-4"></i>
                <h2 class="text-5xl font-bold text-blue-600 mb-2">{{ \App\Models\Alumni::count() }}+</h2>
                <p class="text-gray-600">Registered Alumni</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center hover:shadow-lg hover:-translate-y-1 transition">
                <i class="bi bi-briefcase-fill text-6xl text-green-600 mb-4"></i>
                <h2 class="text-5xl font-bold text-green-600 mb-2">{{ \App\Models\Alumni::whereNotNull('current_job')->count() }}</h2>
                <p class="text-gray-600">Employed Alumni</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center hover:shadow-lg hover:-translate-y-1 transition">
                <i class="bi bi-building text-6xl text-purple-600 mb-4"></i>
                <h2 class="text-5xl font-bold text-purple-600 mb-2">{{ \App\Models\Alumni::distinct('company_name')->whereNotNull('company_name')->count() }}+</h2>
                <p class="text-gray-600">Partner Companies</p>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-xl p-10 shadow-sm">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">Welcome to Our Alumni Community</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    The Department Alumni Portal is your gateway to staying connected with fellow graduates, 
                    sharing your professional journey, and inspiring the next generation of students. Whether 
                    you graduated last year or decades ago, this platform is designed to help you maintain 
                    meaningful connections with your alma mater and peers.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Join our growing community of successful professionals who are making a difference in 
                    their fields. Share your experiences, mentor current students, and discover new 
                    opportunities through our network.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
