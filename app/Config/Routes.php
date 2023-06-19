<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
* --------------------------------------------------------------------
* Route Definitions
* --------------------------------------------------------------------
*/

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/home/index', 'Home::dashboard');
$routes->get('/', 'Home::dashboard');

$routes->group('admin', ['filter' => 'permission:manage-all'], static function ($routes) {
    // get
    $routes->get('index/(:any)', 'Admin::index');
    $routes->get('index', 'Admin::index');
    $routes->get('role/(:any)', 'Admin::role');
    $routes->get('role', 'Admin::role');
    $routes->get('role_perm/(:any)', 'Admin::role_perm');
    $routes->get('role_perm', 'Admin::role_perm');
    $routes->get('user/(:any)', 'Admin::user');
    $routes->get('user', 'Admin::user');
    $routes->get('utility/(:any)', 'Admin::utility');
    $routes->get('utility', 'Admin::utility');
    $routes->get('detail/(:any)', 'Admin::detail/$1');
    $routes->get('active_user/(:any)', 'Admin::active_user/$1');
    $routes->get('nonactive_user/(:any)', 'Admin::nonactive_user/$1');

    // post
    $routes->post('change_role/(:any)', 'Admin::change_role');
    $routes->post('change_role', 'Admin::change_role');
    $routes->post('add_role/(:any)', 'Admin::add_role');
    $routes->post('add_role', 'Admin::add_role');
    $routes->post('delete_role/(:any)', 'Admin::delete_role');
    $routes->post('delete_role', 'Admin::delete_role');
    $routes->post('change_role_perm/(:any)', 'Admin::change_role_perm');
    $routes->post('change_role_perm', 'Admin::change_role_perm');
    $routes->post('add_role_perm/(:any)', 'Admin::add_role_perm');
    $routes->post('add_role_perm', 'Admin::add_role_perm');
    $routes->post('change_role_user/(:any)', 'Admin::change_role_user');
    $routes->post('change_role_user', 'Admin::change_role_user');
    $routes->post('add_role_user/(:any)', 'Admin::add_role_user');
    $routes->post('add_role_user', 'Admin::add_role_user');
    $routes->post('delete_user/(:any)', 'Admin::delete_user');
    $routes->post('delete_user', 'Admin::delete_user');
    $routes->post('edit_user/(:any)', 'Admin::edit_user');
    $routes->post('edit_user', 'Admin::edit_user');
    $routes->post('change_pass/(:any)', 'Admin::change_pass');
    $routes->post('change_pass', 'Admin::change_pass');
    $routes->post('ubah_sts/(:any)', 'Admin::ubah_sts');
    $routes->post('ubah_sts', 'Admin::ubah_sts');
});

