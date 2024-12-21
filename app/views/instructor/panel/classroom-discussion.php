
<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

  <?php include('nav.php') ?>

    <div class="w-full h-screen flex flex-row justify-center pt-16 ">
     <aside id="default-sidebar" class="fixed left-0 mt-14 h-full z-40 w-64" aria-label="Sidenav">
      <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <ul class="space-y-2">
          <li>
              <a href="/course-pilot/instructor" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true" class="w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                  <span class="ml-3">Dashboard</span>
              </a>
          </li>
          <li>
              <button type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Course Management</span>
                  <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
              <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                  <li>
                      <a href="/course-pilot/instructor?panel=new-course" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Add New Course</a>
                  </li>
                  <li>
                      <a href="/course-pilot/instructor?panel=manage-resources" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Manage Resources</a>
                  </li>
              </ul>
          </li>
          <li>
              <a href="/course-pilot/instructor?panel=assignments" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                  <span class="ml-3">Assignments & Grading</span>
              </a>
          </li>
          <li>
              <a href="/course-pilot/instructor" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                  <span class="flex-1 ml-3 whitespace-nowrap">Quiz & Test Centre</span>
                  <span class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                      6   
                  </span>
              </a>
          </li>
          <li>
              <button type="button" class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-authentication" data-collapse-toggle="dropdown-authentication">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Progress Tracking</span>
                  <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
              <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                  <li>
                      <a href="/course-pilot/instructor/course-progress" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View Student Progress</a>
                  </li>
                  <li>
                      <a href="/course-pilot/instructor?panel=completion-rates" class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Track Grades & Completion Rates</a>
                  </li>
              </ul>
          </li>
      </ul>
      <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
          <li>
              <a href="/course-pilot/instructor/classroom-discussion" class="flex items-center p-2 text-base font-normal text-white bg-green-600 hover:bg-green-800 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-white text-gray-400 transition duration-75 hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                  <span class="ml-3">Classroom Discussion</span>
              </a>
          </li>
          <li>
              <a href="/course-pilot/instructor/analytics" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                  <span class="ml-3">Reports & Analytics</span>
              </a>
          </li>
          <li>
              <a href="/course-pilot/instructor/announcement" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
                  <span class="ml-3">Announcements</span>
              </a>
          </li>
          <li>
              <a href="/course-pilot/instructor/resource-library" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
                  <span class="ml-3">Resource Library</span>
              </a>
          </li>
      </ul>
  </div>
  
</aside>  


<main class="" style="width: 1200px; margin-left:230px; margin-top:30px;">
    <div class="bg-white w-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <header class="text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-2">
                Classroom Discussions
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Collaborate, learn, and share ideas with your peers!
            </p>
        </header>

        <section class="bg-white dark:bg-gray-800 p-4 rounded-2xl">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6 text-center">
                Start a New Discussion
            </h2>
            <form class="space-y-6" method="POST" action="/course-pilot/instructor/classroom-discussion">
            <div>
                <label for="course" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Select Course
                </label>
                <select
                    id="course"
                    name="course_id"
                    class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required>
                    <option value="" disabled selected>Select a course</option>
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= htmlspecialchars($course['course_id']) ?>">
                                <?= htmlspecialchars($course['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>No courses available</option>
                    <?php endif; ?>
                </select>

            </div>
            <div>
                <label for="discussion-title" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Discussion Title
                </label>
                <input
                    id="discussion-title"
                    name="discussion_title"
                    type="text"
                    class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none"
                    placeholder="Enter the title of your discussion"
                    required>
            </div>
            <div>
                <label for="discussion-content" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Discussion Content
                </label>
                <textarea
                    id="discussion-content"
                    name="discussion_content"
                    rows="6"
                    class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none"
                    placeholder="What do you want to discuss?"
                    required></textarea>
            </div>
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white py-3 rounded-lg font-semibold focus:outline-none focus:ring-4 focus:ring-green-300">
                Create Discussion
            </button>
        </form>
        </section>

        <section>
            <h2 class="text-3xl mt-4 font-semibold text-gray-900 dark:text-white mb-6 text-center">
                Ongoing Discussions
            </h2>
            <div class="space-y-6">
                <?php if (!empty($discussions)): ?>
                    <?php foreach ($discussions as $discussion): ?>
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                <?= htmlspecialchars($discussion['title']) ?>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                <span class="font-medium">Course: <?= htmlspecialchars($discussion['course_title']) ?></span><br>
                                Started by <span class="font-medium"><?= htmlspecialchars($discussion['created_by']) ?></span> 
                                on <?= date('F j, Y', strtotime($discussion['created_at'])) ?>
                            </p>
                            <div class="flex gap-3">
                                <button onclick="openEditModal(<?= htmlspecialchars(json_encode($discussion)) ?>)" 
                                        class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300 text-center">
                                    Edit
                                </button>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-600 dark:text-gray-400">No ongoing discussions found.</p>
                <?php endif; ?>
            </div>
        </section>

        <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-sm hidden z-50">
    <div class="relative bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl w-full max-w-lg">
        <!-- Close Button -->
        <button onclick="closeEditModal()" 
                class="absolute top-4 right-4 bg-gray-200 hover:bg-red-500 hover:text-white text-gray-600 rounded-full p-2 transition-all focus:outline-none focus:ring-2 focus:ring-red-400">
            ✕
        </button>

        <!-- Modal Header -->
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">
            Edit Discussion
        </h2>

        <!-- Modal Form -->
        <form id="editDiscussionForm" method="POST" action="/course-pilot/instructor/discussions/edit" class="space-y-6">
            <input type="hidden" id="discussion_id" name="discussion_id">

            <!-- Discussion Title -->
            <div class="space-y-2">
                <label for="editTitle" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    Discussion Title
                </label>
                <input
                    type="text"
                    id="editTitle"
                    name="discussion_title"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-green-500 focus:outline-none border border-gray-300"
                    placeholder="Enter the new title for your discussion"
                    required>
            </div>

            <!-- Discussion Content -->
            <div class="space-y-2">
                <label for="editContent" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    Discussion Content
                </label>
                <textarea
                    id="editContent"
                    name="discussion_content"
                    rows="6"
                    class="w-full p-4 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-green-500 focus:outline-none border border-gray-300"
                    placeholder="Update the content of your discussion"
                    required></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center gap-6 mt-6">
                <button type="button" onclick="closeEditModal()" 
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-xl font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white py-3 px-8 rounded-xl font-semibold focus:outline-none focus:ring-4 focus:ring-green-300 transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>



    </div>
  </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
<script>
    function openEditModal(discussion) {
        document.getElementById('discussion_id').value = discussion.discussion_id;
        document.getElementById('editTitle').value = discussion.title;
        document.getElementById('editContent').value = discussion.content;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

</body>
</html>
