<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['title'] ?? 'Unknown Course') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <div class="mb-6 m-4">
        <button onclick="window.history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition-all">
            <i class="fas fa-arrow-left text-xl mr-2"></i>
            <span class="font-semibold text-lg">Return</span>
        </button>
    </div>

<div class="max-w-7xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Course Title: <?= htmlspecialchars($course['title'] ?? 'Unknown Course') ?>
    </h1>
    <p class="text-lg text-gray-600 mb-4">
        <?= htmlspecialchars($course['description'] ?? 'No description available for this course.') ?>
    </p>

    <div class="border-b border-gray-300">
        <ul class="flex space-x-6 text-lg font-medium text-gray-600">
        <li><button id="assignments-tab" class="tab-button px-4 py-2 rounded-md">Assignments</button></li>
        <li><button id="quizzes-tab" class="tab-button px-4 py-2 rounded-md">Quizzes</button></li>
        <li><button id="resources-tab" class="tab-button px-4 py-2 rounded-md">Resources</button></li>
        <li><button id="discussion-tab" class="tab-button px-4 py-2 rounded-md">Classroom Discussion</button></li>
        <li><button id="progress-tab" class="tab-button px-4 py-2 rounded-md">Progress</button></li>

        </ul>
    </div>

    <div class="tab-content mt-6 space-y-6">

        <div id="assignments" class="tab-pane hidden p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Upcoming Assignments</h2>
            <?php if (!empty($courseData['assignments'])): ?>
                <ul class="space-y-4">
            <?php foreach ($courseData['assignments'] as $assignment): ?>
                <a href="/course-pilot/user/assignment?assignment_id=<?= urlencode($assignment['assignment_id']) ?>" class="block">
                    <li class="flex justify-between p-4 bg-gray-100 rounded-md shadow-md cursor-pointer">
                        <div>
                            <span class="text-lg font-medium text-gray-700"><?= htmlspecialchars($assignment['title']) ?></span>
                            <span class="text-sm text-gray-500">Due: <?= htmlspecialchars($assignment['due_date']) ?></span>
                        </div>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>
            <?php else: ?>
                <p class="text-gray-500">No assignments available.</p>
            <?php endif; ?>
        </div>

        <div id="quizzes" class="tab-pane hidden p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Quizzes</h2>
            <?php if (!empty($courseData['quizzes'])): ?>
                <ul class="space-y-4">
                    <?php foreach ($courseData['quizzes'] as $quiz): ?>
                        <a href="/course-pilot/user/quiz?quiz_id=<?= urlencode($quiz['quiz_id']) ?>" class="block">
                            <li class="flex justify-between p-4 bg-gray-100 rounded-md shadow-md cursor-pointer hover:bg-gray-200 transition">
                                <div>
                                    <span class="text-lg font-medium text-gray-700"><?= htmlspecialchars($quiz['title']) ?></span>
                                    <p class="text-sm text-gray-500">Due Date: <?= htmlspecialchars($quiz['deadline']) ?></p>
                                </div>
                            </li>
                        </a>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-500">No quizzes available.</p>
            <?php endif; ?>
        </div>


        <div id="resources" class="tab-pane hidden p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Helpful Resources</h2>
            <?php if (!empty($courseData['resources'])): ?>
                <ul class="space-y-6">
                    <?php foreach ($courseData['resources'] as $resource): ?>
                        <li class="flex items-center space-x-4 p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-200">
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-full">
                                <?php
                                    $extension = pathinfo($resource['file_url'], PATHINFO_EXTENSION);
                                    $icon = '';
                                    switch (strtolower($extension)) {
                                        case 'pdf':
                                            $icon = '<i class="fas fa-file-pdf text-red-600 text-3xl"></i>';
                                            break;
                                        case 'pptx':
                                            $icon = '<i class="fas fa-file-powerpoint text-yellow-600 text-3xl"></i>';
                                            break;
                                        case 'docx':
                                            $icon = '<i class="fas fa-file-word text-blue-600 text-3xl"></i>';
                                            break;
                                        case 'xlsx':
                                            $icon = '<i class="fas fa-file-excel text-green-600 text-3xl"></i>';
                                            break;
                                        default:
                                            $icon = '<i class="fas fa-file-alt text-gray-500 text-3xl"></i>';
                                            break;
                                    }
                                    echo $icon;
                                ?>
                            </div>

                            <div class="flex-1">
                                <h3 class="text-xl font-medium text-gray-800"><?= htmlspecialchars($resource['title']) ?></h3>
                                <p class="text-sm text-gray-600 mt-2"><?= htmlspecialchars($resource['description']) ?></p>
                            </div>

                            <a href="<?= htmlspecialchars($resource['file_url']) ?>" 
                            class="text-blue-600 underline text-lg font-semibold hover:text-blue-800 transition-colors">
                                View Resource
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-500">No resources available.</p>
            <?php endif; ?>
        </div>



        
        <div id="discussion" class="tab-pane hidden p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Classroom Discussion</h2>
            <?php if (!empty($courseData['discussions'])): ?>
                <ul class="space-y-4">
                    <?php foreach ($courseData['discussions'] as $discussion): ?>
                        <li class="p-6 bg-gray-100 rounded-md shadow-md">
                            <h3 class="text-lg font-medium text-gray-700 mb-2"><?= htmlspecialchars($discussion['title']) ?></h3>
                            <p class="text-sm text-gray-500 mb-2">Posted by <?= htmlspecialchars($discussion['created_by']) ?> on <?= htmlspecialchars($discussion['created_at']) ?></p>
                            <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($discussion['content']) ?></p>
                            <a href="/course-pilot/user/discussion?discussion_id=<?= urlencode($discussion['discussion_id']) ?>" 
                                class="mt-2 inline-block bg-gradient-to-r from-blue-500 to-green-500 text-white px-4 py-2 rounded-md hover:opacity-90 transition">
                                View Posts
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-500">No discussions available.</p>
            <?php endif; ?>
        </div>


        <div id="progress" class="tab-pane hidden p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Course Progress</h2>

            <div class="progress-item mb-6">
                <h3 class="text-lg font-semibold">Assignments</h3>
                <?php if (isset($courseData['assignmentProgress']) && $courseData['assignmentProgress'] > -1): ?>
                    <div class="w-full bg-gray-200 h-4 rounded-full">
                        <div class="bg-blue-500 h-4 rounded-full" style="width: <?= min($courseData['assignmentProgress'], 100) ?>%"></div>
                    </div>
                    <p class="mt-2 text-sm text-gray-700"><?= $courseData['assignmentProgress'] ?>% completed</p>
                <?php else: ?>
                    <p class="mt-2 text-sm text-gray-500">No progress available</p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
    function showTab(tab) {
        const tabs = document.querySelectorAll('.tab-pane');
        tabs.forEach((tabContent) => tabContent.classList.add('hidden'));

        const activeTab = document.getElementById(tab);
        if (activeTab) {
            activeTab.classList.remove('hidden');
        }

        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach((button) =>
            button.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600')
        );
        const activeButton = document.getElementById(tab + '-tab');
        if (activeButton) {
            activeButton.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        }
    }

    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const tab = event.target.id.replace('-tab', '');
            showTab(tab);
        });
    });

    showTab('assignments');
});



</script>

</body>
</html>
