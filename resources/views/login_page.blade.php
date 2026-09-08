<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login UMKM Lemahmulya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col lg:flex-row items-center justify-center min-h-screen w-full">
        <!-- Left Side -->
        <div class="bg-white w-full lg:w-1/2 px-8 py-10 lg:px-20 lg:py-16 shadow-md rounded-lg">
            <div class="flex items-center gap-2 mb-4">
                <img src="/img/UMKM(1).png" alt="Logo" class="h-10">
                <span class="text-purple-600 font-semibold text-lg">Lemahmulya</span>
            </div>

            <button onclick="window.location='{{ url('/') }}'" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded mb-6">
                Kembali
            </button>

            <h1 class="text-2xl font-bold mb-2">Hallo, Selamat Datang</h1>
            <p class="text-gray-600 mb-6">Hey, selamat kembali! Silahkan login untuk melanjutkan</p>



            @if($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            @if(session('modal_error'))
            <!-- Modal Alert Error -->
            <div 
                x-data="{ open: true }" 
                x-init="setTimeout(() => open = false, 3000)"
                x-show="open" 
                x-transition 
                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40 px-4"
                :style="open ? 'display:flex' : 'display:none'"
            >
                <div @click.away="open = false" class="bg-white max-w-sm w-full p-6 rounded-xl shadow-lg text-center relative">
                    <!-- Silang animasi SVG -->
                    <svg class="mx-auto mb-4 text-red-500 w-16 h-16 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-800">Login Gagal!</h2>
                    <p class="text-gray-600 mt-2">{{ session('modal_error') }}</p>
                    <button 
                        @click="open = false"
                        class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md"
                    >
                        Tutup
                    </button>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ url('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" required
                        placeholder="stanley@gmail.com"
                        class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-2 bg-gray-50" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            placeholder="Password"
                            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-2 bg-gray-50 pr-10" />
                        <button type="button" id="togglePassword"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            tabindex="-1">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm text-gray-600">
                </div>

                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded font-semibold">
                    Sign In
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-6">
                Tidak Punya Akun?
                <a href="{{ url('register') }}" class="text-purple-600 hover:underline">Sign Up</a>
            </p>
        </div>

        <!-- Right Side -->
        <div class="hidden lg:flex w-1/2 items-center justify-center p-8">
            <img src="/img/login_resource.jpg" alt="Login Illustration" class="max-w-md w-full rounded-lg shadow-lg">
        </div>
    </div>
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const pwd = document.getElementById('password');
    const eye = document.getElementById('eyeIcon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m1.414-1.414A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.293 5.95M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3l18 18" />`;
    } else {
        pwd.type = 'password';
        eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268-2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
});
</script>
</body>
</html>
