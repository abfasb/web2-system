<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class user_model extends Model {

    public function __construct() {
        parent::__construct();
        $this->call->database(); 
    }

    public function register_user($username, $email, $password, $role) {
        $bind = array(
            'username' => $username,
            'email' => $email,
            'password' => $this->passwordhash($password),
            'role' => $role
        );

        $this->db->table('Users')->insert($bind);
    }

    public function get_user($username, $password) {

    $row = $this->db
                ->table('users')
                ->where('username', $username)
                ->get();


    if (is_array($row) && isset($row['password'])) {

        if (password_verify($password, $row['password'])) {
            return $row; 
        } else {
            echo "Password verification failed.<br>";
            return false;
        }
    }

    return false;
}

    private function passwordhash($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function get_course_id($course_code) {
        $row = $this->db
                    ->table('Courses')
                    ->select('course_id')
                    ->where('course_code', $course_code)
                    ->get();
        return $row ? $row['course_id'] : null;
    }

    public function enroll_user($user_id, $course_id) {
        $exists = $this->db
                       ->table('Enrollments')
                       ->where('user_id', $user_id)
                       ->where('course_id', $course_id)
                       ->get();
    
        if ($exists) {
            return false; 
        }
        $bind = [
            'user_id' => $user_id,
            'course_id' => $course_id,
        ];
        return $this->db->table('Enrollments')->insert($bind);
    }

    public function add_discussion($course_id, $title, $content, $created_by) {
        $bind = array(
            'course_id' => $course_id,
            'title' => $title,
            'content' => $content,
            'created_by' => $created_by,
            'created_at' => date('Y-m-d H:i:s')
        );

        return $this->db->table('Discussions')->insert($bind);
    }

    public function get_discussions_by_course($course_id) {
        return $this->db->table('Discussions')
                        ->select('Discussions.*, Users.username')
                        ->join('Users', 'Discussions.created_by = Users.user_id')
                        ->where('Discussions.course_id', $course_id)
                        ->get_all();
    }

    public function get_discussion($discussion_id) {
        return $this->db->table('Discussions')
                        ->select('Discussions.*, Users.username')
                        ->join('Users', 'Discussions.created_by = Users.user_id')
                        ->where('Discussions.discussion_id', $discussion_id)
                        ->get();
    }

    public function get_all_courses($user_id) {
        if (empty($user_id)) {
            return []; 
        }
    
        $data = $this->db->table('Courses c')
            ->left_join('Users u', 'c.instructor_id = u.user_id')
            ->left_join('Enrollments e', 'e.course_id = c.course_id AND e.user_id = ' . (int)$user_id)
            ->select('c.course_id, c.title, c.description, c.course_code, u.username AS instructor, c.created_at, c.updated_at, e.course_id AS is_enrolled')
            ->get_all();
    
        return $data;
    }
    
    public function is_enrolled($user_id, $course_id) {
        $result = $this->db->table('enrollments')
            ->where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->get(); 
    
        return $result ? true : false;
    }

    public function getCourseById($course_id) {
        $data = $this->db->table('Courses')
                         ->where('course_id', $course_id)
                         ->get(); 
    
        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    function getCourseData($course_id, $userId) {
        $this->call->database();
    
        $assignments = $this->db->table('Assignments')
            ->where('course_id', $course_id)
            ->where('due_date', '>', date('Y-m-d'))
            ->get_all();
    
            $sql = "
            SELECT q.*
            FROM Quizzes AS q
            LEFT JOIN quizattempts AS qa 
                ON q.quiz_id = qa.quiz_id AND qa.user_id = ?
            WHERE q.course_id = ?
            AND qa.quiz_id IS NULL
            AND (q.deadline IS NULL OR q.deadline > NOW())
        ";
        
        $quizzes = $this->db->raw($sql, [$userId, $course_id], PDO::FETCH_ASSOC)->fetchAll();

    
        $discussions = $this->db->table('Discussions')
            ->where('course_id', $course_id)
            ->get_all();
    
        $discussion_ids = array_map(function ($discussion) {
            return $discussion['discussion_id'];
        }, $discussions);
    
        $posts = [];
        if (!empty($discussion_ids)) {
            $posts = $this->db->table('Posts')
                ->in('discussion_id', $discussion_ids)
                ->get_all();
        }
    
        $resources = $this->db->table('ResourceLibrary')
            ->where('course_id', $course_id)
            ->get_all();

        $totalAssignments = count($assignments);

        if (empty($assignments)) {
            $completedAssignments = 0;
            $assignmentProgress = 0;
        } else {
            $sql3 = "SELECT COUNT(*) as total 
                    FROM AssignmentFiles 
                    WHERE user_id = ? 
                    AND status = 'submitted' 
                    AND assignment_id IN (" . implode(',', array_column($assignments, 'assignment_id')) . ")";
            
            $stmt = $this->db->raw($sql3, [$userId]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $completedAssignments = !empty($data) ? $data['total'] : 0;
            $assignmentProgress = ($totalAssignments > 0) ? ($completedAssignments / $totalAssignments) * 100 : 0;
        }
        

        $totalQuizzes = count($quizzes);

        if (empty($quizzes)) {
            $completedQuizzes = 0;
            $quizProgress = 0;
        } else {
            $sql2 = "SELECT COUNT(*) as total 
                    FROM quizattempts 
                    WHERE user_id = ? 
                    AND quiz_id IN (" . implode(',', array_column($quizzes, 'quiz_id')) . ")";
            
            $stmt2 = $this->db->raw($sql2, [$userId]);
            $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $completedQuizzes = !empty($data2) ? $data2['total'] : 0;
            $quizProgress = ($totalQuizzes > 0) ? ($completedQuizzes / $totalQuizzes) * 100 : 0;
        }

            
        return [
            'assignments' => $assignments,
            'quizzes' => $quizzes,
            'posts' => $posts,
            'resources' => $resources,
            'discussions' => $discussions,
            'assignmentProgress' => $assignmentProgress,
            'quizProgress' => $quizProgress
        ];
    }

    public function getAssignmentFile($assignment_id, $user_id) {
        $this->call->database();

        return $this->db->table('AssignmentFiles')
            ->where('assignment_id', $assignment_id)
            ->where('user_id', $user_id)
            ->get();
    }

    function getAssignmentById($assignment_id) {
        $this->call->database();
    
        return $this->db->table('Assignments')
            ->where('assignment_id', $assignment_id)
            ->get();
    }
    
    
    function saveAssignmentFile($fileData) {
        $this->call->database();
    
        $this->db->table('AssignmentFiles')
            ->insert([
                'assignment_id' => $fileData['assignment_id'],
                'user_id' => $fileData['user_id'],
                'file_name' => $fileData['file_name'],
                'file_path' => $fileData['file_path'],
                'status' => $fileData['status'], 
            ]);
    }
    
    function updateAssignmentFile($fileData) {
        $this->call->database();
    
        $this->db->table('AssignmentFiles')
            ->where('assignment_id', $fileData['assignment_id'])
            ->where('user_id', $fileData['user_id'])
            ->update([
                'file_name' => $fileData['file_name'],
                'file_path' => $fileData['file_path'],
                'status' => $fileData['status'],
            ]);
    }
    
    function undoAssignmentSubmission($assignment_id, $user_id) {
        $this->call->database();
    
        $this->db->table('AssignmentFiles')
            ->where('assignment_id', $assignment_id)
            ->where('user_id', $user_id)
            ->update([
                'status' => 'undone'
            ]);
    }

    function getAssignmentStatus($assignment_id, $user_id) {
        $this->call->database();

        return $this->db->table('AssignmentFiles')
            ->where('assignment_id', $assignment_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function getAllAssignmentsForUser($user_id) {
        $this->call->database();
    
        return $this->db->table('Assignments AS a')
                ->join('Courses AS c', 'a.course_id = c.course_id')
                ->join('Enrollments AS e', 'c.course_id = e.course_id')
                ->left_join('AssignmentFiles AS af', 'a.assignment_id = af.assignment_id AND af.user_id = e.user_id')
                ->where('e.user_id', $user_id)
                ->where('due_date', '>', date('Y-m-d'))
                ->select(
                    'a.assignment_id, 
                    a.title AS assignment_title, 
                    a.description, 
                    c.title AS course_title, 
                    c.course_code, 
                    a.total_marks, 
                    a.due_date, 
                    af.status AS submission_status'
                )
                ->get_all();
    }
    
    public function getDiscussionById($discussion_id) {
        $discussion = $this->db->table('Discussions d')
            ->join('Users u', 'd.created_by = u.user_id')
            ->select('d.*, u.username AS created_by_username')
            ->where('d.discussion_id', $discussion_id)
            ->get();
        
        return $discussion;
    }

    public function getPostsForDiscussion($discussion_id) {
        $posts = $this->db->table('Posts p')
                ->join('Users u', 'p.user_id = u.user_id')
                ->select('p.*, u.username AS posted_by_username')
                ->where('p.discussion_id', $discussion_id)
                ->order_by('p.posted_at', 'ASC')
                ->get_all();
        return $posts;
    }

    public function getEnrolledDiscussionsWithPosts($user_id) {
        $discussions = $this->db->table('Discussions d')
            ->join('Courses c', 'd.course_id = c.course_id')
            ->join('Enrollments e', 'e.course_id = c.course_id')
            ->join('Users u', 'd.created_by = u.user_id')
            ->select('d.*, u.username AS created_by_username, c.title AS course_title')
            ->where('e.user_id', $user_id)
            ->get_all();
    
        foreach ($discussions as &$discussion) {
            $posts = $this->db->table('Posts p')
                ->join('Users u', 'p.user_id = u.user_id')
                ->select('p.*, u.username AS posted_by_username')
                ->where('p.discussion_id', $discussion['discussion_id'])
                ->order_by('p.posted_at', 'ASC')
                ->get_all();
            $discussion['posts'] = $posts;
        }
    
        return $discussions;
    }
    
    public function getUserPastDueAssignmentsWithGrades($user_id) {
        $current_date = date('Y-m-d');
        $assignments = $this->db->table('Assignments a')
                    ->join('Courses c', 'a.course_id = c.course_id')
                    ->join('Enrollments e', 'e.course_id = c.course_id')
                    ->left_join('Submissions s', 's.assignment_id = a.assignment_id AND s.user_id = e.user_id')
                    ->select('a.assignment_id, a.title, a.due_date, s.grade, s.feedback, s.submitted_at, c.title AS course_title')
                    ->where('e.user_id', $user_id)
                    ->where('a.due_date', '<', $current_date)
                    ->order_by('a.due_date', 'DESC')
                    ->get_all();
        return $assignments;
    }
    
    public function getQuizById($quizId) {
        return $this->db->table('Quizzes')->where('quiz_id', $quizId)->get();
    }

    public function getQuestionsByQuizId($quizId) {
        return $this->db->table('Questions')->where('quiz_id', $quizId)->get_all();
    }

    public function getOptionsByQuestionIds($questions) {
        $mcQuestionIds = array_column(array_filter($questions, function($q) {
            return $q['question_type'] === 'Multiple-Choice';
        }), 'question_id');
        
        $optionsByQuestion = [];
        
        if (!empty($mcQuestionIds)) {
            foreach ($mcQuestionIds as $questionId) {
                $query = "SELECT * FROM Options WHERE question_id = ?";
                $stmt = $this->db->raw($query, [$questionId]);
                $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $optionsByQuestion[$questionId] = $options;
            }
        }
    
        return $optionsByQuestion;
    }
    
    
    public function getStudentResponses($quizId, $studentId) {
        return $this->db->table('Student_Responses')->where('quiz_id', $quizId)->where('student_id', $studentId)->get_all();
    }
    
    
    public function calculateScore($questions, $options, $studentResponses) {
        $score = 0;
    
        foreach ($studentResponses as $questionId => $responseText) {
            error_log("Processing response for question: $questionId -> $responseText");
    
            $question = array_filter($questions, function($q) use ($questionId) {
                return isset($q['question_id']) && $q['question_id'] == $questionId;
            });
            $question = reset($question);
    
            if ($question) {
                if ($question['question_type'] === 'Multiple-Choice') {
                    $studentAnswer = $responseText;
                    $correctOptionLabel = $question['correct_answer'];
                    
                    if (strcasecmp($correctOptionLabel, $studentAnswer) === 0) {
                        $score++;
                    }
                } elseif ($question['question_type'] === 'True/False') {
                    if (isset($question['correct_answer']) && 
                        strcasecmp($responseText, $question['correct_answer']) == 0) {
                        $score++;
                    }
                } elseif ($question['question_type'] === 'Identification') {
                    if (isset($question['correct_answer']) && 
                        strcasecmp($responseText, $question['correct_answer']) == 0) {
                        $score++;
                    }
                }
            } else {
                error_log("No matching question found for question ID: $questionId");
            }
        }
    
        return $score;
    }
    
    
    
    public function saveQuizResult($quizId, $studentId, $score) {
        $this->db->table('QuizResults')->where('quiz_id', $quizId)->where('user_id', $studentId)->update(['score' => $score]);
        if ($this->db->row_count() == 0) {
            $this->db->table('QuizResults')->insert(['quiz_id' => $quizId, 'user_id' => $studentId, 'score' => $score]);
        }
    }
    
    public function saveQuizAttempt($quizId, $userId) {
        $data = [
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'attempt_time' => date('Y-m-d H:i:s')
        ];
    
        $this->db->table('quizattempts')->insert($data);
    }
    
    
    public function checkQuizAttempt($quizId, $userId) {
        $result = $this->db->table('quizattempts')
                            ->select('1')
                            ->where('user_id', $userId)
                            ->where('quiz_id', $quizId)
                            ->get();
    
        return count($result) > 0;
    }
    
    public function check_if_user_exists($username, $email) {
        $where = [
            'username' => $username,
            'email' => $email
        ];
    
        $data = $this->db->table('users')->where($where)->get();
    
        return ($this->db->row_count() > 0);
    }
    
}
