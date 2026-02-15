@extends('layouts.admin')

@section('title', 'Edit Alumni')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Alumni</h1>
    <p class="text-gray-600">Update alumni profile information</p>
</div>

<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
    <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.alumni.form')
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                <i class="bi bi-check-circle me-2"></i>Update Alumni
            </button>
            <a href="{{ route('admin.alumni.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                <i class="bi bi-x-circle me-2"></i>Cancel
            </a>
        </div>
    </form>
</div>
@endsection
