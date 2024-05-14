<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landingpage::index');
$routes->post('add_usulan', 'Landingpage::add_usulan');
$routes->get('distribusi_vaksin_detail/(:any)', 'Landingpage::jenis_vaksin/$1');
$routes->get('select_jenis_vaksin/(:any)', 'Landingpage::select_jenis_vaksin/$1');
$routes->group('admin_prov', function ($routes) {
    $routes->get("dashboard", "AdminProv::index", ['filter' => 'authGuard']);
    $routes->get("data_kabupaten", "AdminProv::data_kabupaten", ['filter' => 'authGuard']);
    $routes->post("add_kabupaten", "AdminProv::add_kabupaten", ['filter' => 'authGuard']);
    $routes->delete("delete_kabupaten/(:any)", "AdminProv::delete_kabupaten/$1", ['filter' => 'authGuard']);
    $routes->put("edit_kabupaten/(:any)", "AdminProv::edit_kabupaten/$1", ['filter' => 'authGuard']);
    $routes->post("add_jenis_vaksin", "AdminProv::add_jenis_vaksin", ['filter' => 'authGuard']);
    $routes->get("data_jenis_vaksin", "AdminProv::data_jenis_vaksin", ['filter' => 'authGuard']);
    $routes->get("detail_jenis_vaksin/(:any)", "AdminProv::detail_jenis_vaksin/$1", ['filter' => 'authGuard']);
    $routes->put("edit_jenis_vaksin/(:any)", "AdminProv::edit_jenis_vaksin/$1", ['filter' => 'authGuard']);
    $routes->delete("delete_jenis_vaksin/(:any)", "AdminProv::delete_jenis_vaksin/$1", ['filter' => 'authGuard']);
    $routes->get("data_distribusi_vaksin", "AdminProv::data_distribusi_vaksin", ['filter' => 'authGuard']);
    $routes->delete("delete_distribusi_vaksin/(:any)", "AdminProv::delete_distribusi_vaksin/$1", ['filter' => 'authGuard']);
    $routes->put("edit_distribusi_vaksin/(:any)", "AdminProv::edit_distribusi_vaksin/$1", ['filter' => 'authGuard']);
    $routes->get("detail_distribusi_vaksin/(:any)", "AdminProv::detail_distribusi_vaksin/$1", ['filter' => 'authGuard']);
    $routes->post("add_distribusi_vaksin", "AdminProv::add_distribusi_vaksin", ['filter' => 'authGuard']);
    $routes->get("laporan", "AdminProv::laporan", ['filter' => 'authGuard']);
    $routes->get("laporan_detail", "AdminProv::laporan_detail", ['filter' => 'authGuard']);
});
$routes->group("admin_kab", function ($routes) {
    $routes->get("dashboard", "AdminKab::index", ['filter' => 'authGuard']);
    $routes->get("data_peternak", "AdminKab::data_peternak", ['filter' => 'authGuard']);
    $routes->get("detail_peternak/(:any)", "AdminKab::detail_peternak/$1", ['filter' => 'authGuard']);
    $routes->get("select_usulan", "AdminKab::select_usulan", ['filter' => 'authGuard']);
    $routes->post("add_peternak", "AdminKab::add_peternak", ['filter' => 'authGuard']);
    $routes->put("edit_data_peternak/(:any)", "AdminKab::edit_data_peternak/$1", ['filter' => 'authGuard']);
    $routes->delete("delete_peternak/(:any)", "AdminKab::delete_peternak/$1", ['filter' => 'authGuard']);
    $routes->get("data_vaksin", "AdminKab::data_vaksin", ['filter' => 'authGuard']);
    $routes->post("add_vaksin", "AdminKab::add_vaksin", ['filter' => 'authGuard']);
    $routes->delete("delete_vaksin/(:any)", "AdminKab::delete_vaksin/$1", ['filter' => 'authGuard']);
    $routes->put("edit_vaksin/(:any)", "AdminKab::edit_vaksin/$1", ['filter' => 'authGuard']);
    $routes->post("input_jadwal", "AdminKab::input_jadwal", ['filter' => 'authGuard']);
    $routes->get("data_dokumentasi", "AdminKab::data_dokumentasi", ['filter' => 'authGuard']);
    $routes->get("detail_dokumentasi/(:any)", "AdminKab::detail_dokumentasi/$1", ['filter' => 'authGuard']);
    $routes->get("dokumentasi_items/(:any)", "AdminKab::dokumentasi_items/$1", ['filter' => 'authGuard']);
    $routes->post("add_dokumentasi2/(:any)", "AdminKab::add_dokumentasi2/$1", ['filter' => 'authGuard']);
    $routes->post("edit_dokumentasi/(:any)", "AdminKab::edit_dokumentasi/$1", ['filter' => 'authGuard']);
    $routes->delete("delete_dokumentasi/(:any)", "AdminKab::delete_dokumentasi/$1", ['filter' => 'authGuard']);
    $routes->get("data_dokumentasi/detail/(:any)", "AdminKab::data_dokumentasi_detail/$1", ['filter' => 'authGuard']);
    $routes->post("tambah_usulan", "AdminKab::tambah_usulan", ['filter' => 'authGuard']);
    $routes->get("jadwal_vaksin", "AdminKab::jadwal_vaksin", ['filter' => 'authGuard']);
    $routes->get("detail_jadwal_vaksin/(:any)", "AdminKab::detail_jadwal_vaksin/$1", ['filter' => 'authGuard']);
    $routes->post("add_jadwal_vaksin", "AdminKab::add_jadwal_vaksin", ['filter' => 'authGuard']);
    $routes->put("edit_jadwal_vaksin/(:any)", "AdminKab::edit_jadwal_vaksin/$1", ['filter' => 'authGuard']);
    $routes->delete("delete_jadwal_vaksin/(:any)", "AdminKab::delete_jadwal_vaksin/$1", ['filter' => 'authGuard']);
    $routes->get("daftar_peserta", "AdminKab::daftar_peserta", ['filter' => 'authGuard']);
    $routes->get("detail_daftar_peserta/(:any)", "AdminKab::detail_daftar_peserta/$1", ['filter' => 'authGuard']);
    $routes->get("data_peserta", "AdminKab::data_peserta", ['filter' => 'authGuard']);
    $routes->get("delete_peserta/(:any)", "AdminKab::delete_peserta/$1", ['filter' => 'authGuard']);
    $routes->get("detail_peserta/(:any)", "AdminKab::detail_peserta/$1", ['filter' => 'authGuard']);
    $routes->get("detail_peserta_edit", "AdminKab::detail_peserta_edit", ['filter' => 'authGuard']);
    $routes->post("edit_peserta/(:any)", "AdminKab::edit_peserta/$1", ['filter' => 'authGuard']);
    $routes->post("add_peserta", "AdminKab::add_peserta", ['filter' => 'authGuard']);
});
$routes->get("login", "Auth::login");
$routes->get("logout", "Auth::clear_login");
$routes->post("save_auth", "Auth::save_auth");
