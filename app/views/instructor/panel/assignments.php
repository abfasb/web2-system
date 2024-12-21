<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor: Assignments & Grading</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white p-8">

    <div class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">
     <button onclick="window.history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition-all">
                <i class="fas fa-arrow-left text-xl mr-2"></i>
                <span class="font-semibold text-lg">Return</span>
            </button>
        Assignments & Grading
    </div>

    <div class="space-y-6">
        
    <div class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">
        Create a New Assignment
    </div>

    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
        <form action="/course-pilot/instructor/create-assignment" method="POST" class="space-y-6">
            <div class="flex flex-col space-y-2">
                <label for="course_id" class="text-sm font-medium">Course</label>
                <select name="course_id" id="course_id" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
                    <?php foreach ($courses as $course) { ?>
                        <option value="<?= $course['course_id'] ?>"><?= $course['title'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="assignment_name" class="text-sm font-medium">Assignment Title</label>
                <input type="text" name="assignment_name" id="assignment_name" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="description" class="text-sm font-medium">Description</label>
                <textarea name="description" id="description" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required></textarea>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="total_marks" class="text-sm font-medium">Total Marks</label>
                <input type="number" name="total_marks" id="total_marks" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="due_date" class="text-sm font-medium">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
            </div>

            <button type="submit" class="w-full py-3 mt-4 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none">
                Create Assignment
            </button>
        </form>
    </div>

        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
            <div class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                Assignments List
            </div>
            <div class="space-y-4">
            <?php foreach ($assignments as $assignment) : ?>
                <div class="flex justify-between items-center p-4 bg-gray-200 dark:bg-gray-600 rounded-lg">
                    <div>
                        <span class="font-semibold"><?= htmlspecialchars($assignment['assignment_title']) ?>:</span>
                        <?= htmlspecialchars($assignment['assignment_description']) ?>
                        <span class="text-sm text-gray-500 dark:text-gray-300"> | Due: <?= htmlspecialchars($assignment['due_date']) ?></span>
                    </div>
                    <div class="space-x-4">
                        <button onclick='openEditModal(<?= json_encode($assignment) ?>)' class="text-blue-600 hover:underline">Edit</button>
                        <button onclick="openDeleteModal(<?= $assignment['assignment_id'] ?>)" class="text-red-600 hover:underline">Delete</button>
                    </div>
                </div>
            <?php endforeach; ?>

            </div>
        </div>

       

    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg w-1/3">
        <form id="editForm" action="/course-pilot/instructor/edit-assignment" method="POST" class="space-y-4">
            <input type="hidden" name="assignment_id" id="editAssignmentId">
            <div class="flex flex-col space-y-2">
                <label for="editTitle" class="text-sm font-medium">Assignment Title</label>
                <input type="text" name="edit_title" id="editTitle" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="editDescription" class="text-sm font-medium">Description</label>
                <textarea name="edit_description" id="editDescription" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required></textarea>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="editDueDate" class="text-sm font-medium">Due Date</label>
                <input type="date" name="edit_due_date" id="editDueDate" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="editTotalMarks" class="text-sm font-medium">Total Marks</label>
                <input type="number" name="edit_total_marks" id="editTotalMarks" class="p-3 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white" required>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg w-1/3">
        <p class="text-center text-lg font-medium mb-6">Are you sure you want to delete this assignment?</p>
        <form id="deleteForm" action="/course-pilot/instructor/delete-assignment" method="POST" class="flex justify-center space-x-4">
            <input type="hidden" name="assignment_id" id="deleteAssignmentId">
            <button type="button" onclick="closeModal('deleteModal')" class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Delete</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(assignment) {
        document.getElementById('editAssignmentId').value = assignment.assignment_id;
        document.getElementById('editTitle').value = assignment.assignment_title;
        document.getElementById('editDescription').value = assignment.assignment_description;
        document.getElementById('editDueDate').value = assignment.due_date;
        document.getElementById('editTotalMarks').value = assignment.total_marks;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function openDeleteModal(assignmentId) {
        document.getElementById('deleteAssignmentId').value = assignmentId;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>


</body>
</html>
