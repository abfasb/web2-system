<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(90deg, #e0f7ff, #ffeff0);
            animation: gradient 6s infinite alternate;
        }

        @keyframes gradient {
            0% {
                background: linear-gradient(90deg, #e0f7ff, #ffeff0);
            }

            100% {
                background: linear-gradient(90deg, #ffeff0, #e0f7ff);
            }
        }

        /* Hover card effects */
        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: block; /* Ensure the anchor is a block element to take up full space */
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php include('coursenav.php') ?>

    <div class="container mx-auto py-12 px-6">
        <h1 class="text-5xl font-extrabold text-gray-800 mb-12 text-center">
            Your Enrolled Courses
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php foreach ($courses as $course) : ?>
                <?php if ($course['is_enrolled']) : ?> 
                    <a href="/course-pilot/course?id=<?= urlencode($course['course_id']) ?>" class="course-card bg-white p-6 rounded-lg shadow-lg hover:shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4"><?= htmlspecialchars($course['title']) ?></h3>
                        <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($course['description']) ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500"><?= htmlspecialchars($course['instructor']) ?></span>
                            <span class="text-sm text-gray-500"><?= date('M d, Y', strtotime($course['created_at'])) ?></span>
                        </div>
                        <div class="mt-4">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                Enrolled
                            </span>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
