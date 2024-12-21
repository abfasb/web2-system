<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Assignments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(90deg, #e0f7ff, #ffeff0);
            animation: gradient 6s infinite alternate;
        }

        @keyframes gradient {
            0% { background: linear-gradient(90deg, #e0f7ff, #ffeff0); }
            100% { background: linear-gradient(90deg, #ffeff0, #e0f7ff); }
        }
    </style>
</head>
<body >

<?php include('asnav.php') ?>
    
    <div class="container mx-auto py-12 px-6">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-12 text-center">
            Your Assignments
        </h1>

        <?php if (!empty($assignments)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($assignments as $assignment): ?>
                    <div 
                        class="relative bg-white shadow-md hover:shadow-xl rounded-2xl overflow-hidden transition-transform duration-300 transform hover:scale-105"
                        role="article" aria-labelledby="assignment-<?= htmlspecialchars($assignment['assignment_id']) ?>">
                        <div class="absolute top-0 left-0 bg-blue-500 text-white text-sm font-semibold px-4 py-1 rounded-br-xl">
                            <?= htmlspecialchars($assignment['course_code']) ?>
                        </div>
                        <div class="p-6 space-y-4">
                            <h2 id="assignment-<?= htmlspecialchars($assignment['assignment_id']) ?>"
                                class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-200">
                                <?= htmlspecialchars($assignment['assignment_title']) ?>
                            </h2>
                            <p class="text-gray-600 line-clamp-3">
                                <?= htmlspecialchars($assignment['description']) ?>
                            </p>
                            <div class="text-gray-700 space-y-1">
                                <p>
                                    <span class="font-semibold">Course:</span> <?= htmlspecialchars($assignment['course_title']) ?>
                                </p>
                                <p>
                                    <span class="font-semibold">Highest Mark:</span> <?= htmlspecialchars($assignment['total_marks']) ?>
                                </p>
                                <p>
                                    <span class="font-semibold">Due Date:</span> <?= htmlspecialchars($assignment['due_date']) ?>
                                </p>
                                <p>
                                    <span class="font-semibold">Status:</span> 
                                    <span class="<?= $assignment['submission_status'] === 'submitted' ? 'text-green-500' : 'text-red-500' ?>">
                                        <?= htmlspecialchars(ucfirst($assignment['submission_status'] ?? 'Undone')) ?>
                                    </span>
                                </p>
                            </div>
                            <a href="/course-pilot/user/assignment?assignment_id=<?= urlencode($assignment['assignment_id']) ?>"
                               class="block mt-4 text-center bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-20">
                <h2 class="text-2xl text-gray-500 font-medium">
                    No assignments available at the moment.
                </h2>
                <p class="text-gray-400 mt-4">
                    Check back later for updates!
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
