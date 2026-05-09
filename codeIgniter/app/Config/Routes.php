<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\AuthController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::showLoginForm');
$routes->get('/login', 'AuthController::showLoginForm');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::showRegisterForm');
$routes->post('/register', 'AuthController::register');
$routes->get('/register/health', 'AuthController::showHealthForm');
$routes->post('/register/health', 'AuthController::createAccount');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/portemonaie/recharge', 'PorteMonaieController::showRechargeForm');
$routes->post('/portemonaie/recharge', 'PorteMonaieController::rechargeByCode');
$routes->get('/api/solde', 'PorteMonaieController::getSoldeAjax');

$routes->get('/regime', 'RegimeController::index');
$routes->get('/regime/objectifs', 'RegimeController::getObjectifs');

$routes->post('/regime/list', 'RegimeController::showRegimeList');
$routes->get('/regime/list', 'RegimeController::showRegimeList');
$routes->post('/regime/recommendations', 'RegimeController::showRegimeRecommendations');
$routes->get('/regime/imc', 'RegimeController::showIMCPage');
$routes->get('/regime/recommendations/ajax', 'RegimeController::getRecommendationsAjax');

$routes->group('admin', ['filter' => 'role:admin'], function($routes){
	$routes->get('', 'Admin\\DashboardController::index');
	$routes->get('activite', 'Admin\\ActiviteController::index');
	$routes->get('activite/create', 'Admin\\ActiviteController::create');
	$routes->post('activite/store', 'Admin\\ActiviteController::store');
	$routes->get('activite/edit/(:num)', 'Admin\\ActiviteController::edit/$1');
	$routes->post('activite/update/(:num)', 'Admin\\ActiviteController::update/$1');
	$routes->post('activite/delete/(:num)', 'Admin\\ActiviteController::delete/$1');

	$routes->get('regime', 'Admin\\RegimeAdminController::index');
	$routes->get('regime/create', 'Admin\\RegimeAdminController::create');
	$routes->post('regime/store', 'Admin\\RegimeAdminController::store');
	$routes->get('regime/edit/(:num)', 'Admin\\RegimeAdminController::edit/$1');
	$routes->post('regime/update/(:num)', 'Admin\\RegimeAdminController::update/$1');
	$routes->post('regime/delete/(:num)', 'Admin\\RegimeAdminController::delete/$1');
});