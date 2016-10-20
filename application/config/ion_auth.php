<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth
*
* Version: 2.5.2
*
* Author: Ben Edmunds
*		  ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

/*
| -------------------------------------------------------------------------
| Tabel prefix
| -------------------------------------------------------------------------
| pengaturan tebel prefix.
*/
$table_prefix  = 'rc_';

/*
| -------------------------------------------------------------------------
| Untuk config dinamis
| -------------------------------------------------------------------------
| Setiap config diambil dari tabel options.
*/
$CI =& get_instance(); 
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "site_title"');
$site_title = $query->row();
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "admin_email"');
$admin_email = $query->row();
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "default_group"');
$default_group = $query->row();
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "admin_group"');
$admin_group = $query->row();
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "identity"');
$identity = $query->row();

$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "site_tagline"');
$site_tagline = $query->row();
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "site_desc"');
$site_desc = $query->row();
$query = $CI->db->query('SELECT value FROM '.$table_prefix.'options WHERE name = "super_admin_group"');
$super_admin_group = $query->row();

/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['users']           = $table_prefix.'users';
$config['tables']['groups']          = $table_prefix.'groups';
$config['tables']['users_groups']    = $table_prefix.'users_groups';
$config['tables']['login_attempts']  = $table_prefix.'login_attempts';
// Dari RAI
$config['tables']['roles']  		 = $table_prefix.'roles';
$config['tables']['roles_category']  = $table_prefix.'roles_category';
$config['tables']['permissions']  	 = $table_prefix.'permissions';
$config['tables']['options']  	 	 = $table_prefix.'options';

/*
 | Users table column and Group table column you want to join WITH.
 |
 | Joins from users.id
 | Joins from groups.id
 */
$config['join']['users']  = 'user_id';
$config['join']['groups'] = 'group_id';

/*
 | -------------------------------------------------------------------------
 | Hash Method (sha1 or bcrypt)
 | -------------------------------------------------------------------------
 | Bcrypt is available in PHP 5.3+
 |
 | IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
 | bcrypt instead of sha1.
 |
 | NOTE: If you use bcrypt you will need to increase your password column character limit to (80)
 |
 | Below there is "default_rounds" setting.  This defines how strong the encryption will be,
 | but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
 | this based on your server hardware.
 |
 | If you are using Bcrypt the Admin password field also needs to be changed in order login as admin:
 | $2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36
 |
 | Be careful how high you set max_rounds, I would do your own testing on how long it takes
 | to encrypt with x rounds.
 |
 | salt_prefix: Used for bcrypt. Versions of PHP before 5.3.7 only support "$2a$" as the salt prefix
 | Versions 5.3.7 or greater should use the default of "$2y$".
 */
$config['hash_method']    = 'bcrypt';	// sha1 or bcrypt, bcrypt is STRONGLY recommended
$config['default_rounds'] = 8;		// This does not apply if random_rounds is set to true
$config['random_rounds']  = FALSE;
$config['min_rounds']     = 5;
$config['max_rounds']     = 9;
$config['salt_prefix']    = '$2y$';

/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | maximum_login_attempts: This maximum is not enforced by the library, but is
 | used by $this->ion_auth->is_max_login_attempts_exceeded().
 | The controller should check this function and act
 | appropriately. If this variable set to 0, there is no maximum.
 */
$config['site_title']                 = $site_title->value;  		// Site Title, example.com
$config['admin_email']                = $admin_email->value; 		// Admin Email, admin@example.com
$config['default_group']              = $default_group->value;		// Default group, use name
$config['admin_group']                = $admin_group->value; 		// Default administrators group, use name
$config['identity']                   = $identity->value;  	 		// A database column which is used to login with
$config['min_password_length']        = 8;                   		// Minimum Required Length of Password
$config['max_password_length']        = 20;                  		// Maximum Allowed Length of Password
$config['email_activation']           = FALSE;               		// Email Activation for registration
$config['manual_activation']          = TRUE;               		// Manual Activation for registration
$config['remember_users']             = TRUE;                		// Allow users to be remembered and enable auto-login
$config['user_expire']                = 86500;               		// How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login']       = FALSE;               		// Extend the users cookies every time they auto-login
$config['track_login_attempts']       = TRUE;               		// Track the number of failed login attempts for each user or ip.
$config['track_login_ip_address']     = TRUE;                		// Track login attempts by IP Address, if FALSE will track based on identity. (Default: TRUE)
$config['maximum_login_attempts']     = 3;                   		// The maximum number of failed login attempts.
$config['lockout_time']               = 600;                 		// The number of seconds to lockout an account due to exceeded attempts
$config['forgot_password_expiration'] = 3;                   		// The number of milliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.
//dari RAI
$config['site_tagline']               = $site_tagline->value;   	// Site Tagline
$config['site_desc']                  = $site_desc->value;   		// Site Tagline
$config['super_admin_group']          = $super_admin_group->value; 	// Default Super Administrators group, use name
/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';

/*
 | -------------------------------------------------------------------------
 | Email options.
 | -------------------------------------------------------------------------
 | email_config:
 | 	  'file' = Use the default CI config or use from a config file
 | 	  array  = Manually set your email config settings
 */
$config['use_ci_email'] = TRUE; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = 'file';
// $config['email_config'] = array(
// 	'mailtype' => 'html',
// 	'smtp_host'=> 'smtp.mailgun.org',
// 	'smtp_user'=> 'postmaster@sandbox488e8c74406541b9910c556c38435a10.mailgun.org',
// 	'smtp_pass'=> '12a37d04f461c65aafeaa74c1421400f ',
// 	'smtp_port'=> 587,
// 	'smtp_timeout'=> 60
// );

/*
 | -------------------------------------------------------------------------
 | Email templates.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: auth/
 */
$config['email_templates'] = 'back/layouts/auth/email/';

/*
 | -------------------------------------------------------------------------
 | Activate Account Email Template
 | -------------------------------------------------------------------------
 | Default: activate.tpl.php
 */
$config['email_activate'] = 'activate.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Email Template
 | -------------------------------------------------------------------------
 | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Complete Email Template
 | -------------------------------------------------------------------------
 | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Salt options
 | -------------------------------------------------------------------------
 | salt_length Default: 22
 |
 | store_salt: Should the salt be stored in the database?
 | This will change your password encryption algorithm,
 | default password, 'password', changes to
 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 22;
$config['store_salt']  = FALSE;

/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<p>'; 	// Message start delimiter
$config['message_end_delimiter']   = '</p>'; 	// Message end delimiter
$config['error_start_delimiter']   = '<p>';		// Error mesage start delimiter
$config['error_end_delimiter']     = '</p>';	// Error mesage end delimiter

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */