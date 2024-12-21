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

    <div class="h-screen pt-16 w-full">
     <aside id="default-sidebar" class="fixed top-10 h-full z-40 w-64" aria-label="Sidenav">
      <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <ul class="space-y-2">
          <li>
              <a href="/course-pilot/instructor?panel=dashboard" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
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
              <a href="/course-pilot/instructor/create-assignment" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                  <span class="ml-3">Assignments & Grading</span>
              </a>
          </li>
          <li>
              <a href="/course-pilot/instructor" class="flex items-center text-white p-2 text-base font-normal bg-green-600 hover:bg-green-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-black transition duration-75 hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
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
              <a href="/course-pilot/instructor/classroom-discussion" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
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
                  <span class="ml-3">Discussion forums</span>
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
<main class=" ml-[300px] pl-14">
  <div class="bg-white w-full h-auto flex flex-col items-center justify-center dark:bg-gray-800 rounded-lg shadow-md" style="width:100%;">
    <div class="w-full p-6 bg-white shadow-lg rounded-lg" style="margin-left:170px; width:1100px;">
      <header class="text-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600">Quiz & Test Centre</h1>
        <p class="text-gray-600 mt-2">Create quizzes dynamically with multiple question types.</p>
      </header>

      <form id="quizForm" action="/course-pilot/instructor/create-quiz" method="POST">
        <div class="mb-6">
          <label for="course" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Select Course</label>
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

        <div class="mb-6">
          <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Quiz Title</label>
          <input
            type="text"
            id="title"
            name="title"
            class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:outline-none"
            placeholder="Enter quiz title"
            required />
        </div>

        <div class="mb-6">
          <label for="deadline" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Deadline</label>
          <input
            type="datetime-local"
            id="deadline"
            name="deadline"
            class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:outline-none"
            required />
        </div>
        <div id="questionsContainer" class="mb-6">
  <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Questions</label>

  <div id="questionTemplate" class="hidden">
    <div class="border border-gray-300 dark:border-gray-600 rounded-lg mb-4">
      <button
        type="button"
        class="w-full flex justify-between items-center p-4 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white font-medium rounded-t-lg focus:outline-none question-header"
        onclick="toggleAccordion(this)">
        <span>Question 1</span>
        <svg
          class="w-5 h-5 transform transition-transform duration-200"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div class="accordion-body hidden">
        <div class="p-4 bg-gray-100 dark:bg-gray-800">
          <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Question</label>
          <input
            type="text"
            name="questions[0][question_title]"
            class="w-full p-2 mb-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white"
            placeholder="Enter question text"
            required
            disabled />

          <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Question Type</label>
          <select
            name="questions[0][question_type]"
            class="w-full p-2 mb-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white questionType"
            required
            disabled>
            <option value="Multiple-Choice" selected>Multiple Choice</option>
            <option value="True/False">True/False</option>
            <option value="Identification">Identification</option>
          </select>

          <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Correct Answer</label>
          <div class="correctAnswerContainer">
            <select
              name="questions[0][correct_answer]"
              class="w-full p-2 mb-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white correctAnswerDropdown"
              required
              disabled>
              <option value="" disabled selected>Select Correct Answer</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
          </div>

          <div class="optionsContainer">
            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Options</label>
            <div class="flex flex-col gap-2">
              <input
                type="text"
                name="questions[0][options][A]"
                placeholder="Option A"
                class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white w-full"
                disabled />
              <input
                type="text"
                name="questions[0][options][B]"
                placeholder="Option B"
                class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white w-full"
                disabled />
              <input
                type="text"
                name="questions[0][options][C]"
                placeholder="Option C"
                class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white w-full"
                disabled />
              <input
                type="text"
                name="questions[0][options][D]"
                placeholder="Option D"
                class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white w-full"
                disabled />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mb-6">
  <button
    type="button"
    id="addQuestionButton"
    class="w-full p-4 rounded-lg bg-blue-600 text-white font-bold focus:outline-none hover:bg-blue-700">
    Add Question
  </button>
</div>

<button
  type="submit"
  class="w-full p-4 rounded-lg bg-green-600 text-white font-bold focus:outline-none hover:bg-green-700">
  Create Quiz
</button>

<script>
document.addEventListener('DOMContentLoaded', () => {
  let questionIndex = 0;

  document.getElementById('addQuestionButton').addEventListener('click', () => {
    const template = document.getElementById('questionTemplate');
    const clone = template.cloneNode(true);
    clone.classList.remove('hidden');
    clone.removeAttribute('id');

    const inputs = clone.querySelectorAll('input, select');
    inputs.forEach(input => {
      const name = input.getAttribute('name');
      if (name) {
        input.setAttribute('name', name.replace('questions[0]', `questions[${questionIndex}]`));
        input.removeAttribute('disabled');
      }
    });

    const questionHeader = clone.querySelector('.question-header span');
    questionHeader.textContent = `Question ${questionIndex + 1}`;

    document.getElementById('questionsContainer').appendChild(clone);
    questionIndex++;
  });

  document.addEventListener('change', (event) => {
    if (event.target.classList.contains('questionType')) {
      const parent = event.target.closest('.border');
      const optionsContainer = parent.querySelector('.optionsContainer');
      const correctAnswerContainer = parent.querySelector('.correctAnswerContainer');

      if (event.target.value === 'Multiple-Choice') {
        optionsContainer.classList.remove('hidden');
        optionsContainer.querySelectorAll('input').forEach(input => input.removeAttribute('disabled'));

        correctAnswerContainer.innerHTML = `
          <select
            name="${event.target.name.replace('question_type', 'correct_answer')}"
            class="w-full p-2 mb-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white correctAnswerDropdown"
            required>
            <option value="" disabled selected>Select Correct Answer</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
          </select>
        `;
      } else {
        optionsContainer.classList.add('hidden');
        optionsContainer.querySelectorAll('input').forEach(input => input.setAttribute('disabled', true));

        correctAnswerContainer.innerHTML = `
          <input
            type="text"
            name="${event.target.name.replace('question_type', 'correct_answer')}"
            class="w-full p-2 mb-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white correctAnswerInput"
            placeholder="Enter the correct answer"
            required />
        `;
      }
    }
  });
});

function toggleAccordion(button) {
  const body = button.nextElementSibling;
  const icon = button.querySelector('svg');

  if (body.classList.contains('hidden')) {
    body.classList.remove('hidden');
    icon.classList.add('rotate-180');
  } else {
    body.classList.add('hidden');
    icon.classList.remove('rotate-180');
  }
}
</script>

        


</body>
</html>