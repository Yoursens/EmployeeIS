<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Landing Page ──────────────────────────────────────────────────────────────
$routes->get('/', 'LandingController::index');

// ── Auth Routes ───────────────────────────────────────────────────────────────
$routes->get( 'login',                     'AuthController::login');
$routes->post('login',                     'AuthController::loginProcess');   // fixed: was 'auth/login'
$routes->get( 'logout',                    'AuthController::logout');
$routes->get( 'register',                  'AuthController::register');
$routes->post('register',                  'AuthController::registerProcess'); // fixed: was 'auth/register'
$routes->get( 'forgot-password',           'AuthController::forgotPassword');
$routes->post('forgot-password',           'AuthController::forgotPasswordProcess'); // fixed
$routes->get( 'reset-password/(:segment)', 'AuthController::resetPassword/$1');
$routes->post('reset-password',            'AuthController::resetPasswordProcess'); // fixed

// ── Employee Routes (protected) ───────────────────────────────────────────────
$routes->get( 'employees',               'EmployeeController::index');
$routes->get( 'employees/create',        'EmployeeController::create');
$routes->post('employees/store',         'EmployeeController::store');
$routes->get( 'employees/view/(:num)',   'EmployeeController::view/$1');
$routes->get( 'employees/edit/(:num)',   'EmployeeController::edit/$1');
$routes->post('employees/update/(:num)', 'EmployeeController::update/$1');
$routes->get( 'employees/delete/(:num)', 'EmployeeController::delete/$1');