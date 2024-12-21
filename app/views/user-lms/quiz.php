<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($quiz['title']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wider">

    <div class="mt-6 ml-4">
        <button onclick="window.history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition-all">
            <i class="fas fa-arrow-left text-xl mr-2"></i>
            <span class="font-semibold text-lg">Return</span>
        </button>
    </div>
    
    <div class="max-w-5xl mx-auto p-6 mt-10 bg-white rounded-xl shadow-lg">
        <div class="mb-4 text-center">
            <p class="text-lg font-medium text-gray-600">Total Questions: <?php echo count($questions); ?></p>
        </div>

        <h1 class="text-3xl font-semibold text-center text-gray-800"><?php echo htmlspecialchars($quiz['title']); ?></h1>

        <div class="w-full bg-gray-200 rounded-full h-2 mt-6 mb-6 relative">
            <div class="progress-bar-fill bg-blue-600 h-2 rounded-full transition-all duration-300 ease-in-out" id="progressBar" style="width: 0%;"></div>
            <span id="progressPercentage" class="absolute right-0 top-0 text-sm font-medium text-gray-600 mt-[-18px]">
                0%
            </span>
        </div>

        <form action="/course-pilot/user/submit-quiz" method="POST" class="mt-8 space-y-6" id="quizForm">
            <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($quiz['quiz_id']); ?>">

            <?php foreach ($questions as $index => $question): ?>
                <div class="question-container p-5 bg-white rounded-lg shadow-md">
                    <p class="text-xl font-semibold text-gray-700"><?php echo ($index + 1) . '. ' . htmlspecialchars($question['question_text']); ?></p>

                    <div class="mt-4">
                        <?php if ($question['question_type'] === 'Multiple-Choice'): ?>
                            <?php
                            $questionOptions = isset($options[$question['question_id']]) ? $options[$question['question_id']] : [];
                            ?>
                            <?php foreach ($questionOptions as $option): ?>
                                <label class="block p-4 cursor-pointer rounded-lg hover:bg-blue-100 transition-all">
                                    <input type="radio" name="responses[<?php echo $question['question_id']; ?>]" value="<?php echo htmlspecialchars($option['option_label']); ?>" required>
                                    <?php echo htmlspecialchars($option['option_text']); ?>
                                </label>
                            <?php endforeach; ?>
                        <?php elseif ($question['question_type'] === 'True/False'): ?>
                            <div class="flex space-x-6">
                                <label class="cursor-pointer hover:bg-blue-100 p-4 rounded-lg transition-all">
                                    <input type="radio" name="responses[<?php echo $question['question_id']; ?>]" value="True" class="mr-2 rounded-full border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                                    True
                                </label>
                                <label class="cursor-pointer hover:bg-blue-100 p-4 rounded-lg transition-all">
                                    <input type="radio" name="responses[<?php echo $question['question_id']; ?>]" value="False" class="mr-2 rounded-full border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                                    False
                                </label>
                            </div>
                        <?php elseif ($question['question_type'] === 'Identification'): ?>
                            <input type="text" name="responses[<?php echo $question['question_id']; ?>]" placeholder="Your answer" class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-200 ease-in-out">
                Submit Quiz
            </button>
        </form>
    </div>

    <script>
    const totalQuestions = <?php echo count($questions); ?>;
    const progressBar = document.getElementById('progressBar');
    const progressPercentage = document.getElementById('progressPercentage');

    document.querySelectorAll('input[type="radio"], input[type="text"]').forEach(input => {
        input.addEventListener('input', updateProgressBar);
    });

    function updateProgressBar() {
        const answeredQuestions = [...document.querySelectorAll('.question-container')].filter(container => {
            const radios = container.querySelectorAll('input[type="radio"]');
            const textInput = container.querySelector('input[type="text"]');
            return (
                [...radios].some(radio => radio.checked) || 
                (textInput && textInput.value.trim() !== '')
            );
        }).length;

        const progress = Math.round((answeredQuestions / totalQuestions) * 100);
        
        progressBar.style.width = progress + '%';
        progressPercentage.textContent = progress + '%';
    }

    // Form validation before submission
    const quizForm = document.getElementById('quizForm');
    quizForm.addEventListener('submit', function(event) {
        const unansweredQuestions = [...document.querySelectorAll('.question-container')].filter(container => {
            const radios = container.querySelectorAll('input[type="radio"]');
            const textInput = container.querySelector('input[type="text"]');
            return !([...radios].some(radio => radio.checked) || (textInput && textInput.value.trim() !== ''));
        });

        if (unansweredQuestions.length > 0) {
            alert("Please answer all the questions before submitting the quiz.");
            event.preventDefault();
        }
    });
    </script>

</body>
</html>
