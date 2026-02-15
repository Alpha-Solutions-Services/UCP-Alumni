@extends('layouts.app')

@section('title', $alumni->full_name . ' - Alumni Profile')

@section('content')
<!-- Profile Header -->
<section class="bg-gradient-to-r from-gray-800 to-gray-700 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        @if($alumni->profile_picture)
            <img src="{{ asset('storage/alumni_photos/' . $alumni->profile_picture) }}" class="w-44 h-44 rounded-full mx-auto mb-4 border-4 border-white shadow-lg object-cover" alt="{{ $alumni->full_name }}">
        @else
            <div class="w-44 h-44 rounded-full mx-auto mb-4 border-4 border-white shadow-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                <span class="text-white text-6xl font-bold">{{ substr($alumni->full_name, 0, 1) }}</span>
            </div>
        @endif
        <h2 class="text-3xl font-bold mb-2">{{ $alumni->full_name }}</h2>
        @if($alumni->current_job && $alumni->company_name)
            <p class="text-xl text-gray-200">{{ $alumni->current_job }} at {{ $alumni->company_name }}</p>
        @elseif($alumni->current_job)
            <p class="text-xl text-gray-200">{{ $alumni->current_job }}</p>
        @endif
    </div>
</section>

<!-- Profile Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-blue-600 text-white px-6 py-4">
                        <h5 class="text-xl font-bold"><i class="bi bi-person-circle me-2"></i>Personal Information</h5>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <p class="font-semibold text-gray-700 mb-1"><i class="bi bi-mortarboard me-2 text-blue-600"></i>Department:</p>
                                <p class="text-gray-600">{{ $alumni->department }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700 mb-1"><i class="bi bi-calendar3 me-2 text-blue-600"></i>Year Passed:</p>
                                <p class="text-gray-600">{{ $alumni->year_passed }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700 mb-1"><i class="bi bi-envelope me-2 text-blue-600"></i>Email:</p>
                                <p class="text-gray-600">{{ $alumni->email }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700 mb-1"><i class="bi bi-telephone me-2 text-blue-600"></i>Contact:</p>
                                <p class="text-gray-600">{{ $alumni->contact_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                @if($alumni->current_job || $alumni->company_name || $alumni->job_time_duration)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-green-600 text-white px-6 py-4">
                        <h5 class="text-xl font-bold"><i class="bi bi-briefcase me-2"></i>Professional Information</h5>
                    </div>
                    <div class="p-6 space-y-3">
                        @if($alumni->current_job)
                            <p class="text-gray-700"><strong>Position:</strong> {{ $alumni->current_job }}</p>
                        @endif
                        @if($alumni->company_name)
                            <p class="text-gray-700"><strong>Company:</strong> {{ $alumni->company_name }}</p>
                        @endif
                        @if($alumni->job_time_duration)
                            <p class="text-gray-700"><strong>Time to Get Job:</strong> {{ $alumni->job_time_duration }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Message for Juniors -->
                @if($alumni->review)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-purple-600 text-white px-6 py-4">
                        <h5 class="text-xl font-bold"><i class="bi bi-chat-quote me-2"></i>Message for Juniors</h5>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">{{ $alumni->review }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm sticky top-4">
                    <div class="bg-gray-700 text-white px-6 py-4">
                        <h5 class="text-xl font-bold"><i class="bi bi-telephone-fill me-2"></i>Contact</h5>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="tel:{{ $alumni->contact_number }}" class="block w-full px-4 py-3 bg-green-600 text-white text-center rounded-lg font-semibold hover:bg-green-700 transition">
                            <i class="bi bi-telephone-fill me-2"></i>Call Now
                        </a>
                        @if($alumni->whatsapp_number)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $alumni->whatsapp_number) }}" target="_blank" class="block w-full px-4 py-3 bg-green-600 text-white text-center rounded-lg font-semibold hover:bg-green-700 transition">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </a>
                        @endif
                        <a href="mailto:{{ $alumni->email }}" class="block w-full px-4 py-3 bg-blue-600 text-white text-center rounded-lg font-semibold hover:bg-blue-700 transition">
                            <i class="bi bi-envelope-fill me-2"></i>Send Email
                        </a>
                        <hr class="my-4">
                        <a href="{{ route('alumni.index') }}" class="block w-full px-4 py-3 border-2 border-gray-300 text-gray-700 text-center rounded-lg font-semibold hover:bg-gray-50 transition">
                            <i class="bi bi-arrow-left me-2"></i>Back to Directory
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
