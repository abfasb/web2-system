<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User LMS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gradient-to-r from-gray-100 to-gray-200 font-sans min-h-screen">

<?php include('nav.php') ?>

<main class="container mx-auto px-4 py-8">

  <div class="bg-gradient-to-r from-white to-gray-50 p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-500 flex items-center mb-6">
      <i class="fas fa-book mr-3"></i> My Learning Dashboard
    </h1>
    
    <div>
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Enrolled Courses</h2>
      <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($courses as $course): ?>
          <?php if (!empty($course['is_enrolled'])): ?>
            <li class="bg-white border shadow-sm rounded-lg p-4 hover:shadow-md transition">
              <a href="/course-pilot/course?id=<?= urlencode($course['course_id']) ?>" class="block">
                <strong class="block text-lg text-indigo-600"><?= htmlspecialchars($course['title']) ?></strong>
                <p class="text-gray-600 text-sm">Instructor: <?= htmlspecialchars($course['instructor']) ?></p>
                <p class="mt-2 text-green-500 font-medium">Enrolled</p>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="text-center mt-8">
      <button id="join-course-btn" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-green-500 text-white font-bold rounded-md shadow-md hover:opacity-90 transition">
        Join New Course
      </button>
    </div>
  </div>

  <div id="join-course-modal" class="fixed inset-0 bg-gray-800 bg-opacity-60 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-400 mb-4">Join a Course</h2>
      <form action="/course-pilot/enroll" method="POST">
        <div class="mb-4">
          <label for="course-code" class="block text-sm font-medium text-gray-600">Course Code</label>
          <input type="text" id="course-code" name="course_code" class="w-full p-3 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter course code" required>
        </div>
        <div class="flex justify-end">
          <button type="button" id="close-modal-btn" class="bg-gray-300 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-400 transition mr-2">Cancel</button>
          <button type="submit" class="bg-gradient-to-r from-blue-600 to-green-500 px-4 py-2 rounded-md text-sm font-medium text-white hover:opacity-90 transition">Join</button>
        </div>
      </form>
    </div>
  </div>

</main>

<div id="success-toast" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hidden z-50">
  Successfully joined the course!
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script>
  const joinCourseBtn = document.getElementById('join-course-btn');
  const joinCourseModal = document.getElementById('join-course-modal');
  const closeModalBtn = document.getElementById('close-modal-btn');

  if (joinCourseBtn) {
    joinCourseBtn.addEventListener('click', () => joinCourseModal.classList.remove('hidden'));
  }
  if (closeModalBtn) {
    closeModalBtn.addEventListener('click', () => joinCourseModal.classList.add('hidden'));
  }

  function showToast(message) {
    const toast = document.getElementById('success-toast');
    toast.textContent = message;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
  }

</script>

</body>
</html>
