<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submission</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-blue-100 to-indigo-200 min-h-screen flex justify-center items-center">

<div class="mb-6 absolute top-0 left-0 m-4">
        <button onclick="window.history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition-all">
            <i class="fas fa-arrow-left text-xl mr-2"></i>
            <span class="font-semibold text-lg">Return</span>
        </button>
    </div>

    <div class="w-full max-w-6xl bg-white rounded-lg shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-12 flex justify-between items-center">
            <div>
                <h1 class="text-5xl font-extrabold text-white">
                    <?= htmlspecialchars($assignmentData['title']) ?>
                </h1>
                <p class="text-xl text-indigo-200 mt-4">
                    <?= htmlspecialchars($assignmentData['description']) ?>
                </p>
            </div>
            <div id="formContainer">
                <?php if (isset($fileStatus) && is_array($fileStatus) && isset($fileStatus['status']) && $fileStatus['status'] === 'submitted'): ?>
                    <form id="undoForm" action="/course-pilot/user/undo-turn-in" method="POST">
                        <input type="hidden" name="assignment_id" value="<?= htmlspecialchars($assignmentData['assignment_id']) ?>">
                        <button 
                            type="submit" 
                            class="bg-red-600 text-white py-12 px-12 w-48 rounded-lg shadow-md hover:bg-red-700 transition">
                            Undo Turn In
                        </button>
                    </form>
                <?php else: ?>
                    <form id="assignmentForm" action="/course-pilot/user/submit-assignment" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="assignment_id" value="<?= htmlspecialchars($assignmentData['assignment_id']) ?>">

                        <label for="submission_file" class="block text-3xl font-semibold text-white mb-6">
                            Upload Your Assignment
                        </label>
                        <div class="border-4 border-dashed border-gray-300 rounded-lg p-8 bg-gray-100">
                            <input 
                                type="file" 
                                id="submission_file" 
                                name="submission_file" 
                                class="w-full bg-transparent p-4 text-lg text-gray-700 file:bg-blue-500 file:text-white file:py-4 file:px-6 file:rounded-md file:cursor-pointer"
                                required>
                        </div>
                        <p class="text-lg text-indigo-100 mt-4">Accepted file types: .pdf, .docx, .txt, .zip</p>
                        <button 
                            type="submit" 
                            class="mt-6 bg-green-500 text-white py-4 px-10 rounded-lg shadow-md hover:bg-green-600 transition w-full">
                            Turn In Assignment
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-12">
            <?php if (isset($assignmentData['last_updated'])): ?>
                <p class="text-lg text-gray-500">
                    Last updated: <?= date('F j, Y, g:i a', strtotime($assignmentData['last_updated'])) ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div id="toast-container" class="fixed top-6 right-6 z-50 space-y-4"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function showToast(message, type = 'success') {
                const toastContainer = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.classList.add(
                    'p-4', 'rounded-lg', 'shadow-lg', 'transition', 'duration-300',
                    type === 'success' ? 'bg-green-500' : 'bg-red-500',
                    'text-white', 'opacity-0', 'transform', 'translate-x-full'
                );
                toast.textContent = message;
                toastContainer.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('opacity-100', 'translate-x-0');
                }, 100);

                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-x-0');
                    toast.classList.add('opacity-0', 'translate-x-full');
                    setTimeout(() => toast.remove(), 500);
                }, 4000);
            }

        const assignmentForm = document.getElementById('assignmentForm');
        if (assignmentForm) {
            assignmentForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('/course-pilot/user/submit-assignment', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    showToast("Assignment submitted successfully!", 'success');
                    document.getElementById('formContainer').innerHTML = `
                        <p class="text-green-600 text-xl">Assignment successfully submitted!</p>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast("An error occurred while submitting the assignment.", 'error');
                });
            });
        }

        const undoForm = document.getElementById('undoForm');
        if (undoForm) {
            undoForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('/course-pilot/user/undo-turn-in', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    showToast("Turn-in undone successfully!", 'success');
                    document.getElementById('formContainer').innerHTML = `
                        <p class="text-red-600 text-xl">Turn-in undone successfully!</p>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast("An error occurred while undoing the turn-in.", 'error');
                });
            });
        }
    });
</script>

</body>
</html>
