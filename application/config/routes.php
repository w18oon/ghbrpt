<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'page/view';
$route['users/(:any)/(:any)'] = 'page/view';
$route['users/create'] = 'page/view';
$route['(home|users|settings)'] = 'page/view';
$route['event-summary-report'] = 'page/report';
$route['event-summary-report/result'] = 'page/report';
$route['cdr-report'] = 'page/cdr_report';
$route['cdr-report/result'] = 'page/cdr_report';
$route['signin'] = 'page/signin';
$route['signout'] = 'page/signout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;