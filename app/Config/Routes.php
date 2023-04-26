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

$routes->get('/home/index', 'Home::index');

$routes->group('admin', ['filter' => 'permission:manage-all'], static function ($routes) {
    // get
    $routes->get('index/(:any)', 'Admin::index');
    $routes->get('index', 'Admin::index');
    $routes->get('set_limit/(:any)', 'Admin::set_limit');
    $routes->get('set_limit', 'Admin::set_limit');
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
    $routes->post('change_limit/(:any)', 'Admin::change_limit');
    $routes->post('change_limit', 'Admin::change_limit');
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

$routes->group('adminsp', ['filter' => 'role:sp-jkt,sp-skb,sp-bdg,sp-crb,sp-tsk,sp-grt,sp-idr,sp-kng,sp-sbg,sp-bjr,ksr-jkt,ksr-sbm,ksr-bdg,ksr-crb,ksr-tsk,ksr-grt,ksr-idr,ksr-kng,ksr-sbg,ksr-bjr,cc-jkt,cc-sbm,cc-bdg,cc-crb,cc-tsk,cc-grt,cc-idr,cc-kng,cc-sbg,cc-bjr,admin'], static function ($routes) {
    // get
    $routes->get('/', 'AdminSP::index');
    $routes->get('index/(:any)', 'AdminSP::index');
    $routes->get('index', 'AdminSP::index');
    $routes->get('add', 'AdminSP::add');
    $routes->get('edit/(:any)', 'AdminSP::edit/$1');

    // post
    $routes->post('pass/(:any)', 'AdminSP::search_pass');
    $routes->post('pass', 'AdminSP::search_pass');
    $routes->post('restore', 'AdminSP::restore');
    $routes->post('pengajuan_view', 'AdminSP::pengajuan_view');
});
$routes->group('user', ['filter' => 'role:user,admin,spv,nsm,fam,am,gm,dir,edp,acc,adm-jbr,sp-jkt,sp-skb,sp-bdg,sp-crb,sp-tsk,sp-grt,sp-idr,sp-kng,sp-sbg,sp-bjr,spv-jkt,spv-skb,spv-bdg,spv-crb,spv-tsk,spv-grt,spv-idr,spv-kng,spv-sbg,spv-bjr,ksr-jkt,ksr-sbm,ksr-bdg,ksr-crb,ksr-tsk,ksr-grt,ksr-idr,ksr-kng,ksr-sbg,ksr-bjr,cc-jkt,cc-sbm,cc-bdg,cc-crb,cc-tsk,cc-grt,cc-idr,cc-kng,cc-sbg,cc-bjr'], static function ($routes) {
    $routes->post('index', 'User::index');
    $routes->post('update', 'User::update');
    $routes->post('update/(:any)', 'User::update');
});
$routes->group('acc', ['filter' => 'role:acc,fam,admin'], static function ($routes) {
    $routes->get('index', 'Acc::index');
    $routes->get('real', 'Acc::real');
});
$routes->group('adminjbr', ['filter' => 'role:adm-jbr,admin'], static function ($routes) {
    $routes->get('index', 'AdminJbr::index');
});
$routes->group('debitnote', ['filter' => 'role:admin,spv,nsm,fam,am,gm,dir,edp,acc,adm-jbr,sp-jkt,sp-skb,sp-bdg,sp-crb,sp-tsk,sp-grt,sp-idr,sp-kng,sp-sbg,sp-bjr,spv-jkt,spv-skb,spv-bdg,spv-crb,spv-tsk,spv-grt,spv-idr,spv-kng,spv-sbg,spv-bjr,ksr-jkt,ksr-sbm,ksr-bdg,ksr-crb,ksr-tsk,ksr-grt,ksr-idr,ksr-kng,ksr-sbg,ksr-bjr,cc-jkt,cc-sbm,cc-bdg,cc-crb,cc-tsk,cc-grt,cc-idr,cc-kng,cc-sbg,cc-bjr'], static function ($routes) {
    $routes->get('biaya', 'DebitNote::biaya');
    $routes->get('barang', 'DebitNote::barang');
    $routes->get('b2b', 'DebitNote::b2b');
    $routes->get('show/(:any)', 'DebitNote::show/$1');
    $routes->get('track', 'DebitNote::track');
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
