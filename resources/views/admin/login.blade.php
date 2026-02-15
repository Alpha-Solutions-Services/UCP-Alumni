<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - UCP Alumni Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-gradient-to-br from-gray-800 to-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6 text-center">
                <i class="bi bi-shield-lock-fill text-5xl text-white mb-3"></i>
                <h2 class="text-2xl font-bold text-white">Admin Login</h2>
                <p class="text-blue-100 mt-2">UCP Alumni Portal</p>
            </div>
            
            <div class="p-8">
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-3 top-3 text-gray-400"></i>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required autofocus>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Password</label>
                        <div class="relative">
                            <i class="bi bi-lock absolute left-3 top-3 text-gray-400"></i>
                            <input type="password" name="password" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition shadow-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 transition">
                        <i class="bi bi-arrow-left me-2"></i>Back to Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
