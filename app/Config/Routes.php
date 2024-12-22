<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/baru', 'Baru::index');
$routes->get('/bio', 'Baru::biodata');
$routes->get('/pro', 'produk::index');
$routes->get('/detail', 'produk::detail');
