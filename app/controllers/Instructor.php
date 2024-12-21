<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Instructor extends Controller {

    public function __construct() {
        parent::__construct(); 

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $panel = $_GET['panel'] ?? 'default'; 

        if (!isset($_SESSION['user']['user_id'])) {
            die('User not logged in.');
        }

        $instructor_id = $_SESSION['user']['user_id'];

        $this->call->model('instructor_model');
        $courses = $this->instructor_model->get_courses_by_instructor($instructor_id);

        $data = [
            'courses' => $courses,
            
        ];

            $this->call->view('/instructor/main', $data);
    }

    public function getInstructorAssignments() {
        if (!isset($_SESSION['user']['user_id'])) {
            die('User not logged in.');
        }
    
        $course_id = $_GET['course_id'] ?? null;
        
        if (!$course_id) {
            die('Course ID is required.');
        }
    
        $this->call->model('instructor_model');
        $assignments = $this->instructor_model->get_all_assignment_instructor($course_id);
    
        $quizzes = $this->instructor_model->fetchQuizzesByCourse($course_id);
        $data = [
            'assignments' => $assignments,
            'quizzes' => $quizzes
        ];
    
        $this->call->view('/instructor/assignments', $data);
    }
    
    public function getQuizDetails() {
        
        $quiz_id = $_GET['quiz_id'] ?? null;
        $this->call->model('instructor_model');
        $quizDetails = $this->instructor_model->getQuizDetails($quiz_id);
        $data = [
            'quizDetails' => $quizDetails
        ];

        $this->call->view('/instructor/quiz-result', $data);
    }
    

    public function getDiscussion() {
        
        $instructor_id = $_SESSION['user']['user_id'];

        $this->call->model('instructor_model');
        $courses = $this->instructor_model->get_courses_by_instructor($instructor_id);
        $discussions = $this->instructor_model->get_discussions_by_instructor($instructor_id);
        $assignments = $this->instructor_model->get_assignments_by_instructor($instructor_id);

        $data = [
            'courses' => $courses,
            'discussions' => $discussions,
            'assignments' => $assignments,
            
        ];

        $this->call->view('/instructor/panel/classroom-discussion', $data);

    }

    public function getAnalytics() {
        $instructor_id = $_SESSION['user']['user_id'];

        $this->call->model('instructor_model');
        $totalCourses = $this->instructor_model->get_total_courses_by_instructor($instructor_id);
        $studentsEnrolled = $this->instructor_model->get_total_students_enrolled_by_instructor($instructor_id);
        $pendingAssignments = $this->instructor_model->get_pending_assignments_by_instructor($instructor_id);
        $getAllCourses = $this->instructor_model->getAllCourses($instructor_id);
    
        $datas = [
            'totalCourses' => $totalCourses,
            'studentsEnrolled' => $studentsEnrolled,
            'pendingAssignments' => $pendingAssignments,
            'getAllCourses' => $getAllCourses
        ];
    
        $this->call->view('/instructor/panel/analytics', $datas);
    }
    
    public function addCourse() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $course_code = $_POST['course_code'];

            if (!isset($_SESSION['user']['user_id'])) {
                die('User not logged in.');
            }

            $instructor_id = $_SESSION['user']['user_id']; 

            $this->call->model('instructor_model');

            if ($this->instructor_model->course_code_exists($course_code)) {
                echo "<script>alert('Course code already exists. Please use a different code.');</script>";
                return;
            }

            $this->instructor_model->add_course($title, $description, $course_code, $instructor_id);

            echo "<script>alert('Course added successfully!');</script>";
            header('Location: /course-pilot/instructor');
            exit;
        }

        $this->call->view('/instructor/add_course');
    }

    public function get_create_assignment() {
        $instructor_id = $_SESSION['user']['user_id'];

        $this->call->model('instructor_model');
        $courses = $this->instructor_model->get_courses_by_instructor($instructor_id);
        $assignments = $this->instructor_model->get_assignments_by_instructor($instructor_id);
        $data = [
            'courses' => $courses,
            'assignments' => $assignments
            
        ];

        $this->call->view('/instructor/panel/assignments', $data);

    }    

    public function create_assignment() {
        if (!isset($_SESSION['user']['user_id'])) {
            die('User not logged in.');
        }

        $this->call->model('instructor_model');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_id = $_POST['course_id'];
            $assignment_name = $_POST['assignment_name'];
            $due_date = $_POST['due_date'];
            $total_marks = $_POST['total_marks'];
            $description = $_POST['description'];

            $this->call->model('instructor_model');
            $this->instructor_model->add_assignment($course_id, $assignment_name, $description, $due_date, $total_marks);
            echo "<script>
            alert('Assignment Added Successfully!');
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/create-assignment';
            }, 200); // Redirect after 200ms
          </script>";
            exit;
        }

        $data = ['courses' => $courses];
        $this->call->view('/instructor/panel/assignments', $data);
    }

    public function create_discussion() {
        if (!isset($_SESSION['user']['user_id'])) {
            die('User not logged in.');
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_id = $_POST['course_id'];
            $discussion_title = $_POST['discussion_title'];
            $discussion_content = $_POST['discussion_content'];
            $user_id = $_SESSION['user']['user_id'];
    
            if (empty($course_id) || empty($discussion_title) || empty($discussion_content)) {
                die('All fields are required.');
            }
    
            $this->call->model('instructor_model');
            $this->instructor_model->create_discussion($course_id, $discussion_title, $discussion_content, $user_id);
            echo "<script>
            alert('Discussion Created Successfully!');
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/classroom-discussion';
            }, 200); // Redirect after 200ms
          </script>";
            exit;
        }
    }
    

    public function edit_discussion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $discussion_id = $_POST['discussion_id'];
            $discussion_title = $_POST['discussion_title'];
            $discussion_content = $_POST['discussion_content'];
    
            if (empty($discussion_id) || empty($discussion_title) || empty($discussion_content)) {
                die('All fields are required.');
            }
    
            $this->call->model('instructor_model');
            $this->instructor_model->update_discussion($discussion_id, $discussion_title, $discussion_content);
    
            echo "<script>
            alert('Discussion updated successfully!');
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/classroom-discussion';
            }, 200); // Redirect after 200ms
          </script>";

            exit;
        }
    }
    
    public function edit_assignment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignment_id = $_POST['assignment_id'];
            $title = $_POST['edit_title'];
            $description = $_POST['edit_description'];
            $total_marks = $_POST['edit_total_marks'];
            $due_date = $_POST['edit_due_date'];
    
            if (empty($assignment_id) || empty($title) || empty($description) || empty($total_marks)) {
                die('All fields are required.');
            }
    
            $this->call->model('instructor_model');
            $this->instructor_model->update_assignment($assignment_id, $title, $description, $due_date, $total_marks);
            echo "<script>
            alert('Edited Successfully!');
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/create-assignment';
            }, 200);
          </script>";
            exit;
        }
    }
    
    public function delete_assignment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignment_id = $_POST['assignment_id'];
    
            if (empty($assignment_id)) {
                die('Assignment ID is required.');
            }
    
            $this->call->model('instructor_model');
            $this->instructor_model->delete_assignment($assignment_id);
            echo "<script>
            alert('Deleted Successfully!');
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/create-assignment';
            }, 200); // Redirect after 200ms
          </script>";
            exit;
        }
    }

    
    public function get_dashboard_stats() {
            
    }

    
    public function getQuiz () {
        if (!isset($_SESSION['user']['user_id'])) {
            header("Location: /login");
            exit;
        }
        $instructor_id = $_SESSION['user']['user_id'];

        
        $this->call->model('instructor_model');
        $courses = $this->instructor_model->get_courses_by_instructor($instructor_id);

        $data = [
            'courses' => $courses
        ];

        $this->call->view('/instructor/panel/quiz', $data);

    }   

    public function createQuiz() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $course_id = intval($_POST['course_id']);
            $deadline = htmlspecialchars($_POST['deadline']);
            $questions = $_POST['questions'] ?? [];
    
            if (empty($title) || empty($course_id) || empty($deadline)) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
                exit;
            }
    
            $this->call->model('instructor_model');
    
            $this->db->transaction();
    
            try {
                $quiz_id = $this->instructor_model->createQuiz($title, $course_id, $deadline);
                foreach ($questions as $question) {
                    $question_title = $question['question_title'] ?? null;
                    $question_type = $question['question_type'] ?? null;
                    $correct_answer = $question['correct_answer'] ?? null;
                    $options = $question['options'] ?? [];
    
                    if (!$question_title || !$question_type || !$correct_answer) {
                        throw new Exception('Incomplete question data.');
                    }
    
                    $this->instructor_model->createQuestion($quiz_id, $question_title, $question_type, $correct_answer, $options);
                }

                $this->db->commit();
                http_response_code(201);
                    echo "<script>
                    alert('Quiz Created Successfully!');
                    setTimeout(function() {
                        window.location.href = '/course-pilot/instructor/quiz';
                    }, 200);
                </script>";
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
    
    
    
    public function getAnnouncement() {
        if (!isset($_SESSION['user']['user_id'])) {
            header("Location: /login");
            exit;
        }
        $instructor_id = $_SESSION['user']['user_id'];
        $this->call->model('instructor_model');
    
        $discussions = $this->instructor_model->getDiscussionsByInstructor($instructor_id);
        $data = [
            'discussions' => $discussions
        ];
    
        $this->call->view('/instructor/panel/announcement', $data);
    }
    
    public function createPost() {
        if (!isset($_SESSION['user']['user_id'])) {
            header("Location: /login");
            exit;
        }
    
        $user_id = $_SESSION['user']['user_id'];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $discussion_id = $_POST['discussion_id'] ?? null;
            $content = $_POST['content'] ?? null;
    
            if (empty($discussion_id) || empty($content)) {
                $error = "Both discussion and content are required.";
                $this->call->view('/instructor/panel/announcement', ['error' => $error]);
                return;
            }
    
            $this->call->model('instructor_model');
            
            $success = $this->instructor_model->addPost($discussion_id, $user_id, $content);
    
            echo "<script>
            alert('Post Added Successfully!');
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/quiz';
            }, 200);
          </script>";
        } else {
            $this->call->model('instructor_model');
            $discussions = $this->instructor_model->getDiscussionsByInstructor($user_id);
            $this->call->view('/instructor/panel/announcement', ['discussions' => $discussions]);
        }
    }
    
    public function getCourse () {
        $this->call->view('/instructor/course-management/add-new-course');
    }

        public function getAssignmentDetails() {
            $assignment_id = isset($_GET['assignment_id']) ? $_GET['assignment_id'] : null;
            $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
            
            if (!$assignment_id || !$course_id) {
                echo "Assignment ID and Course ID are required.";
                return;
            }
            $this->call->model('instructor_model');
        
            $assignment = $this->instructor_model->fetchAssignmentById($assignment_id);
        
            $users = $this->instructor_model->fetchAssignmentByCourse($assignment_id, $course_id);
        
            if (!$assignment) {
                echo "Assignment not found.";
                return;
            }
            foreach ($users as &$user) {
                $submission = $this->instructor_model->checkUserSubmission($assignment_id, $user['user_id']);
                
                $user['is_graded'] = !empty($submission['grade']) ? true : false;

                if ($user['is_graded']) {
                    $user['grade'] = $submission['grade'];
                } else {
                    $user['grade'] = null; 
                }
            }
        
            $this->call->view('/instructor/assignment-details', ['assignment' => $assignment, 'users' => $users]);
        }
       
        public function createSubmission() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_POST['user_id'];
                $assignment_id = $_POST['assignment_id'];
                $grade = $_POST['grade'];
                $feedback = $_POST['feedback'];
                if (empty($user_id) || empty($assignment_id) || empty($grade)) {
                    echo "Invalid input. All fields are required.";
                    return;
                }
        
                $this->call->model('instructor_model');
                $result = $this->instructor_model->createSubmission($user_id, $assignment_id, $grade, $feedback);
        
                echo "<script>
                alert('Submission Submitted Successfully!');
                setTimeout(function() {
                    window.location.href = '/course-pilot/instructor/';
                }, 200);
            </script>";
            } else {
                echo "Invalid request method.";
            }
        }
        
        public function viewStudentProgress() {
            $courseId = $_GET['course_id']; 

            $this->call->model('instructor_model');
            $course = $this->instructor_model->getCourseById($courseId);
            $students = $this->instructor_model->getStudentProgressByCourse($courseId);
            var_dump($students);
            $this->call->view('/instructor/panel/view-progress', ['students' => $students, 'course' => $course]);
        }

        public function getResource() {
            $instructor_id = $_SESSION['user']['user_id'];

             $this->call->model('instructor_model');
                $courses = $this->instructor_model->get_courses_by_instructor($instructor_id);
                $discussions = $this->instructor_model->get_discussions_by_instructor($instructor_id);
                $assignments = $this->instructor_model->get_assignments_by_instructor($instructor_id);

                $data = [
                    'courses' => $courses
                    
                ];
            $this->call->view('/instructor/panel/resource-library', $data);
        }

    public function viewCourseProgress() {
        if (!isset($_SESSION['user']['user_id'])) {
            die('User not logged in.');
        }

        $instructor_id = $_SESSION['user']['user_id'];

        $this->call->model('instructor_model');
        $courses = $this->instructor_model->get_courses_by_instructor($instructor_id);

        $data = [
            'courses' => $courses,
        ];

        $this->call->view('/instructor/panel/course-progress', $data);
    }

    public function addResource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_id = $_POST['course_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $file = $_FILES['file'];
    
            if (empty($course_id) || empty($title) || empty($description) || empty($file['name'])) {
                echo "Invalid input. All fields are required.";
                return;
            }
    
            $upload_dir = './uploads/resources/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
    
            $file_name = time() . '_' . basename($file['name']);
            $file_path = $upload_dir . $file_name;
    
            if (!move_uploaded_file($file['tmp_name'], $file_path)) {
                echo "Failed to upload the file.";
                return;
            }
    
            $file_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($file_path, './');
    
            $this->call->model('instructor_model');
            $result = $this->instructor_model->add_resource($course_id, $title, $description, $file_url);
    
            echo "<script>
            alert(`Resources {$title} For Added Successfully!`);
            setTimeout(function() {
                window.location.href = '/course-pilot/instructor/resource-library';
            }, 200);
          </script>";
        } else {
            echo "Invalid request method.";
        }
    }
    
    
}
?>
