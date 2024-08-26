<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/faq', 'Faq::index');
$routes->get('faqs', 'FaqController::index');
$routes->get('faqs/create', 'FaqController::create');
$routes->post('faqs/store', 'FaqController::store');
$routes->get('faqs/edit/(:num)', 'FaqController::edit/$1');
$routes->post('faqs/update/(:num)', 'FaqController::update/$1');
$routes->get('faqs/delete/(:num)', 'FaqController::delete/$1');
$routes->get('faq/search', 'Faq::search');
$routes->get('/pdf', 'PdfController::index');
$routes->post('/pdf/upload', 'PdfController::upload');
// Auth
$routes->get('/auth', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/store', 'Auth::store');

// Define routes for different user roles
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'auth:admin']);
$routes->get('/user/dashboard', 'User::dashboard', ['filter' => 'auth:user']);

