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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Login';
$route['dashboard'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// Realtime Data
$route['update/(:any)/(:any)'] = 'SensorController/update/$1/$2';
$route['check/suhu'] = 'SensorController/check_suhu';
$route['check/kelembaban'] = 'SensorController/check_kelembaban';
$route['check/otomatis'] = 'SensorController/check_otomatis';
$route['check/kipas'] = 'SensorController/check_kipas';
$route['check/dehumidifier'] = 'SensorController/check_dehumidifier';
$route['switch/kipas'] = 'SensorController/switch_kipas';
$route['switch/dehumidifier'] = 'SensorController/switch_dehumidifier';
$route['switch/otomatis'] = 'SensorController/switch_otomatis';
// Action from button
$route['kipas/on'] = 'SensorController/kipas_on';
$route['kipas/off'] = 'SensorController/kipas_off';
$route['dehumidifier/on'] = 'SensorController/dehumidifier_on';
$route['dehumidifier/off'] = 'SensorController/dehumidifier_off';
$route['otomatis/on'] = 'SensorController/otomatis_on';
$route['otomatis/off'] = 'SensorController/otomatis_off';
// Result to Arduino from Switch button
$route['arduino/switch/kipas'] = 'SensorController/arduino_kipas';
$route['arduino/switch/dehumidifier'] = 'SensorController/arduino_dehumidifier';
// Log Report
$route['laporan'] = 'SensorController/laporan';
$route['laporan_log/result'] = 'SensorController/laporan_log_result';
$route['laporan_harian/result'] = 'SensorController/laporan_harian_result';
$route['laporan_bulanan/result'] = 'SensorController/laporan_bulanan_result';
