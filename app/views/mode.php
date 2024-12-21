<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Role Selector</title>
  <script>
    function redirectTo(path) {
      window.location.href = path;
    }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Enhanced Slideshow Animation */
    .slideshow {
      animation: slideshow 12s infinite alternate;
    }

    @keyframes slideshow {
      0% { background-image: url('https://source.unsplash.com/1600x900/?technology'); }
      50% { background-image: url('https://source.unsplash.com/1600x900/?innovation'); }
      100% { background-image: url('https://source.unsplash.com/1600x900/?future'); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center slideshow bg-cover bg-center">

  <!-- Central Card -->
  <div class="text-center bg-white bg-opacity-30 backdrop-blur-md rounded-3xl p-12 shadow-2xl max-w-4xl">
    <h1 class="text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-purple-600 mb-12">
      Choose Your Role
    </h1>
    <div class="flex space-x-12 justify-center">
      <!-- Learner Button -->
      <button
        onclick="redirectTo('/register')"
        class="group relative flex flex-col items-center px-20 py-16 bg-gradient-to-r from-green-400 to-green-600 text-white text-3xl font-bold rounded-2xl shadow-xl transform transition hover:scale-110 hover:shadow-2xl focus:ring-4 focus:ring-green-300"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-20 h-20 mb-6" viewBox="0 0 24 24">
          <path d="M12 2a7 7 0 100 14 7 7 0 000-14zm3.5 15H8.5A4.5 4.5 0 004 21.5v.5h16v-.5a4.5 4.5 0 00-4.5-4.5z"/>
        </svg>
        Learner
        <span class="absolute inset-0 bg-green-400 opacity-0 group-hover:opacity-30 transition-opacity rounded-2xl"></span>
      </button>

      <!-- Instructor Button -->
      <button
        onclick="redirectTo('/register/instructor')"
        class="group relative flex flex-col items-center px-20 py-16 bg-gradient-to-r from-blue-400 to-blue-600 text-white text-3xl font-bold rounded-2xl shadow-xl transform transition hover:scale-110 hover:shadow-2xl focus:ring-4 focus:ring-blue-300"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-20 h-20 mb-6" viewBox="0 0 24 24">
          <path d="M12 2a7 7 0 100 14 7 7 0 000-14zm-6.5 16h13c.75 0 1.4.41 1.75 1.02A3.977 3.977 0 0120 21H4c-.72 0-1.37-.38-1.75-1.02A2 2 0 015.5 18z"/>
        </svg>
        Instructor
        <span class="absolute inset-0 bg-blue-400 opacity-0 group-hover:opacity-30 transition-opacity rounded-2xl"></span>
      </button>
    </div>
  </div>

</body>
</html>
