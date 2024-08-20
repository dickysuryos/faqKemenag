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