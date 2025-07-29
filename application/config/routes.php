<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
 */

$route['default_controller'] = "frontend";
$route['404_override'] = '';
$route['cma'] = "frontend/quick_pdf";
$route['cma/(:any)'] = "frontend/quick_pdf/$1";
$route['mkt'] = "frontend/quick_pdf";
$route['mkt/(:any)'] = "frontend/quick_pdf/$1";
$route['market'] = "frontend/quick_pdf";
$route['user/report-review/(:any)'] = "user/reportReview/$1";

/* start of frontend routes */
/* end of frontend routes */

/* start of backend routes */
/* end of backend routes */

/* End of file routes.php */
/* Location: ./application/config/routes.php */
