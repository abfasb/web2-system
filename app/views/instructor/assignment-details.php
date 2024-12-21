<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submission Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #1d4ed8;
            border-radius: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #e5e7eb;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-gray-100 to-gray-200 min-h-screen">

    <div class="container mx-auto p-8">
        <button onclick="window.history.back()" class="bg-blue-600 text-white px-6 py-3 rounded-lg mb-8 hover:bg-blue-700 shadow-md transition duration-200 ease-in-out">
            <i class="fas fa-arrow-left text-xl mr-2"></i>
            Back to Previous Page
        </button>

        <h1 class="text-5xl font-extrabold text-center text-gray-800 mb-8">📚 Assignment Submission Portal</h1>

        <div class="shadow-2xl rounded-lg bg-white overflow-hidden">
        <table class="min-w-full table-auto bg-gray-50 custom-scroll">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Student</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold">File Submission</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Submission Status</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-800">
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr class="hover:bg-gray-100 <?= $user['is_graded'] ? 'bg-gray-300' : ''; ?>">
                            <td class="px-6 py-4 font-medium <?= $user['is_graded'] ? 'text-gray-500' : ''; ?>">
                                <?= htmlspecialchars($user['username']); ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if (!empty($user['file_name'])) : ?>
                                    <a href="<?= htmlspecialchars($user['file_path']); ?>" class="text-indigo-600 hover:underline font-semibold">
                                        View Assignment
                                    </a>
                                <?php else : ?>
                                    <span class="text-red-600 font-semibold">Not Submitted</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($user['is_graded']) : ?>
                                    <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                                        Graded: <?= $user['grade']; ?>
                                    </span>
                                <?php else : ?>
                                    <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                            <button 
                            onclick="openModal(
                                '<?= $user['user_id']; ?>', 
                                '<?= htmlspecialchars($user['username']); ?>', 
                                '<?= htmlspecialchars($user['file_path'] ?? ''); ?>', 
                                <?= htmlspecialchars($user['total_marks'] ?? 100); ?>
                            )"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow-md transition duration-200 ease-in-out <?= $user['is_graded'] ? 'cursor-not-allowed opacity-50' : ''; ?>"
                            <?= $user['is_graded'] ? 'disabled' : ''; ?>>
                            Grade
                        </button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">No submissions found for this assignment.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>

    <div id="gradeModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg w-11/12 sm:w-1/2 p-6">
            <h2 class="text-2xl font-bold mb-4">Grade Assignment</h2>
            <p class="text-gray-700 mb-4" id="modalStudentName"></p>

            <form method="POST" action="/course-pilot/instructor/create-submission" class="space-y-4">
                <input type="hidden" name="user_id" id="modalUserId">
                <input type="hidden" name="assignment_id" id="modalAssignmentId">

                <div class="space-y-4">
                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                        <input type="number" name="grade" id="modalGrade" min="0" max="100" 
                            class="border border-gray-300 rounded-lg px-3 py-2 w-full text-gray-700 focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                            placeholder="Enter Grade">
                    </div>

                    <div>
                        <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
                        <textarea name="feedback" id="modalFeedback" rows="4" class="border border-gray-300 rounded-lg w-full p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            placeholder="Enter feedback here..."></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openModal(userId, username, filePath, totalMarks = 100) {
        document.getElementById('gradeModal').classList.remove('hidden');

        document.getElementById('modalUserId').value = userId;
        document.getElementById('modalAssignmentId').value = new URLSearchParams(window.location.search).get('assignment_id');
        document.getElementById('modalStudentName').textContent = `Grading for: ${username}`;
        document.getElementById('modalGrade').value = '';
        document.getElementById('modalFeedback').value = '';
        document.getElementById('modalGrade').max = totalMarks;
        document.getElementById('modalGrade').placeholder = `Max Grade: ${totalMarks}`;
    }

    function closeModal() {
        // Hide the modal
        document.getElementById('gradeModal').classList.add('hidden');
    }
</script>


</body>

</html>
