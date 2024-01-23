<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// authentications
$route['login'] = 'C_Authentications/login';
$route['logout'] = 'C_Authentications/logout';
$route['authenticate'] = 'C_Authentications/authenticate';

// reports
$route['default_controller'] = 'C_Reports';
$route['rekap'] = 'C_Reports/rekap';
$route['checkin_kerja'] = 'C_Reports/checkin';
$route['checkout_kerja'] = 'C_Reports/checkout';
$route['load_data_table_reports/(:any)/(:any)'] = 'C_Reports/load_data_table_reports/$1/$2';

$route['presensi'] =  'C_Reports/presensi';
$route['presensi/kerja'] = 'C_Reports/presensi_kerja';
$route['presensi/izin'] = 'C_Reports/presensi_izin';

// Role Pimpinan
$route['rekap_presensi_pegawai'] = 'C_Reports/rekap_presensi_pegawai';
$route['load_data_table_presensi_pegawai/(:any)/(:any)/(:any)'] = 'C_Reports/load_data_table_presensi_pegawai/$1/$2/$3';

// Role Admin
$route['daftar_pengguna'] = 'C_Users/daftar_pengguna';
$route['load_data_table_daftar_pengguna'] = 'C_Users/load_data_table_daftar_pengguna';
$route['add_new_user'] = 'C_Users/add_new_user';
$route['add_role_user'] = 'C_Users/add_role_user';

// settings
$route['pengaturan'] = 'C_Settings';
$route['update_user'] = 'C_Settings/update_user';
$route['update_user_password'] = 'C_Settings/update_user_password';
