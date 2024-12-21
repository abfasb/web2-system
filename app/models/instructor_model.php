<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class instructor_model extends Model {

    public function __construct() {
        parent::__construct();
        $this->call->database(); 
    }
    
    public function add_course($title, $description, $course_code, $instructor_id) {
        $bind = array(
            'title' => $title,
            'description' => $description,
            'course_code' => $course_code,
            'instructor_id' => $instructor_id,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s') 
        );

        $this->db->table('Courses')->insert($bind);
    }

    public function course_code_exists($course_code) {
        $query = $this->db->table('Courses')->where('course_code', $course_code)->get();
    
        return $query ? true : false;
    }

    public function get_courses_by_instructor($instructor_id) {
        return $this->db->table('Courses')
                        ->select('*')
                        ->where('instructor_id', $instructor_id)
                        ->order_by('created_at', 'DESC')
                        ->get_all();
    }

    public function get_all_assignment_instructor($course_id) {
        return $this->db->table('Assignments')
                        ->where('course_id', $course_id)
                        ->where('due_date', '>', date('Y-m-d'))
                        ->get_all();
    }

    public function add_assignment($course_id, $title, $description, $due_date, $total_marks) {
        $bind = array(
            'course_id' => $course_id,
            'title' => $title,
            'description' => $description,
            'total_marks' => $total_marks,
            'due_date' => $due_date,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->table('Assignments')->insert($bind);
    }

    public function create_discussion($course_id, $title, $content, $created_by) {
        $bind = array(
            'course_id' => $course_id,
            'title' => $title,
            'content' => $content,
            'created_by' => $created_by,
            'created_at' => date('Y-m-d H:i:s')
        );
    
        $this->db->table('Discussions')->insert($bind);
    }

    
    public function get_discussions_by_instructor($instructor_id) {
        return $this->db->table('Discussions')
                        ->select('Discussions.*, Courses.title as course_title')
                        ->join('Courses', 'Discussions.course_id = Courses.course_id')
                        ->where('Courses.instructor_id', $instructor_id)
                        ->order_by('Discussions.created_at', 'DESC')
                        ->get_all();
    }

    public function update_discussion($discussion_id, $title, $content) {
        $bind = array(
            'title' => $title,
            'content' => $content,
        );
    
        $this->db->table('Discussions')
                 ->where('discussion_id', $discussion_id)
                 ->update($bind);
    }
    
    public function update_assignment($assignment_id, $title, $description, $due_date, $total_marks) {
        $bind = array(
            'title' => $title,
            'description' => $description,
            'due_date' => $due_date,
            'total_marks' => $total_marks,
        );
    
        $this->db->table('Assignments')
                 ->where('assignment_id', $assignment_id)
                 ->update($bind);
    }
    
    public function delete_assignment($assignment_id) {
        $this->db->table('Assignments')
                 ->where('assignment_id', $assignment_id)
                 ->delete();
    }

    public function get_assignments_by_instructor($instructor_id) {
        $assignments = $this->db->table('Assignments as a')
            ->inner_join('Courses as c', 'a.course_id = c.course_id')
            ->select('a.assignment_id, 
                      a.title AS assignment_title, 
                      a.description AS assignment_description, 
                      a.total_marks, 
                      a.due_date, 
                      c.title AS course_title, 
                      c.course_code')
            ->where('c.instructor_id', $instructor_id)
            ->get_all();
    
        return $assignments;
    }
    
    public function get_total_courses_by_instructor($instructor_id) {
        $result = $this->db->table('Courses')
                           ->where('instructor_id', $instructor_id)
                           ->select_count('*', 'total_courses')
                           ->get();
        return $result;
    }
    
    public function get_total_students_enrolled_by_instructor($instructor_id) {
        $result = $this->db->table('Enrollments AS e')
                           ->join('Courses AS c', 'e.course_id = c.course_id')
                           ->where('c.instructor_id', $instructor_id)
                           ->select_count('DISTINCT e.user_id', 'total_students')
                           ->get();
        return $result;
    }
    
    public function get_pending_assignments_by_instructor($instructor_id) {
        $result = $this->db->table('Assignments AS a')
                           ->join('Courses AS c', 'a.course_id = c.course_id')
                           ->where('c.instructor_id', $instructor_id)
                           ->where('a.due_date', '>', date('Y-m-d'))
                           ->select_count('*', 'pending_assignments')
                           ->get();
        return $result;
    }
    

    public function getAllCourses($instructor_id) {
        return $this->db->table('Courses as c')
            ->select('c.course_id, c.title, c.created_at, COUNT(e.enrollment_id) AS students_enrolled, c.course_code')
            ->left_join('Enrollments as e', 'c.course_id = e.course_id')
            ->where('c.instructor_id', $instructor_id)
            ->group_by('c.course_id')
            ->get_all();
    }

    function getQuizIdByTitle($title) {
        $result = $this->db->table('Quizzes')
                           ->select('quiz_id')
                           ->where('title', $title)
                           ->get();
        
        return $result;
    }
    
    public function createQuiz($title, $course_id, $deadline) {
        $bind = [
            'title' => $title,
            'course_id' => $course_id,
            'deadline' => $deadline,
        ];
    
        $this->db->table('Quizzes')->insert($bind);
    
        $data = $this->db->raw("SELECT LAST_INSERT_ID() AS quiz_id", [], PDO::FETCH_ASSOC);
        foreach ($data as $row) {
            $quiz_id = $row['quiz_id'];
        }
    
        return $quiz_id;
    }
    
    
    public function createQuestion($quiz_id, $question_text, $question_type, $correct_answer, $options = []) {
        $bind = [
            'quiz_id' => $quiz_id,
            'question_text' => $question_text,
            'question_type' => $question_type,
            'correct_answer' => $correct_answer,
        ];
    
        $this->db->table('Questions')->insert($bind);
    
        $data = $this->db->raw("SELECT LAST_INSERT_ID() AS question_id", [], PDO::FETCH_ASSOC);
        foreach ($data as $row) {
            $question_id = $row['question_id'];
        }
    
        if ($question_type === 'Multiple-Choice') {
            $labels = ['A', 'B', 'C', 'D'];
            foreach ($labels as $label) {
                if (!empty($options[$label])) {
                    $is_correct = $label === $correct_answer;
                    $option_data = [
                        'question_id' => $question_id,
                        'option_label' => $label,
                        'option_text' => $options[$label],
                        'is_correct' => $is_correct,
                    ];
                    $this->db->table('Options')->insert($option_data);
                }
            }
        }
    }
    
    public function fetchQuizzesByCourse($course_id) {
        $this->db->table('Quizzes')
                 ->select('quiz_id, title, course_id, deadline, created_at')
                 ->where('course_id', $course_id);
    
        $query = $this->db->get_all();
    
        if (!empty($query)) {
            return $query;
        } else {
            return []; 
        }
    }
    
    public function getQuizDetails($quiz_id) {
        $data = $this->db->table('QuizResults as qr')
                         ->join('Users as u', 'qr.user_id = u.user_id')
                         ->join('Quizzes as q', 'qr.quiz_id = q.quiz_id')
                         ->where('qr.quiz_id', $quiz_id)
                         ->order_by('qr.completed_at', 'DESC')
                         ->select('u.username, q.title as quiz_title, qr.score, qr.completed_at')
                         ->get_all();
        
        return $data; 
    }
    
    

    public function getDiscussionsByInstructor($instructor_id) {
        return  $this->db->table('Discussions')
                ->where('created_by', $instructor_id)
                ->select('discussion_id, title AS discussion_title')
                ->get_all();    
    
    }
    
    public function addPost($discussion_id, $user_id, $content) {
        $data = [
            'discussion_id' => $discussion_id,
            'user_id' => $user_id,
            'content' => $content
        ];
    
        return $this->db->table('Posts')->insert($data);
    }
    
    public function fetchAssignmentByCourse($assignment_id, $course_id) {
        return $this->db->table('Enrollments e')
            ->join('Users u', 'e.user_id = u.user_id')
            ->left_join('AssignmentFiles af', 'af.user_id = u.user_id ')
            ->join('Assignments a', 'a.assignment_id = ' . $assignment_id)
            ->where(['e.course_id' => $course_id, 'af.assignment_id' => $assignment_id])
            ->get_all();
    }
    
    public function fetchAssignmentById($assignment_id) {
        return $this->db->table('Assignments a')
                ->where('a.assignment_id', $assignment_id)
                ->get();
    }

    public function createSubmission($user_id, $assignment_id, $grade, $feedback) {
        $data = [
            'user_id' => $user_id,
            'assignment_id' => $assignment_id,
            'grade' => $grade,
            'feedback' => $feedback,
            'graded_at' => date('Y-m-d H:i:s')
        ];
    
        return $this->db->table('Submissions')->insert($data);
    }
    
    public function checkUserSubmission($assignment_id, $user_id) {
        return $this->db->table('Submissions')->select('*')->where('assignment_id', $assignment_id)->where('user_id', $user_id)->get();

    }
    

    public function getStudentProgressByCourse($courseId) {
        $students = $this->db->table('Users u')
            ->join('Enrollments e', 'u.user_id = e.user_id')
            ->join('Courses c', 'e.course_id = c.course_id')
            ->left_join('Assignments a', 'c.course_id = a.course_id')
            ->left_join('AssignmentFiles af', 'af.assignment_id = a.assignment_id AND af.user_id = u.user_id')
            ->left_join('Quizzes q', 'c.course_id = q.course_id')
            ->left_join('QuizResults qr', 'qr.quiz_id = q.quiz_id AND qr.user_id = u.user_id')
            ->left_join('Questions qu', 'qu.quiz_id = q.quiz_id')  // Join Questions to get the max score per quiz
            ->select("
                u.username, 
                ROUND(SUM(CASE WHEN af.status = 'submitted' THEN 1 ELSE 0 END) / COUNT(a.assignment_id) * 100, 2) AS assignments,
                ROUND(
                    IFNULL(SUM(qr.score), 0) / (COUNT(DISTINCT qu.question_id) * 1) * 100, 
                    2
                ) AS quizzes
            ")
            ->where('u.role', 'Student')
            ->where('c.course_id', $courseId)
            ->group_by('u.user_id')
            ->get_all();
    
        return $students;
    }
    
    
    public function getCourseById($courseId) {
        return $this->db->table('Courses')
                        ->where('course_id', $courseId)
                        ->get();
    }
    

    
    public function add_resource($course_id, $title, $description, $file_url) {
        $bind = array(
            'course_id' => $course_id,
            'title' => $title,
            'description' => $description,
            'file_url' => $file_url,
            'uploaded_at' => date('Y-m-d H:i:s')
        );
    
        return $this->db->table('ResourceLibrary')->insert($bind);
    }
    
}
