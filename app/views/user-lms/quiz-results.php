<?php
session_start();

if (!isset($_SESSION['quiz_result'])) {
    header('Location: /course-pilot/quiz-error');
    exit;
}

$quizResult = $_SESSION['quiz_result'];

// Optionally clear result after display
unset($_SESSION['quiz_result']);

// Define a passing score threshold (e.g., 50% of total questions)
$passingScore = 0.5 * $quizResult['total_questions']; 
$passed = $quizResult['score'] >= $passingScore;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-700 h-screen flex items-center justify-center">

    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-xl transform scale-100 transition-all duration-300 ease-in-out hover:scale-105">
        <div class="text-center">
            <h1 class="text-5xl font-extrabold text-gray-800 mb-6">Quiz Results</h1>

            <div class="bg-blue-50 p-6 rounded-lg shadow-lg mb-8">
                <p class="text-3xl font-bold text-gray-800 mb-4">
                    You scored <span class="text-green-600"><?php echo $quizResult['score']; ?></span> out of <span class="text-yellow-500"><?php echo $quizResult['total_questions']; ?></span>.
                </p>

                <?php if ($passed): ?>
                    <p class="text-lg font-medium text-green-600">Congratulations, you passed the exam! Great job!</p>
                <?php else: ?>
                    <p class="text-lg font-medium text-red-600">You didn't pass the exam this time. Keep it up and try again!</p>
                <?php endif; ?>
            </div>

            <div class="mt-8">
                <a href="/course-pilot/user/" class="inline-block bg-gradient-to-r from-yellow-400 to-red-500 text-white py-3 px-8 rounded-full font-semibold text-xl hover:opacity-80 transition duration-300 ease-in-out transform hover:scale-105">
                    Return to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        const resultContainer = document.querySelector('.max-w-4xl');
        setTimeout(() => {
            resultContainer.classList.add('scale-105');
        }, 500);
    </script>
</body>
</html>
