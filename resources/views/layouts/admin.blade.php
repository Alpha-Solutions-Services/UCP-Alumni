<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - UCP Alumni Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Admin Navigation -->
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:opacity-80 transition">
                    <i class="bi bi-shield-lock-fill text-2xl"></i>
                    <span class="text-xl font-semibold">Admin Panel</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 hover:bg-gray-700 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 hover:bg-gray-700 rounded-lg transition {{ request()->routeIs('admin.alumni.*') ? 'bg-gray-700' : '' }}">Alumni</a>
                    <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 hover:bg-gray-700 rounded-lg transition">View Site</a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
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
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
