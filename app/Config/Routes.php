<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// public routes
$routes->get('/', 'Home::index');

// authentication
$routes->get('/auth/login', 'AuthLogin::index', ['filter' => 'loginfilter']);
$routes->post('/auth/do_login', 'AuthLogin::do_login', ['filter' => 'loginfilter']);
$routes->get('/auth/do_logout', 'AuthLogin::do_logout');
$routes->get('/auth/register', 'AuthRegister::index');
$routes->post('/auth/do_register', 'AuthRegister::do_register');

// admin routes
$routes->get('/admin', 'AdminDashboard::index', ['filter' => 'adminfilter']);
$routes->get('/admin/setting', 'AdminSetting::index', ['filter' => 'adminfilter']);
$routes->post('/admin/setting/do_apply', 'AdminSetting::do_apply', ['filter' => 'adminfilter']);

// role management
$routes->get('/admin/user-access', 'AdminUser::index', ['filter' => 'adminfilter']);
$routes->get('/admin/superuser-access', 'AdminSuperUser::index', ['filter' => 'adminfilter']);
$routes->get('/admin/scripted-access-right', 'AdminScriptedAccessRight::index', ['filter' => 'adminfilter']);
$routes->post('/admin/scripted-access-right/do_add', 'AdminScriptedAccessRight::do_add', ['filter' => 'adminfilter']);
$routes->get('/admin/scripted-access-right/do_delete/(:num)', 'AdminScriptedAccessRight::do_delete/$1', ['filter' => 'adminfilter']);

// crud/upload
$routes->get('/admin/attachment', 'AdminAttachment::index', ['filter' => 'adminfilter']);
$routes->get('/admin/attachment/do_delete/(:num)', 'AdminAttachment::do_delete/$1', ['filter' => 'adminfilter']);
$routes->post('/admin/attachment/do_upload', 'AdminAttachment::do_upload', ['filter' => 'adminfilter']);
$routes->get('/admin/attachment/do_download/(:num)', 'AdminAttachment::do_download/$1', ['filter' => 'adminfilter']);

$routes->get('/admin/attachment2', 'AdminAttachment2::index', ['filter' => 'adminfilter']);
$routes->get('/admin/attachment2/do_delete/(:num)', 'AdminAttachment2::do_delete/$1', ['filter' => 'adminfilter']);
$routes->post('/admin/attachment2/do_upload', 'AdminAttachment2::do_upload', ['filter' => 'adminfilter']);
$routes->get('/admin/attachment2/do_download/(:num)', 'AdminAttachment2::do_download/$1', ['filter' => 'adminfilter']);

// wysiwyg editor integration
$routes->get('/admin/editor-quill', 'AdminEditorQuill::index', ['filter' => 'adminfilter']);
$routes->post('/admin/editor-quill/do_update', 'AdminEditorQuill::do_update', ['filter' => 'adminfilter']);
$routes->get('/admin/editor-quill2', 'AdminEditorQuill2::index', ['filter' => 'adminfilter']);
$routes->post('/admin/editor-quill2/do_update', 'AdminEditorQuill2::do_update', ['filter' => 'adminfilter']);
