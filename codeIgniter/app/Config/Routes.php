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
