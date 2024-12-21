<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion - Course Pilot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-6">
        <div class="mb-6">
            <button onclick="window.history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition-all">
                <i class="fas fa-arrow-left text-xl mr-2"></i>
                <span class="font-semibold text-lg">Return</span>
            </button>
        </div>

        <div class="bg-gradient-to-r from-blue-50 via-white to-blue-50 rounded-lg shadow-lg hover:shadow-2xl transition-all p-8 mb-8 sticky top-0 z-10">
            <h1 class="text-4xl font-bold text-gray-800"><?= htmlspecialchars($discussion['title']) ?></h1>
            <p class="text-lg text-gray-600 mt-3"><?= htmlspecialchars($discussion['content']) ?></p>
        </div>

        <div class="posts-section mb-12">
            <h3 class="text-2xl font-semibold mb-6">Posts</h3>
            
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-all mb-6 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="https://openclipart.org/image/800px/295930" alt="User Avatar" class="rounded-full w-10 h-10">
                                <div>
                                    <span class="font-semibold text-gray-800 text-lg"><?= htmlspecialchars($post['posted_by_username']) ?></span>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars(date('F j, Y, g:i a', strtotime($post['posted_at']))) ?></p>
                                </div>
                            </div>
                            <button class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                                <i class="fas fa-reply mr-1"></i> Reply
                            </button>
                        </div>
                        <p class="mt-4 text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="flex flex-col items-center bg-white rounded-lg shadow-lg p-8">
                    <i class="fas fa-comment-slash text-6xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold text-gray-600 mb-2">No posts available yet</p>
                    <p class="text-gray-500 text-sm mb-4">Be the first to share your thoughts!</p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-md transition-all">
                        Start a Discussion
                    </button>
                </div>
            <?php endif; ?>
        </div>
       
    </div>

</body>
</html>
