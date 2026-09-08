<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Akun UMKM</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex flex-col lg:flex-row items-center justify-center min-h-screen w-full">
    <!-- Left Form -->
    <div class="bg-white w-full lg:w-1/2 px-8 py-10 lg:px-20 lg:py-16 shadow-md rounded-lg">
      <!-- Branding -->
      <div class="flex items-center gap-2 mb-4">
        <img src="/img/UMKM(1).png" alt="Logo" class="h-10">
        <span class="text-purple-600 font-semibold text-lg">Lemahmulya</span>
      </div>

      <h1 class="text-2xl font-bold mb-2">Daftar Akun UMKM</h1>
      <p class="text-gray-600 mb-6">Silakan isi data di bawah untuk mendaftarkan UMKM Anda.</p>

      @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="text-red-600 mb-4">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ url('register') }}" class="space-y-4">
        @csrf
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
          <input type="text" id="name" name="name" required
            placeholder="Nama Pemilik"
            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-2 bg-gray-50" />
        </div>
        <div>
          <label for="nama_umkm" class="block text-sm font-medium text-gray-700">Nama UMKM</label>
          <input type="text" id="nama_umkm" name="nama_umkm" required
            placeholder="Nama UMKM"
            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-2 bg-gray-50" />
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP</label>
          <input type="tel" id="phone" name="phone" required
            placeholder="08xxxxxxxxxx"
            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-2 bg-gray-50" />
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required
            placeholder="email@example.com"
            class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-2 bg-gray-50" />
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="relative">
            <input type="password" id="password" name="password" required
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
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded font-semibold">
          Daftar
        </button>
      </form>

      <p class="text-center text-sm text-gray-600 mt-6">
        Sudah punya akun?
        <a href="{{ url('login') }}" class="text-purple-600 hover:underline">Login</a>
      </p>
    </div>

    <!-- Right Image -->
    <div class="hidden lg:flex w-1/2 items-center justify-center p-8">
      <img src="/img/2.jpg" alt="Ilustrasi UMKM" class="max-w-md w-full rounded-lg shadow-lg">
    </div>
  </div>
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const pwd = document.getElementById('password');
    const eye = document.getElementById('eyeIcon');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        eye.innerHTML = `<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
            d=\"M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m1.414-1.414A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.293 5.95M15 12a3 3 0 11-6 0 3 3 0 016 0z\" />
            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
            d=\"M3 3l18 18\" />`;
    } else {
        pwd.type = 'password';
        eye.innerHTML = `<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
            d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\" />
            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
            d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\" />`;
    }
});
</script>
</body>
</html>
