<h5 class="text-lg font-semibold text-blue-600 mb-4">
    <i class="bi bi-person-circle me-2"></i>Personal Information
</h5>

<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2">Full Name <span class="text-red-600">*</span></label>
    <input type="text" name="full_name" value="{{ old('full_name', $alumni->full_name ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('full_name') border-red-500 @enderror" required>
    @error('full_name')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2">Department <span class="text-red-600">*</span></label>
    <select name="department" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('department') border-red-500 @enderror" required>
        <option value="">Select Department</option>
        <option value="Computer Science" {{ old('department', $alumni->department ?? '') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
        <option value="Software Engineering" {{ old('department', $alumni->department ?? '') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
        <option value="Information Technology" {{ old('department', $alumni->department ?? '') == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
        <option value="Business Administration" {{ old('department', $alumni->department ?? '') == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
        <option value="Electrical Engineering" {{ old('department', $alumni->department ?? '') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
        <option value="Civil Engineering" {{ old('department', $alumni->department ?? '') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
    </select>
    @error('department')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="grid md:grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-gray-700 font-medium mb-2">Contact Number <span class="text-red-600">*</span></label>
        <input type="tel" name="contact_number" value="{{ old('contact_number', $alumni->contact_number ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('contact_number') border-red-500 @enderror" required>
        @error('contact_number')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">WhatsApp Number</label>
        <input type="tel" name="whatsapp_number" value="{{ old('whatsapp_number', $alumni->whatsapp_number ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
    </div>
</div>

<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2">Email Address <span class="text-red-600">*</span></label>
    <input type="email" name="email" value="{{ old('email', $alumni->email ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('email') border-red-500 @enderror" required>
    @error('email')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-6">
    <label class="block text-gray-700 font-medium mb-2">Year Passed <span class="text-red-600">*</span></label>
    <select name="year_passed" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('year_passed') border-red-500 @enderror" required>
        <option value="">Select Year</option>
        @for($year = date('Y'); $year >= 1990; $year--)
            <option value="{{ $year }}" {{ old('year_passed', $alumni->year_passed ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
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
    <input type="text" name="current_job" value="{{ old('current_job', $alumni->current_job ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
</div>

<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2">Company Name</label>
    <input type="text" name="company_name" value="{{ old('company_name', $alumni->company_name ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
</div>

<div class="mb-6">
    <label class="block text-gray-700 font-medium mb-2">Time Taken to Get Job</label>
    <select name="job_time_duration" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
        <option value="">Select Duration</option>
        <option value="Before Graduation" {{ old('job_time_duration', $alumni->job_time_duration ?? '') == 'Before Graduation' ? 'selected' : '' }}>Before Graduation</option>
        <option value="Within 1 month" {{ old('job_time_duration', $alumni->job_time_duration ?? '') == 'Within 1 month' ? 'selected' : '' }}>Within 1 month</option>
        <option value="1-3 months" {{ old('job_time_duration', $alumni->job_time_duration ?? '') == '1-3 months' ? 'selected' : '' }}>1-3 months</option>
        <option value="3-6 months" {{ old('job_time_duration', $alumni->job_time_duration ?? '') == '3-6 months' ? 'selected' : '' }}>3-6 months</option>
        <option value="6-12 months" {{ old('job_time_duration', $alumni->job_time_duration ?? '') == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
        <option value="More than 1 year" {{ old('job_time_duration', $alumni->job_time_duration ?? '') == 'More than 1 year' ? 'selected' : '' }}>More than 1 year</option>
    </select>
</div>

<h5 class="text-lg font-semibold text-blue-600 mb-4 mt-8">
    <i class="bi bi-image me-2"></i>Profile Picture
</h5>

@if(isset($alumni) && $alumni->profile_picture)
<div class="mb-4">
    <img src="{{ asset('storage/alumni_photos/' . $alumni->profile_picture) }}" alt="Current Profile Picture" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
    <p class="text-sm text-gray-600 mt-2">Current profile picture</p>
</div>
@endif

<div class="mb-6">
    <label class="block text-gray-700 font-medium mb-2">{{ isset($alumni) && $alumni->profile_picture ? 'Change' : 'Upload' }} Profile Picture</label>
    <input type="file" name="profile_picture" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('profile_picture') border-red-500 @enderror">
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
    <textarea name="review" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('review', $alumni->review ?? '') }}</textarea>
</div>