$routes->group('approv', ['filter' => 'role:spv-jkt,spv-sbm,spv-bdg,spv-crb,spv-tsk,spv-grt,spv-idr,spv-kng,spv-sbg,spv-bjr,nsm,audit,admin'], static function ($routes) {
    // get
    $routes->get('/', 'Approv::index');
    $routes->get('index/(:any)', 'Approv::index');
    $routes->get('index', 'Approv::index');

    // post
    $routes->post('app', 'Approv::app');
    $routes->post('danied', 'Approv::danied');
});
$routes->group('user', ['filter' => 'role:user,admin,spv,nsm,fam,audit,am,gm,dir,edp,acc,adm-jbr,sp-jkt,sp-sbm,sp-bdg,sp-crb,sp-tsk,sp-grt,sp-idr,sp-kng,sp-sbg,sp-bjr,spv-jkt,spv-sbm,spv-bdg,spv-crb,spv-tsk,spv-grt,spv-idr,spv-kng,spv-sbg,spv-bjr,ksr-jkt,ksr-sbm,ksr-bdg,ksr-crb,ksr-tsk,ksr-grt,ksr-idr,ksr-kng,ksr-sbg,ksr-bjr,cc-jkt,cc-sbm,cc-bdg,cc-crb,cc-tsk,cc-grt,cc-idr,cc-kng,cc-sbg,cc-bjr'], static function ($routes) {
    $routes->get('index', 'User::index');
    $routes->post('update', 'User::update');
    $routes->post('change_pass', 'User::change_pass');
});
$routes->group('tool', ['filter' => 'role:user,admin,spv,nsm,fam,audit,am,gm,dir,edp,acc,adm-jbr,sp-jkt,sp-sbm,sp-bdg,sp-crb,sp-tsk,sp-grt,sp-idr,sp-kng,sp-sbg,sp-bjr,spv-jkt,spv-sbm,spv-bdg,spv-crb,spv-tsk,spv-grt,spv-idr,spv-kng,spv-sbg,spv-bjr,ksr-jkt,ksr-sbm,ksr-bdg,ksr-crb,ksr-tsk,ksr-grt,ksr-idr,ksr-kng,ksr-sbg,ksr-bjr,cc-jkt,cc-sbm,cc-bdg,cc-crb,cc-tsk,cc-grt,cc-idr,cc-kng,cc-sbg,cc-bjr'], static function ($routes) {
    $routes->get('cek_nomor', 'Tool::cek_nomor');
    $routes->post('cek_nomor_action', 'Tool::cek_nomor_action');
    $routes->get('cek_kend', 'Tool::cek_kend');
    $routes->post('cek_kend_action', 'Tool::cek_kend_action');
});
$routes->group('laporan', ['filter' => 'role:audit,nsm,admin'], static function ($routes) {
    $routes->get('sp', 'Laporan::sp');
    $routes->post('sp_action', 'Laporan::sp_action');
    $routes->get('kend', 'Laporan::kend');
    $routes->post('kend_action', 'Laporan::kend_action');
    $routes->post('kend_jual', 'Laporan::kend_jual');
    $routes->get('bbm_show/(:any)/(:any)/(:any)/(:any)', 'Laporan::bbm_show/$1/$2/$3/$4');
    $routes->get('service_show/(:any)/(:any)/(:any)/(:any)/(:any)', 'Laporan::service_show/$1/$2/$3/$4/$5');
});
$routes->group('master', ['filter' => 'role:audit,admin'], static function ($routes) {
    $routes->get('service', 'Master::service');
    $routes->post('service_store', 'Master::service_store');
    $routes->post('service_update', 'Master::service_update');
    $routes->post('service_delete', 'Master::service_delete');
    $routes->get('fungsi', 'Master::fungsi');
    $routes->post('fungsi_store', 'Master::fungsi_store');
    $routes->post('fungsi_update', 'Master::fungsi_update');
    $routes->post('fungsi_delete', 'Master::fungsi_delete');
    $routes->get('jenis', 'Master::jenis');
    $routes->post('jenis_store', 'Master::jenis_store');
    $routes->post('jenis_update', 'Master::jenis_update');
    $routes->post('jenis_delete', 'Master::jenis_delete');
    // kendaraan
    $routes->get('kend', 'Master::kend');
    $routes->get('add_kend', 'Master::add_kend');
    $routes->post('kend_store', 'Master::kend_store');
    $routes->get('edit_kend', 'Master::edit_kend');
    $routes->get('edit_kend/(:any)', 'Master::edit_kend/$1');
    $routes->get('show_kend', 'Master::show_kend');
    $routes->get('show_kend/(:any)', 'Master::show_kend/$1');
    $routes->post('kend_update', 'Master::kend_update');
    $routes->post('kend_delete', 'Master::kend_delete');
});
$routes->group('data', ['filter' => 'role:admin,spv,nsm,fam,am,gm,dir,edp,acc,audit,sp-jkt,sp-sbm,sp-bdg,sp-crb,sp-tsk,sp-grt,sp-idr,sp-kng,sp-sbg,sp-bjr,spv-jkt,spv-sbm,spv-bdg,spv-crb,spv-tsk,spv-grt,spv-idr,spv-kng,spv-sbg,spv-bjr,ksr-jkt,ksr-sbm,ksr-bdg,ksr-crb,ksr-tsk,ksr-grt,ksr-idr,ksr-kng,ksr-sbg,ksr-bjr,cc-jkt,cc-sbm,cc-bdg,cc-crb,cc-tsk,cc-grt,cc-idr,cc-kng,cc-sbg,cc-bjr'], static function ($routes) {
    // service
    $routes->get('service', 'Data::service');
    $routes->get('add_service', 'Data::add_service');
    $routes->post('service_store', 'Data::service_store');
    $routes->get('edit_service', 'Data::edit_service');
    $routes->get('edit_service/(:any)', 'Data::edit_service/$1');
    $routes->get('show_service', 'Data::show_service');
    $routes->get('show_service/(:any)', 'Data::show_service/$1');
    $routes->post('service_update', 'Data::service_update');
    $routes->post('service_delete', 'Data::service_delete');
    $routes->post('kend_sell', 'Data::kend_sell');

    $routes->get('history', 'Data::history');
    $routes->post('history_action', 'Data::history_action');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
