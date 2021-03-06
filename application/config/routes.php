<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
//$route['default_controller'] = 'backoffice/user/profile';
$route['default_controller'] = 'welcome';
$route['login'] = 'backoffice/user/login';
$route['register'] = 'backoffice/user/register';
$route['logout'] = 'backoffice/user/logout';
$route['user/(:any)'] = 'backoffice/user/$1';
$route['user/(:any)/(:any)'] = 'backoffice/user/$1/$2';
$route['user'] = 'backoffice/user';
$route['developer/(:any)'] = 'backoffice/developer/$1';
$route['developer/(:any)/(:any)'] = 'backoffice/developer/$1/$2';
$route['developer'] = 'backoffice/developer';
$route['proyek/(:any)'] = 'backoffice/proyek/$1';
$route['proyek/(:any)/(:any)'] = 'backoffice/proyek/$1/$2';
$route['proyek'] = 'backoffice/proyek';
$route['harga/(:any)'] = 'backoffice/harga/$1';
$route['harga/(:any)/(:any)'] = 'backoffice/harga/$1/$2';
$route['harga'] = 'backoffice/harga';
$route['konsumen/(:any)'] = 'backoffice/konsumen/$1';
$route['konsumen/(:any)/(:any)'] = 'backoffice/konsumen/$1/$2';
$route['konsumen'] = 'backoffice/konsumen';
$route['survey/(:any)'] = 'backoffice/survey/$1';
$route['survey/(:any)/(:any)'] = 'backoffice/survey/$1/$2';
$route['survey'] = 'backoffice/survey';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
