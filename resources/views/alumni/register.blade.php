@extends('layouts.app')

@section('title', 'Alumni Registration - UCP Portal')

@section('content')
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                    <h3 class="text-2xl font-bold text-gray-900 text-center">
                        <i class="bi bi-person-plus me-2"></i>Alumni Registration
                    </h3>
                </div>
                <div class="p-8">
                    <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <h5 class="text-lg font-semibold text-blue-600 mb-4">
                            <i class="bi bi-person-circle me-2"></i>Personal Information
                        </h5>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Full Name <span class="text-red-600">*</span></label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('full_name') border-red-500 @enderror" required>
                            @error('full_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Department <span class="text-red-600">*</span></label>
                            <select name="department" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('department') border-red-500 @enderror" required>
                                <option value="">Select Department</option>
                                <option value="Computer Science" {{ old('department') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                <option value="Software Engineering" {{ old('department') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                                <option value="Information Technology" {{ old('department') == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                <option value="Business Administration" {{ old('department') == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
                                <option value="Electrical Engineering" {{ old('department') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                <option value="Civil Engineering" {{ old('department') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                            </select>
                            @error('department')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Contact Number <span class="text-red-600">*</span></label>
                                <input type="tel" name="contact_number" value="{{ old('contact_number') }}" placeholder="+92 300 1234567" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('contact_number') border-red-500 @enderror" required>
                                @error('contact_number')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">WhatsApp Number</label>
                                <input type="tel" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="+92 300 1234567" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Email Address <span class="text-red-600">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('email') border-red-500 @enderror" required>
                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Year Passed <span class="text-red-600">*</span></label>
                            <select name="year_passed" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('year_passed') border-red-500 @enderror" required>
                                <option value="">Select Year</option>
                                @for($year = date('Y'); $year >= 1990; $year--)
                                    <option value="{{ $year }}" {{ old('year_passed') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('year_passed')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <h5 class="text-lg font-semibold text-blue-600 mb-4 mt-8">
                            <i class="bi bi-briefcase me-2"></i>Professional Information
                        </h5>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Current Job Position</label>
                            <input type="text" name="current_job" value="{{ old('current_job') }}" placeholder="e.g., Software Engineer" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Company Name</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="e.g., Google, Microsoft" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Time Taken to Get Job</label>
                            <select name="job_time_duration" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                <option value="">Select Duration</option>
                                <option value="Before Graduation" {{ old('job_time_duration') == 'Before Graduation' ? 'selected' : '' }}>Before Graduation</option>
                                <option value="Within 1 month" {{ old('job_time_duration') == 'Within 1 month' ? 'selected' : '' }}>Within 1 month</option>
                                <option value="1-3 months" {{ old('job_time_duration') == '1-3 months' ? 'selected' : '' }}>1-3 months</option>
                                <option value="3-6 months" {{ old('job_time_duration') == '3-6 months' ? 'selected' : '' }}>3-6 months</option>
                                <option value="6-12 months" {{ old('job_time_duration') == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                <option value="More than 1 year" {{ old('job_time_duration') == 'More than 1 year' ? 'selected' : '' }}>More than 1 year</option>
                            </select>
                        </div>

                        <h5 class="text-lg font-semibold text-blue-600 mb-4 mt-8">
                            <i class="bi bi-image me-2"></i>Profile Picture
                        </h5>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Upload Profile Picture</label>
                            <input type="file" name="profile_picture" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('profile_picture') border-red-500 @enderror">
                            <small class="text-gray-500">Accepted formats: JPG, PNG (Max 5MB)</small>
                            @error('profile_picture')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <h5 class="text-lg font-semibold text-blue-600 mb-4 mt-8">
                            <i class="bi bi-chat-quote me-2"></i>Message for Juniors
                        </h5>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Share Your Experience / Advice</label>
                            <textarea name="review" rows="5" placeholder="Share your journey, advice, or words of encouragement..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('review') }}</textarea>
                        </div>

                        <div class="space-y-3">
                            <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 hover:shadow-lg transition">
                                <i class="bi bi-check-circle me-2"></i>Submit Registration
                            </button>
                            <a href="{{ route('home') }}" class="block w-full px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold text-center hover:bg-gray-50 transition">
                                <i class="bi bi-arrow-left me-2"></i>Back to Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
