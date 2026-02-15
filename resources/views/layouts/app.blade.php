<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'UCP Alumni Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 text-gray-800 hover:opacity-80 transition">
                    <img src="{{ asset('images/ucp-logo.png') }}" alt="UCP Logo" class="h-10">
                    <span class="text-xl font-semibold">Alumni Portal</span>
                </a>
                <div class="hidden md:flex space-x-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg font-medium transition {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : '' }}">Home</a>
                    <a href="{{ route('alumni.create') }}" class="px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg font-medium transition {{ request()->routeIs('alumni.create') ? 'text-blue-600 bg-blue-50' : '' }}">Register</a>
                    <a href="{{ route('alumni.index') }}" class="px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg font-medium transition {{ request()->routeIs('alumni.index') ? 'text-blue-600 bg-blue-50' : '' }}">Alumni Directory</a>
                    <a href="{{ route('admin.login') }}" class="px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg font-medium transition">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8 mt-auto">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-3 mb-2">
                        <img src="{{ asset('images/ucp-logo.png') }}" alt="UCP Logo" class="h-8">
                        <h5 class="text-lg font-semibold text-gray-800">UCP Department Alumni Portal</h5>
                    </div>
                    <p class="text-gray-600">Connecting graduates and building futures</p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-600 mb-2">© {{ date('Y') }} UCP Alumni Portal. All rights reserved.</p>
                    <div class="flex space-x-4 justify-center md:justify-end">
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition"><i class="bi bi-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition"><i class="bi bi-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition"><i class="bi bi-linkedin text-xl"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition"><i class="bi bi-instagram text-xl"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
