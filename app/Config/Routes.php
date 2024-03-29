<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('admin_prov', function ($routes) {
    $routes->get("dashboard", "AdminProv::index", ['filter' => 'authGuard']);
    $routes->get("data_kabupaten", "AdminProv::data_kabupaten", ['filter' => 'authGuard']);
    $routes->post("add_kabupaten", "AdminProv::add_kabupaten", ['filter' => 'authGuard']);
    $routes->delete("delete_kabupaten/(:any)", "AdminProv::delete_kabupaten/$1", ['filter' => 'authGuard']);
    $routes->put("edit_kabupaten/(:any)", "AdminProv::edit_kabupaten/$1", ['filter' => 'authGuard']);
});
$routes->group("admin_kab", function ($routes) {
    $routes->get("dashboard", "AdminKab::index", ['filter' => 'authGuard']);
    $routes->get("data_peternak", "AdminKab::data_peternak", ['filter' => 'authGuard']);
    $routes->post("add_peternak", "AdminKab::add_peternak", ['filter' => 'authGuard']);
    $routes->delete("delete_peternak/(:any)", "AdminKab::delete_peternak/$1", ['filter' => 'authGuard']);
    $routes->put("edit_peternak/(:any)", "AdminKab::edit_peternak/$1", ['filter' => 'authGuard']);
    $routes->get("data_vaksin", "AdminKab::data_vaksin", ['filter' => 'authGuard']);
    $routes->post("add_vaksin", "AdminKab::add_vaksin", ['filter' => 'authGuard']);
    $routes->delete("delete_vaksin/(:any)", "AdminKab::delete_vaksin/$1", ['filter' => 'authGuard']);
    $routes->put("edit_vaksin/(:any)", "AdminKab::edit_vaksin/$1", ['filter' => 'authGuard']);
    $routes->match(["post", "put"], "input_jadwal/(:any)", "AdminKab::input_jadwal/$1", ['filter' => 'authGuard']);
    $routes->get("data_jadwal_vaksin/detail/(:any)", "AdminKab::data_jadwal_vaksin_detail/$1", ['filter' => 'authGuard']);
    $routes->get("data_jadwal_vaksin", "AdminKab::data_jadwal_vaksin", ['filter' => 'authGuard']);
    $routes->get("data_dokumentasi", "AdminKab::data_dokumentasi", ['filter' => 'authGuard']);
});
$routes->get("login", "Auth::login");
$routes->post("save_auth", "Auth::save_auth");
