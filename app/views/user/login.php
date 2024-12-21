<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="font-inter overflow-hidden">
    <section class="flex justify-center relative">
      <img src="https://pagedone.io/asset/uploads/1702362010.png" alt="gradient background image" class="w-full h-full object-cover fixed">
      <div class="mx-auto max-w-lg px-6 lg:px-8 absolute py-10">
        <img src="https://i.ibb.co/gg800wj/coursepilo-logo.png" alt="CoursePilot logo" class="mx-auto object-cover w-40">
        <div class="rounded-2xl bg-white shadow-xl">

          <form action="/login" method="POST" class="lg:p-11 p-7 mx-auto">
            <div class="mb-11">
              <h1 class="text-gray-900 text-center font-manrope text-3xl font-bold leading-10 mb-2">Welcome!</h1>
              <p class="text-gray-500 text-center text-base font-medium leading-6">Let’s get started for your learning journey</p>
            </div>
            <input type="text" name="username" id="username" class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mb-6" placeholder="Username">
            <input type="password" name="password" id="password" class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mb-1" placeholder="Password">
            <a href="javascript:;" class="flex justify-end mb-6">
              <span class="text-indigo-600 text-right text-base font-normal leading-6">Forgot Password?</span>
            </a>
            <button type="submit" class="w-full h-12 text-white text-center text-base font-semibold leading-6 rounded-full hover:bg-indigo-800 transition-all duration-700 bg-indigo-600 shadow-sm mb-11">Login</button>
            <a href="/get-user" class="flex justify-center text-gray-900 text-base font-medium leading-6"> Don’t have an account? <span class="text-indigo-600 font-semibold pl-3"> Sign Up</span>
            </a>
          </form>
        </div>
      </div>
    </section>
  </body>
          
  
</html>