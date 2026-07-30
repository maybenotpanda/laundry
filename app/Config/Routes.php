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
$routes->get('/', 'Home::index');
$routes->get('detail/(:any)', 'Home::detail/$1');
$routes->get('do-not-have-access/', 'Page\Dashboard::donothaveaccess', ['filter' => 'role:user']);

$routes->group('/', function ($routes) {

    $routes->get('dashboard/', 'Page\Dashboard::index', ['filter' => 'role:staff ,admin']);

    // Profile
    $routes->get('profile/(:any)', 'Page\Profile::index/$1',      ['filter' => 'role:staff ,admin']);
    $routes->post('/profile/update/(:any)', 'Page\Profile::updatePassword/$1',      ['filter' => 'role:staff ,admin']);

    // CRUD customer
    $routes->get('customer/', 'Page\Customer::index',      ['filter' => 'role:staff ,admin']);
    $routes->add('addcustomer', 'Page\Customer::addCustomer', ['filter' => 'role:staff ,admin']);
    $routes->post('/customer/update/(:num)', 'Page\Customer::update/$1', ['filter' => 'role:staff, admin']);
    $routes->get('/customer/delete/(:num)', 'Page\Customer::delete/$1', ['filter' => 'role:staff, admin']);

    // CRUD laundry
    $routes->get('laundry/add-laundry/', 'Page\Laundry::pageAdd', ['filter' => 'role:staff ,admin']);
    $routes->add('transaction', 'TransactionController::store', ['filter' => 'role:staff ,admin']);
    $routes->get('laundry/', 'Page\Laundry::index',  ['filter' => 'role:staff,admin']);
    $routes->get('payment/(:any)', 'Page\Laundry::payment/$1',  ['filter' => 'role:staff,admin']);
    $routes->post('/laundry/paid/(:num)', 'Page\Laundry::paid/$1',  ['filter' => 'role:staff,admin']);
    $routes->get('laundry/invoice/(:any)', 'Page\Laundry::getInvoice/$1',  ['filter' => 'role:staff,admin']);
    $routes->post('/laundry/activity/(:num)', 'Page\Laundry::updateActivity/$1', ['filter' => 'role:staff,admin']);
    $routes->post('/laundry/updatepaid/(:num)', 'Page\Laundry::updatePaid/$1', ['filter' => 'role:staff,admin']);
    $routes->get('/getService/(:any)', 'Page\Laundry::getservice/$1');



    $routes->get('barang/', 'Page\Inventory::index',           ['filter' => 'role:staff,admin']);
    $routes->get('barang/add-inventory/', 'Page\Inventory::newitem', ['filter' => 'role:staff ,admin']);
    $routes->add('addinventory', 'Page\Inventory::addInventory', ['filter' => 'role:staff ,admin']);
    $routes->post('/inventory/update/(:num)', 'Page\Inventory::updateInventory/$1', ['filter' => 'role:staff,admin']);
});
$routes->group('/', function ($routes) {

    // CRUD employee
    $routes->get('employee/add-employee/', 'Admin\Employee::pageAdd', ['filter' => 'role:admin']);
    $routes->add('addemployee', 'Admin\Employee::addEmployee', ['filter' => 'role:admin']);
    $routes->get('employee/', 'Admin\Employee::index', ['filter' => 'role:admin']);
    $routes->post('/employee/update/(:num)', 'Admin\Employee::updateEmployee/$1', ['filter' => 'role:admin']);
    $routes->post('/employee/group-update/(:num)', 'Admin\Employee::changeAccess/$1', ['filter' => 'role:admin']);
    $routes->get('employee/delete/(:num)', 'Admin\Employee::delete/$1', ['filter' => 'role:admin']);

    // CRUD service
    $routes->add('addservice', 'Admin\Service::addService', ['filter' => 'role:admin']);
    $routes->get('service/', 'Admin\Service::index', ['filter' => 'role:admin']);
    $routes->post('/service/update/(:num)', 'Admin\Service::updateService/$1', ['filter' => 'role:admin']);
    $routes->get('/service/delete/(:num)', 'Admin\Service::delete/$1', ['filter' => 'role:admin']);

    // CRUD activity
    $routes->get('activity/', 'Admin\Activity::index', ['filter' => 'role:admin']);
    $routes->add('addactivity', 'Admin\Activity::addActivity', ['filter' => 'role:admin']);
    $routes->post('/activity/update/(:num)', 'Admin\Activity::updateActivity/$1', ['filter' => 'role:admin']);
    $routes->get('/activity/delete/(:num)', 'Admin\Activity::deleteActivity/$1', ['filter' => 'role:admin']);

    // Approval item
    $routes->get('transaksi-pembelian/', 'Admin\Approval::index', ['filter' => 'role:admin']);
    $routes->get('/inventory/delete/(:num)', 'Page\Inventory::deleteInventory/$1', ['filter' => 'role:admin']);
    $routes->post('/inventory/updateStatus/(:num)', 'Page\Inventory::updateStatus/$1', ['filter' => 'role:admin']);

    // Read report
    $routes->get('income/', 'Admin\Pemasukkan::index', ['filter' => 'role:admin']);
    $routes->get('income/export/', 'Admin\Pemasukkan::export', ['filter' => 'role:admin']);
    $routes->get('outcome/', 'Admin\Pengeluaran::index', ['filter' => 'role:admin']);
    $routes->get('outcome/export/', 'Admin\Pengeluaran::export', ['filter' => 'role:admin']);
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
