<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/form', 'FormController::index');

$routes->post('form/submit', 'FormController::submit');
$routes->get('/student/create', 'StudentController::create');
$routes->post('/student/store', 'StudentController::store');
$routes->get('/students/manage', 'StudentController::manageStudents');
$routes->get('/student/edit/(:num)', 'StudentController::edit/$1');
$routes->post('/student/update/(:num)', 'StudentController::update/$1');
$routes->get('/student/delete/(:num)', 'StudentController::delete/$1');

$routes->get('student/profile/(:num)', 'StudentController::profile/$1');
$routes->get('student/printCard/(:num)', 'StudentController::printCard/$1');

$routes->get('/course/create', 'CourseController::create');
$routes->post('/course/store', 'CourseController::store');
$routes->get('/courses/manage', 'CourseController::manageCourses');
$routes->get('/course/edit/(:num)', 'CourseController::edit/$1');
$routes->post('/course/update/(:num)', 'CourseController::update/$1');
$routes->get('/course/delete/(:num)', 'CourseController::delete/$1');
service('auth')->routes($routes);



