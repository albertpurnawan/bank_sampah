<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>{{ config('app.name', 'Local Recycle') }}</title>
</head>
<body style="background-color: #21AA93;">
  <header class="px-4 flex justify-between items-center">
    <div class="flex items-center">
      <img src="{{ asset('assets/images/LocalRecyle_1.png') }}" alt="Logo" class="w-44 h-28 mr-4">
    </div>
    <div class="md:hidden">
      <button id="menuButton" class="text-white" onclick="toggleMenu()">
        <svg xmlns="http://www.w3.org/TR/SVG" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <div id="dropdown" class="absolute right-0 mt-2 py-2 bg-white rounded shadow-lg hidden">
        <a href="/login" class="block px-4 py-2  text-gray-800 hover:bg-gray-200">Login</a>
        <a href="/register" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Register</a>
        <a href="/about" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">About Us</a>
      </div>
    </div>
    <nav class="hidden md:flex items-center">
      <a href="/login" class="mx-4 text-white text-xl font-semibold">Login</a>
      <a href="/register" class="mx-4 text-white text-xl font-semibold">Register</a>
      <a href="/about" class="mx-4 text-white text-xl font-semibold">About Us</a>
    </nav>
  </header>
<main>
  <div class="bg-[#D1E8E4] h-full">
    {{ $slot }}
  </div>
</main>

  <footer class="py-4 fixed bottom-0 w-full h-fit" style="background-color: #21AA93;">
    <div class="container mx-auto px-4 text-center text-white">
      &copy; 2022 Your Company. All rights reserved.
    </div>
  </footer>

  <script>
    const menuButton = document.getElementById('menuButton');
    const dropdown = document.getElementById('dropdown');

    function toggleMenu() {
      dropdown.classList.toggle('hidden');
      if (dropdown.classList.contains('hidden')) {
        menuButton.innerHTML = '<svg xmlns="http://www.w3.org/TR/SVG" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>';
      } else {
        menuButton.innerHTML = '<svg xmlns="http://www.w3.org/TR/SVG" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
      }
    }
  </script>
</body>
</html>

