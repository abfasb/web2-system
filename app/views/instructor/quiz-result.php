<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<button onclick="window.history.back()" class="flex items-center m-4 text-blue-600 hover:text-blue-800 transition-all">
                    <i class="fas fa-arrow-left text-xl mr-2"></i>
                    <span class="font-semibold text-lg">Return</span>
                </button>

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Quiz Results</h1>

        <?php if (empty($data['quizDetails'])): ?>
            <div class="text-lg text-gray-600">
                <p>No quiz details found for the selected quiz.</p>
            </div>
        <?php else: ?>
            <div class="bg-white shadow-xl rounded-xl p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6"><?= htmlspecialchars($data['quizDetails'][0]['quiz_title']) ?></h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-lg">
                        <thead class="bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 text-white">
                            <tr>
                                <th class="py-4 px-6 text-left">Username</th>
                                <th class="py-4 px-6 text-left">Score</th>
                                <th class="py-4 px-6 text-left">Completed At</th>
                                <th class="py-4 px-6 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <?php foreach ($data['quizDetails'] as $result): ?>
                                <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                                    <td class="py-4 px-6"><?= htmlspecialchars($result['username']) ?></td>
                                    <td class="py-4 px-6"><?= htmlspecialchars($result['score']) ? htmlspecialchars($result['score']) : 'N/A' ?></td>
                                    <td class="py-4 px-6"><?= $result['completed_at'] ? date('F j, Y, g:i a', strtotime($result['completed_at'])) : 'N/A' ?></td>
                                    <td class="py-4 px-6">
                                        <span class="inline-block py-2 px-4 text-sm font-medium rounded-full
                                            <?= $result['score'] === null ? 'bg-yellow-400 text-white' : 'bg-green-500 text-white' ?>">
                                            <?= $result['score'] === null ? 'Pending' : 'Completed' ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>
