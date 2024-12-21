<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades - Past Due Assignments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(90deg, #e3fdfd, #ffe6fa);
            animation: gradient 8s infinite alternate;
        }

        @keyframes gradient {
            0% { background: linear-gradient(90deg, #e3fdfd, #ffe6fa); }
            100% { background: linear-gradient(90deg, #ffe6fa, #e3fdfd); }
        }
    </style>
</head>
<body class="font-sans">
    <?php include('gradenav.php') ?>

    <div class="container mx-auto py-12 px-6">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-8 text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-pink-500">
            Your Grades - Past Due Assignments
        </h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-gradient-to-r from-blue-500 to-pink-500 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Assignment</th>
                        <th class="px-4 py-3 text-left">Course</th>
                        <th class="px-4 py-3 text-left">Due Date</th>
                        <th class="px-4 py-3 text-left">Grade</th>
                        <th class="px-4 py-3 text-left">Feedback</th>
                        <th class="px-4 py-3 text-left">Submission Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($assignments)): ?>
                        <?php foreach ($assignments as $assignment): ?>
                            <tr class="hover:bg-gray-100 border-b">
                                <td class="px-4 py-3 text-gray-700"><?= htmlspecialchars($assignment['title']) ?></td>
                                <td class="px-4 py-3 text-gray-700"><?= htmlspecialchars($assignment['course_title']) ?></td>
                                <td class="px-4 py-3 text-gray-700"><?= htmlspecialchars($assignment['due_date']) ?></td>
                                <td class="px-4 py-3 text-gray-700">
                                    <?= $assignment['grade'] !== null ? htmlspecialchars($assignment['grade']) : '<span class="text-red-500">Not Graded</span>' ?>
                                </td>
                                <td class="px-4 py-3 text-gray-700"><?= htmlspecialchars($assignment['feedback'] ?? 'No Feedback') ?></td>
                                <td class="px-4 py-3 text-gray-700">
                                    <?= isset($assignment['submitted_at']) ? htmlspecialchars($assignment['submitted_at']) : '<span class="text-red-500">Not Submitted</span>' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                No past due assignments found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
