<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {
	

    public function login() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $input_password = htmlspecialchars($_POST['password']);
    
            if (empty($username) || empty($input_password)) {
                echo "<script>
                alert('It cannot be empty.');
                window.history.back();
            </script>";
                exit;
            }

            $this->call->model('user_model');
    
            $user = $this->user_model->get_user($username, $input_password);
    
            if ($user) {
                    $_SESSION['user'] = [
                        'user_id' => $user['user_id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                    ];
                    
    
                    if ($user['role'] === 'Student') {
                        echo "<script>
                        alert('Successfully enrolled in the course.');
                        setTimeout(function() {
                            window.location.href = '/course-pilot/user';
                        }, 200); 
                    </script>";
                    } elseif ($user['role'] === 'Instructor') {
                        echo "<script>
                        alert('Successfully enrolled in the course.');
                        setTimeout(function() {
                            window.location.href = '/course-pilot/instructor';
                        }, 200); 
                    </script>";
                    } else {
                        header('Location: /');
                    }
                    exit;
            }
        } else {
            $this->call->view('/user/login');
        }
    }
    
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
    
            if (strlen($password) < 8) {
                echo "<script>
                    alert('Password must be at least 8 characters long.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[A-Z]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one uppercase letter.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[a-z]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one lowercase letter.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[0-9]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one number.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[\W]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one special character.');
                    window.history.back();
                </script>";
                exit;
            }
    
            $this->call->model('user_model');
            $this->user_model->register_user($username, $email, $password, 'Student');
            echo "<script>
                alert('Registered {$username} successfully!');
                setTimeout(function() {
                    window.location.href = '/login';
                }, 200);
            </script>";
        } else {
            $this->call->view('/user/register');
        }
    }
    

    
    public function content() {
        session_start();
        $user_id = $_SESSION['user']['user_id'] ?? null;
        $this->call->model('user_model');
        $courses = $this->user_model->get_all_courses($user_id);
        
        $this->call->view('/user-lms/main-user', ['courses' => $courses]);
    }
    
    public function registerAsInstructor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
    
            if (strlen($password) < 8) {
                echo "<script>
                    alert('Password must be at least 8 characters long.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[A-Z]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one uppercase letter.');
                    window.history.back();
                </script>";
                exit;
            }
    

            if (!preg_match('/[a-z]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one lowercase letter.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[0-9]/', $password)) {
                echo "<script>
                    alert('Password must contain at least one number.');
                    window.history.back();
                </script>";
                exit;
            }
    
            if (!preg_match('/[\W]/', $password)) { 
                echo "<script>
                    alert('Password must contain at least one special character.');
                    window.history.back();
                </script>";
                exit;
            }
    
            $this->call->model('user_model');
            $this->user_model->register_user($username, $email, $password, 'Instructor');
    
            echo "<script>
                alert('Registered Successfully!');
                setTimeout(function() {
                    window.location.href = '/login';
                }, 200);
            </script>";
        } else {
            $this->call->view('/user/instructor');
        }
    }
    
    public function enroll() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_code = htmlspecialchars($_POST['course_code']);
            $user_id = $_SESSION['user']['user_id'] ?? null;

            if (!$user_id) {
                echo "User not logged in.";
                return;
            }

            $this->call->model('user_model');
            $course_id = $this->user_model->get_course_id($course_code);

            if ($course_id) {
                $enrolled = $this->user_model->enroll_user($user_id, $course_id);

                if ($enrolled) {
                    echo "<script>
                        alert('Successfully enrolled in the course.');
                        setTimeout(function() {
                            window.location.href = '/course-pilot/user';
                        }, 200); 
                    </script>";
                } else {
                    echo "<script>
                        alert('Failed to enroll. You might already be enrolled.');
                        setTimeout(function() {
                            window.location.href = '/course-pilot/user';
                        }, 200);
                    </script>";
                }
                
            } else {
                echo "<script>
                alert('Invalid Course Code.');
                setTimeout(function() {
                    window.location.href = '/course-pilot/user';
                }, 200);
            </script>";
            }
        }
    }

    public function course() {
        $this->call->view('/user-lms/courses/course');
    }

    public function courseDetail() {
        session_start();
        $user_id = $_SESSION['user']['user_id'] ?? null;
        $course_id = $_GET['id'] ?? null;
        
        if ($course_id) {
            $this->call->model('user_model');
            $course = $this->user_model->getCourseById($course_id);
            $getCourseData = $this->user_model->getCourseData($course_id, $user_id);
            $this->call->view('/user-lms/courses/course', ['course' => $course, 'courseData' => $getCourseData]);
        } else {
            echo "Course not found.";
        }
    }


    public function courseAssignment() {
        session_start();
        $assignment_id = $_GET['assignment_id'] ?? null;
        $user_id = $_SESSION['user']['user_id'] ?? null;
        
        if ($assignment_id) {
            $this->call->model('user_model');
            $assignment = $this->user_model->getAssignmentById($assignment_id);
            $assignmentFileStatus = $this->user_model->getAssignmentStatus($assignment_id, $user_id);
            echo $this->call->view('/user-lms/assignments/assignment', ['assignmentData' => $assignment, 'fileStatus' => $assignmentFileStatus]);
        } else {
            echo "Assignment not found.";
        }
    }
    
    
    public function submitAssignment() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['submission_file'])) {
    
            $assignment_id = $_POST['assignment_id'];
            $user_id = $_SESSION['user']['user_id'] ?? null;
            $file = $_FILES['submission_file'];
    
            $this->call->model('user_model');
            $existingFile = $this->user_model->getAssignmentFile($assignment_id, $user_id);
    
            $upload_dir = './uploads/assignments/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
    
            $file_name = time() . '_' . basename($file['name']);
            $file_path = $upload_dir . $file_name;
    
            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $file_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($file_path, './');
    
                if ($existingFile) {
                    $this->user_model->updateAssignmentFile([
                        'assignment_id' => $assignment_id,
                        'user_id' => $user_id,
                        'file_name' => $file_name,
                        'file_path' => $file_url,
                        'status' => 'submitted'
                    ]);
                    echo "File updated successfully!";
                } else {
                    $this->user_model->saveAssignmentFile([
                        'assignment_id' => $assignment_id,
                        'user_id' => $user_id,
                        'file_name' => $file_name,
                        'file_path' => $file_url,
                        'status' => 'submitted'
                    ]);
                    echo "File submitted successfully!";
                }
            } else {
                echo "File upload failed.";
            }
        }
    }
    

    public function undoTurnIn() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->call->model('user_model');

            $assignment_id = $_POST['assignment_id'];
            $user_id = $_SESSION['user']['user_id'] ?? null;

            $this->user_model->undoAssignmentSubmission($assignment_id, $user_id);
            echo "Assignment submission undone!";
        }
    }
    

    public function getAllAssignment() {
        session_start();
    
        $user_id = $_SESSION['user']['user_id'] ?? null;
    
        if (!$user_id) {
            header("Location: /login");
            exit;
        }
    
        $this->call->model('user_model');
        $assignments = $this->user_model->getAllAssignmentsForUser($user_id);
        $this->call->view('/user-lms/assignments/MainAssignment', ['assignments' => $assignments]);
    }
    
    public function getAllGrades() {
        session_start();
    
        $user_id = $_SESSION['user']['user_id'] ?? null;
        $this->call->model('user_model');
    
        $assignments = $this->user_model->getUserPastDueAssignmentsWithGrades($user_id);
    
        $this->call->view('/user-lms/grades/grade', ['assignments' => $assignments]);
    }
    

    public function getAllCourses() {
        
        session_start();
        $user_id = $_SESSION['user']['user_id'] ?? null;
        $this->call->model('user_model');
        $courses = $this->user_model->get_all_courses($user_id);

        $this->call->view('/user-lms/courses/all-courses', ['courses' => $courses]);
    }

    public function getAllDiscussion() {
        
        session_start();
    
        $user_id = $_SESSION['user']['user_id'] ?? null;

        $model = $this->call->model('user_model');
        $discussions = $this->user_model->getEnrolledDiscussionsWithPosts($user_id);
        $this->call->view('/user-lms/discussion/getAllDiscussion', ['discussions' => $discussions]);
    }

    public function getDiscussionAndPost() {
         
            $discussion_id = $_GET['discussion_id'];
    
            $this->call->model('user_model');
    
            $discussion = $this->user_model->getDiscussionById($discussion_id);
    
            if (!$discussion) {
                echo "Discussion not found.";
                return;
            }
    
            $posts = $this->user_model->getPostsForDiscussion($discussion_id);
    
            $this->call->view('/user-lms/discussion-view', [
                'discussion' => $discussion,
                'posts' => $posts
            ]);
    }

    public function getDisplayQuiz() {
        $quizId = $_GET['quiz_id'] ?? null;
    
        if (!$quizId) {
            echo "Quiz ID is missing.";
            return;
        }
    
        $this->call->model('user_model');
    
        $quiz = $this->user_model->getQuizById($quizId);
    
        if (!$quiz) {
            echo "Quiz not found.";
            return;
        }
    
        $questions = $this->user_model->getQuestionsByQuizId($quizId);
    
        $options = $this->user_model->getOptionsByQuestionIds($questions);
    

        $data = [
            'quiz' => $quiz,
            'questions' => $questions,
            'options' => $options,
        ];
    
        $this->call->view('/user-lms/quiz', $data);
    }
    

        public function submitQuiz() {
            session_start();
            $user_id = $_SESSION['user']['user_id'] ?? null;

            $quizId = $_POST['quiz_id'] ?? null;
            $responses = $_POST['responses'] ?? [];
            
            var_dump($responses);
            if (!$quizId || empty($responses)) {
                echo "Quiz ID or responses missing.";
                return;
            }
            $this->call->model('user_model');
        
            $quiz = $this->user_model->getQuizById($quizId);
        
            if (!$quiz) {
                echo "Quiz not found.";
                return;
            }
        
            $questions = $this->user_model->getQuestionsByQuizId($quizId);
            $options = $this->user_model->getOptionsByQuestionIds($questions);
        
            $score = $this->user_model->calculateScore($questions, $options, $responses);
        
            $this->user_model->saveQuizResult($quizId, $user_id, $score);
            $this->user_model->saveQuizAttempt($quizId, $user_id);
        
            $_SESSION['quiz_result'] = [
                'quiz_id' => $quizId,
                'score' => $score,
                'total_questions' => count($questions)
            ];
            header('Location: /course-pilot/user/quiz-result');
        }
     
    public function getQuizResults() {
        $this->call->view('/user-lms/quiz-results');
        
    }
}
?>