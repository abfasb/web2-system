<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Discussions and Posts</title>
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
<body>
    <?php include('discussionnav.php'); ?>

    <div class="container mx-auto py-12 px-6">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-12 text-center">
            Discussions for Enrolled Courses
        </h1>

        <div class="space-y-8">
            <?php foreach ($discussions as $discussion): ?>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        <?= htmlspecialchars($discussion['title']); ?>
                    </h2>
                    <p class="text-gray-600 text-sm">
                        Posted by <strong><?= htmlspecialchars($discussion['created_by_username']); ?></strong> 
                        in <strong><?= htmlspecialchars($discussion['course_title']); ?></strong>
                        on <?= htmlspecialchars($discussion['created_at']); ?>
                    </p>
                    <p class="mt-4 text-gray-700"><?= nl2br(htmlspecialchars($discussion['content'])); ?></p>

                    <?php if (!empty($discussion['posts'])): ?>
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800">Replies:</h3>
                            <div class="mt-4 space-y-4">
                                <?php foreach ($discussion['posts'] as $post): ?>
                                    <div class="border-l-4 border-blue-500 bg-gray-50 p-4 rounded-md">
                                        <p class="text-sm text-gray-600">
                                            Posted by <strong><?= htmlspecialchars($post['posted_by_username']); ?></strong> 
                                            on <?= htmlspecialchars($post['posted_at']); ?>
                                        </p>
                                        <p class="mt-2 text-gray-700"><?= nl2br(htmlspecialchars($post['content'])); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="mt-4 text-gray-500 italic">No replies yet.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
