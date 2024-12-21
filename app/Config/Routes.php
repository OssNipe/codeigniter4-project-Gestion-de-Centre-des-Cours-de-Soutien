<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/form', 'FormController::index');

$routes->post('form/submit', 'FormController::submit');

$routes->get('logout', 'AuthController::logout', ['as' => 'logout']);
$routes->group('', ['filter' => 'group:admin'], static function ($routes) {
    $routes->get('/course/create', 'CourseController::create');
    $routes->get('/student/create', 'StudentController::create');
    $routes->get('/announcement/create', 'AnnouncementController::create');
    $routes->get('/announcements/manage', 'AnnouncementController::manageAnnouncements');
    $routes->get('/announcement/edit/(:num)', 'AnnouncementController::edit/$1');
    $routes->post('/announcement/update/(:num)', 'AnnouncementController::update/$1');
    $routes->get('/announcement/delete/(:num)', 'AnnouncementController::delete/$1');
    
$routes->post('/student/store', 'StudentController::store');
$routes->post('/announcement/store', 'AnnouncementController::store');
$routes->get('/students/manage', 'StudentController::manageStudents');
$routes->get('/student/edit/(:num)', 'StudentController::edit/$1');
$routes->post('/student/update/(:num)', 'StudentController::update/$1');
$routes->get('/student/delete/(:num)', 'StudentController::delete/$1');

$routes->get('student/profile/(:num)', 'StudentController::profile/$1');
$routes->get('student/printCard/(:num)', 'StudentController::printCard/$1');

//$routes->get('/course/create', 'CourseController::create');
$routes->post('/course/store', 'CourseController::store');
$routes->get('/courses/manage', 'CourseController::manageCourses');
$routes->get('/course/edit/(:num)', 'CourseController::edit/$1');
$routes->post('/course/update/(:num)', 'CourseController::update/$1');
$routes->get('/course/delete/(:num)', 'CourseController::delete/$1');
$routes->get('/student/renew', 'StudentController::renew');
$routes->get('/enrollment/add/(:num)', 'EnrollmentController::addEnrollment/$1');
$routes->post('/enrollment/storeEnrollment', 'EnrollmentController::storeEnrollment');
// In Routes.php
$routes->get('/enrollment/renew/(:num)', 'EnrollmentController::renew/$1');
$routes->post('/enrollment/renew/(:num)', 'EnrollmentController::storeRenewal/$1');
$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/report/membership', 'ReportController::membershipReport');
$routes->post('/report/generate', 'ReportController::generateReport');

$routes->get('revenue', 'ReportController::revenuReport');
$routes->post('revenue/generate', 'ReportController::generateRevenueReport');

$routes->get('settings', 'SettingsController::index');
$routes->post('settings/update', 'SettingsController::update');

   
});
$routes->get('add-user-groups', 'UserController::addUserToGroups');

service('auth')->routes($routes);



