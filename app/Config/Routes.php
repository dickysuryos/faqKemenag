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
$routes->get('faqs/searchFaq', 'FaqController::search');
$routes->get('faqs/getFaqByCat', 'FaqController::getFaqByCat');

$routes->get('/pdf', 'PdfController::index');
$routes->get('/pdf/allList', 'PdfController::allList');
$routes->post('/pdf/upload', 'PdfController::upload');
$routes->get('/pdf/delete/(:num)','PdfController::delete/$1');
$routes->get('pdf/edit/(:num)','PdfController::edit/$1');
$routes->get('pdf/detail/(:num)','PdfController::detail/$1');
$routes->post('pdf/update/(:num)','PdfController::update/$1');
$routes->get('/pdf/search', 'PdfController::search');

// Auth
$routes->get('/auth', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/store', 'Auth::store');

// Define routes for different user roles
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'auth:admin']);
$routes->get('/user/dashboard', 'User::dashboard', ['filter' => 'auth:user']);

// categories

$routes->get('/category/categories', 'CategoryController::index');
$routes->post('/category/update/(:num)', 'CategoryController::update/$1');
$routes->get('/category/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('/category/create', 'CategoryController::create');
$routes->get('/category/delete/(:num)', 'CategoryController::delete/$1');

// activity 

$routes->post('/activity/create_activity','UserActivityController::create_activity');