<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'Welcome::index');
$router->get('/get-user', 'Welcome::mode');

//user auth
$router->get('/register', 'User::register');
$router->get('/login', 'User::login');
$router->post('/register', 'User::register');
$router->post('/login', 'User::login');

$router->get('/register/instructor', 'User::registerAsInstructor');
$router->post('/register/instructor', 'User::registerAsInstructor');


//main-user-lms
$router->get('/course-pilot/user', 'User::content');
$router->post('/course-pilot/enroll', 'User::enroll');
$router->get('/course-pilot/user/courses', 'User::course');
$router->get('/course-pilot/course', 'User::courseDetail');
$router->get('/course-pilot/user/assignment', 'User::courseAssignment');
$router->get('/course-pilot/user/all-assignment', 'User::getAllAssignment');
$router->post('/course-pilot/user/submit-assignment', 'User::submitAssignment');
$router->get('/course-pilot/user/discussion', 'User::getDiscussionAndPost');
$router->post('/course-pilot/user/undo-turn-in', 'User::undoTurnIn');
$router->get('/course-pilot/user/quiz', 'User::getDisplayQuiz');
$router->post('/course-pilot/user/submit-quiz', 'User::submitQuiz');
//nav of user or learners
$router->get('/course-pilot/user/grades', 'User::getAllGrades');
$router->get('/course-pilot/user/all-courses', 'User::getAllCourses');
$router->get('/course-pilot/user/all-discussion', 'User::getAllDiscussion');
$router->get('/course-pilot/user/quiz-result', 'User::getQuizResults');


//instructor
$router->get('/course-pilot/instructor', 'Instructor::index');
$router->post('/course-pilot/instructor/add-course', 'Instructor::addCourse');
$router->post('/course-pilot/instructor/create-assignment', 'Instructor::create_assignment');
$router->get('/course-pilot/instructor/create-assignment', 'Instructor::get_create_assignment');
$router->post('/course-pilot/instructor/classroom-discussion', 'Instructor::create_discussion');
$router->post('/course-pilot/instructor/discussions/edit', 'Instructor::edit_discussion');
$router->post('/course-pilot/instructor/edit-assignment', 'Instructor::edit_assignment');
$router->post('/course-pilot/instructor/delete-assignment', 'Instructor::delete_assignment');
$router->get('/course-pilot/instructor/analytics', 'Instructor::getAnalytics');
$router->get('/course-pilot/instructor/classroom-discussion', 'Instructor::getDiscussion');
$router->get('/course-pilot/instructor/announcement', 'Instructor::getAnnouncement');
$router->get('/course-pilot/instructor/resource-library', 'Instructor::getResource');
$router->get('/course-pilot/instructor/courses', 'Instructor::getCourse');
$router->get('/course-pilot/instructor/quiz', 'Instructor::getQuiz');
$router->post('/course-pilot/instructor/create-quiz', 'Instructor::createQuiz');
$router->get('/course-pilot/instructor/assignments', 'Instructor::getInstructorAssignments');
$router->get('/course-pilot/instructor/student-progress', 'Instructor::viewStudentProgress');
$router->post('/course-pilot/instructor/create-post', 'Instructor::createPost');
$router->post('/course-pilot/instructor/create-submission', 'Instructor::createSubmission');
$router->get('/course-pilot/instructor/assignment-details/', 'Instructor::getAssignmentDetails');
$router->get('/course-pilot/instructor/quiz-details', 'Instructor::getQuizDetails');
//for pdf
$router->get('/course-pilot/instructor/uploads/assignments/(:fileName)', 'Instructor::getFileName');

$router->get('/course-pilot/instructor/course-progress', 'Instructor::viewCourseProgress');

$router->post('/course-pilot/instructor/create-resource', 'Instructor::addResource');


