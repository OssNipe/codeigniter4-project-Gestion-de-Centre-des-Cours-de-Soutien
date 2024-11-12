<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/form', 'FormController::index', ['filter' => 'session']);

$routes->post('form/submit', 'FormController::submit');
$routes->get('/student/create', 'StudentController::create', ['filter' => 'session']);
$routes->post('/student/store', 'StudentController::store', ['filter' => 'session']);
$routes->get('/students/manage', 'StudentController::manageStudents', ['filter' => 'session']);
$routes->get('/student/edit/(:num)', 'StudentController::edit/$1',['filter' => 'session']);
$routes->post('/student/update/(:num)', 'StudentController::update/$1',['filter' => 'session']);
$routes->get('/student/delete/(:num)', 'StudentController::delete/$1',['filter' => 'session']);

$routes->get('student/profile/(:num)', 'StudentController::profile/$1',['filter' => 'session']);
$routes->get('student/printCard/(:num)', 'StudentController::printCard/$1',['filter' => 'session']);

$routes->get('/course/create', 'CourseController::create', ['filter' => 'session']);
$routes->post('/course/store', 'CourseController::store', ['filter' => 'session']);
$routes->get('/courses/manage', 'CourseController::manageCourses', ['filter' => 'session']);
$routes->get('/course/edit/(:num)', 'CourseController::edit/$1',['filter' => 'session']);
$routes->post('/course/update/(:num)', 'CourseController::update/$1',['filter' => 'session']);
$routes->get('/course/delete/(:num)', 'CourseController::delete/$1',['filter' => 'session']);
service('auth')->routes($routes);



