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