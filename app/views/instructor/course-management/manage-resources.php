<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello this is manage resources</h1>
</body>
</html>


<h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Add New Course</h1>

<form action="/course-pilot/instructor/add-course" method="POST" class="space-y-6 ">
    <div>
        <label for="title" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Course Title</label>
        <input
            type="text"
            id="title"
            name="title"
            required
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3"
            placeholder="Enter course title"
        />
    </div>

    <div>
        <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
        <textarea
            id="description"
            name="description"
            rows="5"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3"
            placeholder="Enter course description"
        ></textarea>
    </div>

    <div class="flex items-end space-x-4 pb-2 justify-end">
        <div class="flex-grow">
            <label for="course_code" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Course Code</label>
            <input
                type="text"
                id="course_code"
                name="course_code"
                required
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3"
                placeholder="Enter unique course code"
            />
        </div>
        <button
            type="button"
            onclick="generateCourseCode()"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
        >
            Generate Code
        </button>
    </div>

    <div class="mt-6">
        <button
            type="submit"
            class="w-full bg-green-600 text-white py-3 rounded-lg shadow hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-lg font-semibold"
        >
            Add Course
        </button>
    </div>
</form>

</div> 

<script>
function generateCourseCode() {
    const randomCode = 'COURSE-' + Math.random().toString(36).substr(2, 6).toUpperCase();
    document.getElementById('course_code').value = randomCode;
}
</script>