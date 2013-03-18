<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
* --------------------------------------------------------------------------
*	Define by creator : Virgiawan Huda Akbar, M. Fakhri, Aliyil
* --------------------------------------------------------------------------
*
*	Some configuration. You can add below this comment
*
*/

/*-- DEFINE CONSTANTA MESSAGE --*/
define('MSG_TYPE_ERROR',			'error');
define('MSG_TYPE_SUCCESS',			'success');
define('MSG_TYPE_INFO',				'info');
define('MSG_TYPE_WARNING',			'warning');
/*-- END OF DEFINE CONSTANTA MESSAGE --*/

/*-- DEFINE CONSTANTA POST TYPE --
* You can add post type here. Please look at your post_types table in database
* Post type value must same with value from post_types table.
*/
define('POST_TYPE_ARTICLE',		'1');
define('POST_TYPE_PAGE',		'2');
define('POST_TYPE_GALLERY',		'3');
define('POST_TYPE_SLIDE',		'4');
define('POST_TYPE_VIDEO',		'5');
/*-- END DEFINE CONSTANTA POST TYPE --*/

/*-- DEFINE CONSTANTA TERM TYPE --
* You can add term type here. Please look at your term_types table in database
* Term type value must same with value from term_types table.
*/
define('TERM_TYPE_CATEGORY',		'1');
define('TERM_TYPE_TAG',				'2');
/*-- END OF DEFINE CONSTANTA TERM TYPE --*/

/*-- DEFINE CONSTANTA FOR USER ROLE --*/
define('ROLE_SUPERADMIN',			'1');
define('ROLE_ADMIN',				'2');
/*-- END OF DEFINE CONSTANTA FOR USER ROLE --*/

/*-- DEFINE CONSTANTA SITE TITLE --*/
define('SITE_TITLE', 			'Capung CMS');
define('ADMIN_TITLE',			'Administrator Panel');
/*-- END OF DEFINE CONSTANTA SITE TITLE --*/


/* End of file constants.php */
/* Location: ./application/config/constants.php */