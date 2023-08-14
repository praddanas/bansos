<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

//$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->group('/', static function ($routes) {
    $routes->get('', 'User::index');
    $routes->get('cari_data', 'User::cari_data');
    $routes->get('informasi_bantuan', 'User::informasi_bantuan');
    $routes->get('informasi_pembagian', 'User::informasi_pembagian');
    $routes->get('tentang', 'User::tentang');
    $routes->get('data_cari', 'User::data_cari');
});



$routes->get('surveillance/edit_admin', 'Surveillance::edit_admin');




$routes->get('login', 'Login::index');
$routes->post('login', 'Login::process');
$routes->get('logout', 'Login::logout');

$routes->group('admin', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
    $routes->get('', 'AdminController::index');
    $routes->group('warga', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
        $routes->get('', 'WargaController::index');
        $routes->post('', 'WargaController::get_warga');
        $routes->post('get_desa', 'WargaController::get_desa');
        $routes->post('get_warga', 'WargaController::get_warga');
        $routes->post('get_desa_form', 'WargaController::get_desa_form');
        $routes->get('tambah', 'WargaController::tambah');
        $routes->post('tambah', 'WargaController::tambah');
        $routes->group('(:segment)', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
            $routes->get('detail', 'WargaController::detail/$1');
            $routes->get('edit', 'WargaController::edit/$1');
            $routes->post('edit', 'WargaController::edit/$1');
            $routes->post('delete', 'WargaController::delete/$1');
        });
    });
    $routes->group('kecamatan', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
        $routes->get('', 'KecamatanController::index');
        $routes->post('', 'KecamatanController::get_table');
        $routes->get('tambah', 'KecamatanController::tambah');
        $routes->post('tambah', 'KecamatanController::tambah');
        $routes->group('(:segment)', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
            $routes->get('edit', 'KecamatanController::edit/$1');
            $routes->post('edit', 'KecamatanController::edit/$1');
            $routes->post('delete', 'KecamatanController::delete/$1');
            $routes->group('desa', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
                $routes->get('', 'DesaController::index/$1');
                $routes->post('', 'DesaController::get_table/$1');
                $routes->get('tambah', 'DesaController::tambah/$1');
                $routes->post('tambah', 'DesaController::tambah/$1');
                $routes->group('(:segment)', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
                    $routes->get('edit', 'DesaController::edit/$1/$2');
                    $routes->post('edit', 'DesaController::edit/$1/$2');
                    $routes->post('delete', 'DesaController::delete/$1/$2');
                });
            });
        });
    });
    $routes->group('jenis_bansos', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
        $routes->get('', 'JenisBansosController::index');
        $routes->post('', 'JenisBansosController::get_table');
        $routes->get('tambah', 'JenisBansosController::tambah');
        $routes->post('tambah', 'JenisBansosController::tambah');
        $routes->group('(:segment)', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
            $routes->get('edit', 'JenisBansosController::edit/$1');
            $routes->post('edit', 'JenisBansosController::edit/$1');
            $routes->post('delete', 'JenisBansosController::delete/$1');
        });
    });
    $routes->group('data_bansos', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
        $routes->get('', 'DataBansosController::index');
        $routes->post('', 'DataBansosController::get_table');
        $routes->get('tambah', 'DataBansosController::tambah');
        $routes->post('tambah', 'DataBansosController::tambah');
        $routes->group('(:segment)', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
            $routes->get('edit', 'DataBansosController::edit/$1');
            $routes->post('edit', 'DataBansosController::edit/$1');
            $routes->post('delete', 'DataBansosController::delete/$1');
            $routes->group('warga', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
                $routes->get('', 'DataBansosWargaController::index/$1');
                $routes->post('', 'DataBansosWargaController::get_table/$1');
                $routes->group('(:segment)', ['filter' => 'auth:Admin', 'namespace' => "App\Controllers\Admin"], function ($routes) {
                    $routes->post('set_status', 'DataBansosWargaController::set_status/$1/$2');
                });
            });
        });
    });
});

$routes->group('surveillance', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
    $routes->get('', 'SurveillanceController::index');
    $routes->group('warga', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
        $routes->get('', 'WargaController::index');
        $routes->post('', 'WargaController::get_warga');
        $routes->post('get_warga', 'WargaController::get_warga');
        $routes->get('tambah', 'WargaController::tambah');
        $routes->post('tambah', 'WargaController::tambah');
        $routes->group('(:segment)', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
            $routes->get('detail', 'WargaController::detail/$1');
            $routes->get('edit', 'WargaController::edit/$1');
            $routes->post('edit', 'WargaController::edit/$1');
            $routes->post('delete', 'WargaController::delete/$1');
        });
    });
    $routes->group('data_bansos', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
        $routes->get('', 'DataBansosController::index');
        $routes->post('', 'DataBansosController::get_table');
        $routes->group('(:segment)', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
            $routes->group('warga', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
                $routes->get('', 'DataBansosWargaController::index/$1');
                $routes->post('', 'DataBansosWargaController::get_table/$1');
                $routes->get('tambah', 'DataBansosWargaController::tambah/$1');
                $routes->post('tambah', 'DataBansosWargaController::tambah/$1');
                $routes->post('cari', 'DataBansosWargaController::cari/$1');
                $routes->group('(:segment)', ['filter' => 'auth', 'namespace' => "App\Controllers\Surveillance"], function ($routes) {
                    $routes->post('delete', 'DataBansosWargaController::delete/$1/$2');
                });
            });
        });
    });
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
