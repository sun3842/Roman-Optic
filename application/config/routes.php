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
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['home']='Home/home';
$route['all_week_expired_lens_users']='Home/all_week_expired_lens_users';


/**********************************************************for Language*******************************************//////////////////////
$route['set_language/(:any)']="Language/set_language/$1";
$route['set_language/(:any)/(:any)']="Language/set_language/$1/$2";
$route['set_language/(:any)/(:any)/(:any)']="Language/set_language/$1/$2/$3";

//--------------------admin login-----------------------------------
$route['login']='Login/login';
$route['logout']='Logout/logout';


//-------------------admin jobs------------------------------------

$route['create_job']='Job/create_job';
$route['job_list'] = 'Job/job_list';
$route['edit_job/(:any)'] = 'Job/edit_job/$1';
$route['delete_job/(:any)'] = 'Job/deactive_job/$1';

//-------------------admin Category---------------------------------
//$route['all_category']='Admin_category/all_category';
$route['all_subcategory']='Admin_category/all_subcategory';
//$route['add_category']='Admin_category/add_category';

//-------------------admin Product-----------------------------------
//$route['all_product']='Admin_product/all_product';
//$route['upload_product']='Admin_product/upload_product';


$route['contact_us']='Admin_contact_us/contact_us';
$route['add_branch']='Branch/add_new_branch';
$route['all_branch']="Branch/all_branch_list";
$route['edit_branch/(:any)']="Branch/edit_branch_by_id/$1";
//-------------------admin News---------------------------------------

$route['create_news'] = 'News/create_news';
$route['news_list'] = 'News/news_list';
$route['edit_news/(:any)'] = 'News/edit_news/$1';
$route['delete_news/(:any)']='News/de_active_news_by_news_id/$1';

//-------------------admin profile------------------------------------

$route['profile'] = 'Admin_profile/my_profile';

//-------------------admin message------------------------------------

$route['create_message'] = 'Message/create_message';
$route['news_message_list'] = 'Message/message_list';
$route['edit_message/(:any)'] = 'Message/edit_message/$1';
$route['delete_message/(:any)']='Message/de_active_message_by_message_id/$1';


//**********************************development*******************

//***************************collection***********************

$route['all_category']='Collection/category_list';
$route['add_category']='Collection/new_category';
$route['all_subcategory/(:any)']='Collection/subcategory_list_by_ctg_id/$1';
$route['delete_category']='Collection/de_active_category';
$route['delete_subcategory']='Collection/de_active_subcategory';
$route['add_product']='Collection/new_product';
$route['all_product']='Collection/product_list';
$route['delete_product/(:any)']='Collection/de_active_product_by_p_id/$1';
$route['edit_product/(:any)']='Collection/update_product/$1';



//**********************offer**********************************************
$route['add_offer']='Offer/new_offer';
$route['all_offer']='Offer/offer_list';
$route['delete_offer/(:any)']='Offer/de_active_offer_by_id/$1';
$route['edit_offer/(:any)']='Offer/update_offer_by_id/$1';
$route['offer_details/(:any)']='Offer/view_offer/$1';
$route['get_all_city']='Offer/get_all_city';

//*******************************gallery************************************
$route['all_gallery']='Gallery/gallery_list';
$route['create_album']='Gallery/new_album';
$route['add_photo']='Gallery/new_photo_video';
$route['album_details/(:any)']='Gallery/view_album_by_id/$1';


//**********************download*********************************************

$route['all_download']='Download/download_list';

//***********************feedback*********************************************
$route['all_feedback']='Feedback/feedback_list';
$route['feedback_details/(:any)']='Feedback/view_feedback_by_id/$1';
$route['feedback_reply_by_admin']='Feedback/feedback_reply_by_id';

//********************chat*****************************************************
$route['chat']='Chat/view_chat';
$route['new_message']='Chat/add_message';
$route['refresh_chat_box']='Chat/update_chat_box';
$route['refresh_user_list']='Chat/refresh_user_list_with_length';

//**********************download*********************************************

$route['all_download']='Download/download_list';

//***********************opticiant**********************************************

$route['all_optician']='Opticians/optician_list';
$route['add_optician']='Opticians/new_optician';
$route['delete_optician/(:any)']='Opticians/de_active_optician_by_team_member_id/$1';
$route['edit_optician/(:any)'] = 'Opticians/edit_optician/$1';

//-------------------admin events------------------------------------

$route['create_event'] = 'Events/create_events';
$route['all_event_list'] = 'Events/all_event_list';
$route['event_states_with_country_id']='Events/get_states_by_country_id';
$route['event_cities_with_state_id']='Events/get_cities_by_state_id';
$route['edit_event/(:any)']='Events/update_event_by_id/$1';
$route['remove_event_img']='Events/delete_event_image';
$route['delete_event/(:any)']='Events/delete_event_by_id/$1';
$route['event_details/(:any)']='Events/view_event_by_id/$1';
$route['all_ongoing_or_upcoming_event']='Events/get_all_ongoing_upcoming_event';


//-------------------admin service------------------------------------

$route['create_service'] = 'Admin_service/create_service';
$route['service_list'] = 'Admin_service/service_list';
$route['edit_service/(:any)'] = 'Admin_service/edit_service/$1';
$route['delete_service/(:any)']='Admin_service/de_active_service_by_service_id/$1';

//-------------------admin inquiry------------------------------------

$route['inquiry_list'] = 'Inquiry/inquiry_list';
$route['inquiry_reply/(:any)'] = 'Inquiry/inquiry_reply/$1';

//-------------------admin lens------------------------------------

$route['lens_user'] = 'Lens/lens_user';
$route['add_lens_user'] = 'Lens/add_lens_user';
$route['edit_lens_user/(:any)']='Lens/update_lens_user/$1';


//*****************Account Management***************************************
$route['check_account_password']='Account_management/check_user_password';
$route['update_app_user_info']='Account_management/update_app_user';
$route['update_app_user_pass']='Account_management/app_user_new_pass';
$route['user_info']='Account_management/user_info';



/////////////*************************************************************///////////////////////////////////////////
/// //////////////////////////////////************Agent*******************///////////////////////////////////////////

$route['agent_login']='Agent_login/login';
$route['agent_logout']='Agent_logout/logout';
$route['agent_home']='Agent_home/home';

//*********************************agent_app********************************************/////////////////////////////////
$route['agent_apps']='Agent_app/all_apps';
$route['add_app']='Agent_app/new_app';
$route['is_user_name_exist']='Agent_app/app_user_name_exist_or_not';
$route['is_user_name_exist/(:any)']='Agent_app/app_user_name_exist_or_not/$1';
$route['delete_app/(:any)']='Agent_app/delete_app_by_id/$1';
$route['edit_app/(:any)']='Agent_app/update_app_by_id/$1';
$route['view_app/(:any)']='Agent_app/view_app_details_by_id/$1';

//**********************************************Order*************************************//////////////////////////////////
$route['add_order']='Order/new_order';
$route['order_list']='Order/all_order';
$route['is_order_id_exist']='Order/is_order_id_exist';
$route['edit_order']='Order/update_order';
$route['is_order_unique_id_editable']='Order/is_order_unique_id_editable';