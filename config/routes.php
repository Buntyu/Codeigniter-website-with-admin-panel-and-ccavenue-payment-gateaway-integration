<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
 
$route['default_controller'] = "home";
$route['404_override'] = 'pagenotfound';

/**
* My Custom routing
*/
$route['ci_admin'] = "admin/login";
$route['ci_admin/(:any)'] = "admin/$1";
$route['ci_admin/(:any)/(:any)'] = "admin/$1/$2";
$route['ci_admin/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3";


$route['custom/(:any)'] = "custom/$1";
$route['custom/(:any)/(:any)'] = "custom/$1/$2";
$route['custom/(:any)/(:any)/(:any)'] = "custom/$1/$2/$3";
$route['custom/(:any)/(:any)/(:any)/(:any)'] = "custom/$1/$2/$3/$4";
$route['custom/(:any)/(:any)/(:any)/(:any)/(:any)'] = "custom/$1/$2/$3/$4/$5";
$route['custom/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "custom/$1/$2/$3/$4/$5/$6";


$route['product/(:any)'] = 'product/viewProduct/$1';
$route['blog/(:any)'] = 'blog/viewBlog/$1';

$route['product/latest-products'] = 'product/viewLatestProducts';
$route['product/ajax_Latest'] = 'product/ajax_Latest';
$route['product/ajax_Latest/(:any)'] = 'product/ajax_Latest/$1';

$route['product/featured-products'] = 'product/viewFeaturedProducts';
$route['product/ajax_Featured'] = 'product/ajax_Featured';
$route['product/ajax_Featured/(:any)'] = 'product/ajax_Featured/$1';

$route['product/SearchResults'] = 'product/SearchResults';
$route['product/ajax_SearchResults'] = 'product/ajax_SearchResults';
$route['product/ajax_SearchResults/(:any)'] = 'product/ajax_SearchResults/$1';

$route['product/viewDiscountProducts'] = 'product/viewDiscountProducts';
$route['product/ajax_Discount'] = 'product/ajax_Discount';
$route['product/ajax_Discount/(:any)'] = 'product/ajax_Discount/$1';

$route['categories/(:any)'] = 'categories/viewCategoryProducts/$1';
$route['subcategories/(:any)/(:any)'] = 'subcategories/viewSubcategoryProducts/$1/$2';
$route['cart'] = 'checkout';
$route['terms-and-conditions'] = 'tac';
$route['about-us'] = 'aboutus';
$route['contact-us'] = 'contactus';
$route['International-shipping-charges'] = 'International_shipping_charges';
$route['affiliate-terms-and-conditions'] = 'affiliate_tac';
/* End of file routes.php */
/* Location: ./application/config/routes.php */