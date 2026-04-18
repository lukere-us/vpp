<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", -1);
date_default_timezone_set("Asia/Calcutta");

/**
 * Configuration for: Base URL
 */
//define('URL', 'http://localhost/simulater/admin/');
//define('DOC_PATH', 'D:/XAMPP/htdocs/simulater/admin/');
define('URL', 'http://www.virtualprocessplant.com/admin/');
define('DOC_PATH', 'public_html/admin/');


/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define('COMMON_PATH', 'libs/');

define('CONTROLLER_PATH', 'application/controllers/');
define('MODELS_PATH', 'application/models/');
define('VIEWS_PATH', 'application/views/');



/**
 * Configuration for: Cookies
 * Please note: The COOKIE_DOMAIN needs the domain where your app is,
 * in a format like this: .mydomain.com
 * Note the . in front of the domain. No www, no http, no slash here!
 * For local development .127.0.0.1 is fine, but when deploying you should
 * change this to your real domain, like '.mydomain.com' ! The leading dot makes the cookie available for
 * sub-domains too.
 * @see http://stackoverflow.com/q/9618217/1114320
 * @see php.net/manual/en/function.setcookie.php
 */
// 1209600 seconds = 2 weeks
define('COOKIE_RUNTIME', 1209600);
// the domain where the cookie is valid for, for local development ".127.0.0.1" and ".localhost" will work
// IMPORTANT: always put a dot in front of the domain, like ".mydomain.com" !
define('COOKIE_DOMAIN', '.localhost');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, type etc.
 *
 * database type
 * define('DB_TYPE', 'mysql');
 * database host, usually it's "127.0.0.1" or "localhost", some servers also need port info, like "127.0.0.1:8080"
 * define('DB_HOST', '127.0.0.1');
 * name of the database. please note: database and database table are not the same thing!
 * define('DB_NAME', 'login');
 * user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT
 * By the way, it's bad style to use "root", but for development it will work
 * define('DB_USER', 'root');
 * The password of the above user
 * define('DB_PASS', 'xxx');
 */
//define('DB_TYPE', 'mysql');
//define('DB_HOST', '127.0.0.1');
//define('DB_NAME', 'simulator');
//define('DB_USER', 'root');
//define('DB_PASS', '');
//Alpha
//define('DB_TYPE', 'mysql');
//define('DB_HOST', '127.0.0.1');
//define('DB_NAME', 'microsq0_vpp');
//define('DB_USER', 'microsq0_preview');
//define('DB_PASS', '4enzKd66xnqh');
//Live
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mtw2020_vpp');
define('DB_USER', 'mtw2020_vpp_admi');
define('DB_PASS', 'gB0p45#]fMqf');

/**
 * Configuration for: Hashing strength
 * This is the place where you define the strength of your password hashing/salting
 *
 * To make password encryption very safe and future-proof, the PHP 5.5 hashing/salting functions
 * come with a clever so called COST FACTOR. This number defines the base-2 logarithm of the rounds of hashing,
 * something like 2^12 if your cost factor is 12. By the way, 2^12 would be 4096 rounds of hashing, doubling the
 * round with each increase of the cost factor and therefore doubling the CPU power it needs.
 * Currently, in 2013, the developers of this functions have chosen a cost factor of 10, which fits most standard
 * server setups. When time goes by and server power becomes much more powerful, it might be useful to increase
 * the cost factor, to make the password hashing one step more secure. Have a look here
 * (@see https://github.com/panique/php-login/wiki/Which-hashing-&-salting-algorithm-should-be-used-%3F)
 * in the BLOWFISH benchmark table to get an idea how this factor behaves. For most people this is irrelevant,
 * but after some years this might be very very useful to keep the encryption of your database up to date.
 *
 * Remember: Every time a user registers or tries to log in (!) this calculation will be done.
 * Don't change this if you don't know what you do.
 *
 * To get more information about the best cost factor please have a look here
 * @see http://stackoverflow.com/q/4443476/1114320
 */
// the hash cost factor, PHP's internal default is 10. You can leave this line
// commented out until you need another factor then 10.
define("HASH_COST_FACTOR", "10");

/**
 * Configuration for: Email server credentials
 *
 * Here you can define how you want to send emails.
 * If you have successfully set up a mail server on your linux server and you know
 * what you do, then you can skip this section. Otherwise please set EMAIL_USE_SMTP to true
 * and fill in your SMTP provider account data.
 *
 * An example setup for using gmail.com [Google Mail] as email sending service,
 * works perfectly in August 2013. Change the "xxx" to your needs.
 * Please note that there are several issues with gmail, like gmail will block your server
 * for "spam" reasons or you'll have a daily sending limit. See the readme.md for more info.
 *
 * define("PHPMAILER_DEBUG_MODE", 0);
 * define("EMAIL_USE_SMTP", true);
 * define("EMAIL_SMTP_HOST", 'ssl://smtp.gmail.com');
 * define("EMAIL_SMTP_AUTH", true);
 * define("EMAIL_SMTP_USERNAME", 'xxxxxxxxxx@gmail.com');
 * define("EMAIL_SMTP_PASSWORD", 'xxxxxxxxxxxxxxxxxxxx');
 * define("EMAIL_SMTP_PORT", 465);
 * define("EMAIL_SMTP_ENCRYPTION", 'ssl');
 *
 * It's really recommended to use SMTP!
 */
// Options: 0 = off, 1 = commands, 2 = commands and data, perfect to see SMTP errors, see the PHPMailer manual for more
define("PHPMAILER_DEBUG_MODE", 0);
// use SMTP or basic mail() ? SMTP is strongly recommended
define("EMAIL_USE_SMTP", false);
// name of your host
define("EMAIL_SMTP_HOST", 'yourhost');
// leave this true until your SMTP can be used without login
define("EMAIL_SMTP_AUTH", true);
// SMTP provider username
define("EMAIL_SMTP_USERNAME", 'yourusername');
// SMTP provider password
define("EMAIL_SMTP_PASSWORD", 'yourpassword');
// SMTP provider port
define("EMAIL_SMTP_PORT", 465);
// SMTP encryption, usually SMTP providers use "tls" or "ssl", for details see the PHPMailer manual
define("EMAIL_SMTP_ENCRYPTION", 'ssl');

/**
 * Configuration for: Email content data
 *
 * php-login uses the PHPMailer library, please have a look here if you want to add more
 * config stuff: @see https://github.com/PHPMailer/PHPMailer
 *
 * As email sending within your project needs some setting, you can do this here:
 *
 * Absolute URL to password reset action, necessary for email password reset links
 * define("EMAIL_PASSWORD_RESET_URL", "http://127.0.0.1/php-login/4-full-mvc-framework/login/passwordReset");
 * define("EMAIL_PASSWORD_RESET_FROM_EMAIL", "noreply@example.com");
 * define("EMAIL_PASSWORD_RESET_FROM_NAME", "My Project");
 * define("EMAIL_PASSWORD_RESET_SUBJECT", "Password reset for PROJECT XY");
 * define("EMAIL_PASSWORD_RESET_CONTENT", "Please click on this link to reset your password:");
 *
 * absolute URL to verification action, necessary for email verification links
 * define("EMAIL_VERIFICATION_URL", "http://127.0.0.1/php-login/4-full-mvc-framework/login/verify/");
 * define("EMAIL_VERIFICATION_FROM_EMAIL", "noreply@example.com");
 * define("EMAIL_VERIFICATION_FROM_NAME", "My Project");
 * define("EMAIL_VERIFICATION_SUBJECT", "Account Activation for PROJECT XY");
 * define("EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account:");
 */
define("EMAIL_PASSWORD_RESET_URL", URL . "login/verifypasswordreset");
define("EMAIL_PASSWORD_RESET_FROM_EMAIL", "no-reply@example.com");
define("EMAIL_PASSWORD_RESET_FROM_NAME", "My Project");
define("EMAIL_PASSWORD_RESET_SUBJECT", "Password reset for PROJECT XY");
define("EMAIL_PASSWORD_RESET_CONTENT", "Please click on this link to reset your password: ");

define("EMAIL_VERIFICATION_URL", URL . "login/verify");
define("EMAIL_VERIFICATION_FROM_EMAIL", "no-reply@example.com");
define("EMAIL_VERIFICATION_FROM_NAME", "My Project");
define("EMAIL_VERIFICATION_SUBJECT", "Account activation for PROJECT XY");
define("EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account: ");

/**
 * Configuration for: Error messages and notices
 *
 * In this project, the error messages, notices etc are all-together called "feedback".
 */
define("FEEDBACK_UNKNOWN_ERROR", "Unknown error occurred!");
define("FEEDBACK_REQUIRED_FIELD", "is required field");
define("FEEDBACK_INTEGER_FIELD", "is must be numeric");
define("FEEDBACK_STRING_FIELD", "is must be string");
define("FEEDBACK_EMAIL_FIELD", "is must be email");
define("FEEDBACK_DEF_REQUIRED_FIELD", "Please enter required fields");
define("FEEDBACK_COMPANY_REGISTER_SUCCESS", "Thank you,company successfully registered. Your login detail will email to you soon. ");
define("FEEDBACK_COMPANY_REGISTER_FAILED", "Company registration failed. Please try agin!. ");
define("FEEDBACK_COMPANY_ALLREDY_EXIST", "This companyemail allredy registered in system");
define("FEEDBACK_LOGIN_INVALID_LOGIN", "Invalid user email or password!");
define("FEEDBACK_LOGIN_STATUS_INACTIVE", "You are temprely inactive!");
define("FEEDBACK_EMPTY_COMPANY_LIST", "No company registered!");
define("FEEDBACK_INVALID_PARAMETER", "Invalid parameter!");
define("FEEDBACK_COMPANY_ACTIVATED", "is activated");
define("FEEDBACK_COMPANY_INACTIVATED", "is inactivated");
define("FEEDBACK_COMPANY_ACTION_FAILED", "Action failed!");
define("FEEDBACK_COMPANY_DELETE_SUCCESS", "is successfully deleted!");
define("FEEDBACK_COMPANY_UPDATESETTING_SUCCESS", " setting successfully updated!");
define("FEEDBACK_COMPANY_UPDATESETTING_FAILED", " setting updated failed!");
define("FEEDBACK_COMPANY_LOGGED_ERROR", " Please select your log in company before your operation");
define("FEEDBACK_COMPANY_ACCESS_PROHIBIT", "You have't permision to access this page");
define("FEEDBACK_COMPANY_LOGGED", " You are logged. Click the top menu for your actions in the backoffice");
define("FEEDBACK_COMPANY_LOG_FAILED", "Login failed. Please check you select company");
define("FEEDBACK_COMPANY_UPDATE_INFO_SUCCESS", " Compnay information successfully updated");
define("FEEDBACK_COMPANY_UPDATE_INFO_FAILED", " Compnay information updated failed");
define("FEEDBACK_COMPANY_CONFIRM_EMAIL_RECIPT_ERROR", "Confirm email  recipient's email string contain invalid email address");
define("FEEDBACK_COMPANY_ONREQ_EMAIL_RECIPT_ERROR", "On request email  recipient's email string  contain invalid email address");
define("FEEDBACK_COMPANY_SMS_ALERT_ERROR", "SMS alert no's string contain invalid phone no");
define("FEEDBACK_VEHICLE_CAT_NAME_INVALID", "Selected category  all redy exist!");
define("FEEDBACK_VEHICLE_CAT_PERCODE_ERROR", "Selected category does't exist");
define("FEEDBACK_VEHICLE_TYP_NAME_INVALID", "Selected type all redy exist!");
define("FEEDBACK_VEHICLE_BRAND_NAME_INVALID", "Selected brand all redy exist!");
define("FEEDBACK_VEHICLE_TYP_PERCODE_ERROR", "Selected type does't exist");
define("FEEDBACK_VEHICLE_BRN_PERCODE_ERROR", "Selected brand does't exist");
define("FEEDBACK_ADD_VEHICLE_NAME_EMPTY", "Please enter vehicle name");
define("FEEDBACK_ADD_VEHICLE_CAT_EMPTY", "You must enter at least one of category,type or brand");
define("FEEDBACK_ADD_VEHICLE_NAME_ERROR", "vehicle name invalid,contain special charcters");
define("FEEDBACK_EDIT_VEHICLE", "Vehicle Code Error");
define("FEEDBACK_ADD_VEHICLE_SUCCESS", "New vehicle successfully added");
define("FEEDBACK_ADD_VEHICLE_EDIT_SUCCESS", "Vehicle successfully edit");
define("FEEDBACK_ADD_VEHICLE_EDIT_FAILED", "Vehicle edit failed");
define("FEEDBACK_ADD_VEHICLE_DELETE_SUCCESS", "Vehicle successfully deleted");
define("FEEDBACK_ADD_VEHICLE_DELETE_FAILED", "Vehicle delete failed");
define("FEEDBACK_ADD_VEHICLE_FAILED", "New vehicle added failed");
define("FEEDBACK_INVENTORY_SELECT_DAYS_TOO_LONG", "Selected dates range too long,Please select lessthan one year time");
define("FEEDBACK_INVENTORY_SELECT_DAYS_TOO_ERROR", "Check your start date lager than end date or both are selected");
define("FEEDBACK_INVENTORY_SELECT_DAYS_EMPTY", "Select start and end date");
define("FEEDBACK_AMENDMENT_ALLREDY_EXIST", "Amendment allredy setup");
define("FEEDBACK_FEATURE_ALLREDY_EXIST", "Feature allredy setup");
define("FEEDBACK_ADDON_VEHICLE_EMPTY", "Please select vehicle for add on");
define("FEEDBACK_ADDON_NAME_EMPTY", "Please enter addon name");
define("FEEDBACK_ADDON_VALUE_EMPTY", "Please atleast LKR or USD rate");
define("FEEDBACK_ADDON_MAX_SETUP", "Please add max setup limit");
define("FEEDBACK_ADDON_TYPE_SETUP", "Please select addon type");
define("FEEDBACK_ADDON_NEW", "New addon successfully save");
define("FEEDBACK_ADDON_DRIVEROPTION", "Please select driver option");
define("FEEDBACK_ADDON_DELETE_SUCCESS", "Addon successfully deleted");
define("FEEDBACK_ADDON_DELETE_FAILED", "Addon delete failed");
define("FEEDBACK_ADDON_DELETE_ADDONE_EMPTY", "Please select addon");
define("FEEDBACK_ADDON_EDIT_SUCCESS", "Addon successfully edited");
define("FEEDBACK_IMAGE_EMPTY", "No selecte file for upload");
define("FEEDBACK_IMAGE_TYPE_ERROR", "File type should be 'jpg', 'jpeg', 'png', 'gif' format");
define("FEEDBACK_IMAGE_SIZE_ERROR", "File size  should be less than  5000 * 1024");
define("FEEDBACK_IMAGE_MAX_WIDTH_ERROR", "File width exceed");
define("FEEDBACK_IMAGE_MAX_HEIGHT_ERROR", "File width exceed");
define("FEEDBACK_IMAGE_UPLOAD_PARH_ERROR", "File upload parth error");
define("FEEDBACK_IMAGE_VEHICLE_ERROR", "Specific vehicle no found");
define("FEEDBACK_IMAGE_NOT_FOUND", "Image not found");
define("FEEDBACK_IMAGE_UPLOAD_SUCCESS", "Image successfully uploaded");
define("FEEDBACK_IMAGE_DELETE_SUCCESS", "Image successfully deleted");
define("FEEDBACK_LOCATION_EMPTY", "Please enter location");
define("FEEDBACK_DELETE_LOCATION_EMPTY", "Delete location undefine");
define("FEEDBACK_DELETE_LOCATION_SUCCESS", "Location successfully deleted");
define("FEEDBACK_DELETE_LOCATION_FAILED", "Location delete failed");
define("FEEDBACK_RATE_DELETE_EMPTY", "No specific record for delete");
define("FEEDBACK_RATE_EDIT_EMPTY", "No specific record for edit");
define("FEEDBACK_RATE_FIELDS_EMPTY", "Please select driver option ,vehicle and curruncy");
define("FEEDBACK_RATE_PERIOD_EXIST", "Rate allredy exist for selected date range");
define("FEEDBACK_OFFER_REQUIRED_FIELD", "Please select offer type and offer for");
define("FEEDBACK_OFFER_VEHICLE_INFO_EMPTY", "Please enter at least vehicle name,category,type,brand with driver option");
define("FEEDBACK_OFFER_VEHICLE_CUS_BOOKING_DATE_EMPTY", "Customer booking from date and to date requird");
define("FEEDBACK_OFFER_VEHICLE_OFFER_DETAIL_EMPTY", "Offer detail required");
define("FEEDBACK_OFFER_VEHICLE_OFFER_SAVE", "Offer successfully save");
define("FEEDBACK_OFFER_VEHICLE_BANK_DETAIL_EMPTY", "Bank name and card type requird");
define("FEEDBACK_OFFER_VEHICLE_PROMOCODE_EMPTY", "Promotion code required");
define("FEEDBACK_OFFER_VEHICLE_EARLY_BIRD_DAYS", "Early bird days required");
define("FEEDBACK_OFFER_VEHICLE_EARLY_VALID_PERIOD_EMPTY", "Customer bookin dates or checking dates required");
define("FEEDBACK_OFFER_SAVE", "Offer successfully save");
define("FEEDBACK_OFFER_SAVE_ERROR", "Offer failed to save");
define("FEEDBACK_POLICY_EMPTY_FIELDS", "Please select driver option and policy for");
define("FEEDBACK_POLICY_UPDATE_SUCCESS", "Policy successfully update");
define("FEEDBACK_POLICY_UPDATE_FAILED", "Policy update failed");
define("FEEDBACK_GET_LOCATION_DRIVE_OPTION_EMPTY", "Please select driver option");
define("FEEDBACK_SAVE_PICKUP_LOCATION_EXIST", "New Pickup location allredy exist");

define("FEEDBACK_RESERVATION_CUSTOMER_INFO_NOTFULLFILL", "Please enter all fields in customer info");
define("FEEDBACK_RESERVATION_CUSTOMER_EMAIL_WRONG", "Confirmation email is invalid");
define("FEEDBACK_RESERVATION_CUSTOMER_INVALID_EMAIL", "Customer email invalid");
define("FEEDBACK_RESERVATION_CUSTOMER_MOBILE_INVALID", "Customer mobile invalid");
define("FEEDBACK_RESERVATION_CUSTOMER_NICORPASSPORT_INVALID", "Customer NIC or Passport number invalid");
define("FEEDBACK_RESERVATION_CUSTOMER_CC_CVC_ERROR", "CVC number invalid");
define("FEEDBACK_RESERVATION_CUSTOMER_CC_INVALID", "Invalid credit card number");
define("FEEDBACK_RESERVATION_CUSTOMER_CC_INFO_EMPTY", "Please enter all fields in payment info");

define("FEEDBACK_REQUEST_RESPONSE_RESOPTION_EMPTY", "Please select your reponse option");
define("FEEDBACK_REQUEST_RESPONSE_AMOUNT_EMPTY", "Please add your reponse amount");

define("FEEDBACK_REQUEST_RESPONSE_SEND", "Your reponse successfully send to the customer");
define("FEEDBACK_REQUEST_RESPONSE_SEND_FAILED", "Your response failed to send.Please try again");

define("FEEDBACK_REPORT_DATE_RANGE_EMPTY", "Please enter from and to date");
define("FEEDBACK_REPORT_DATA_NON", "No record found!");

define("FEEDBACK_BOOKING_CANCEl_NOT_VALID_NUM", "Entered booking number not valid number!");
define("FEEDBACK_BOOKING_CANCElED", "This booking all redy canceled!");
define("FEEDBACK_BOOKING_CANCElED_STATUS_NOT_VALID", "This booking not confirmed booking");
define("FEEDBACK_BOOKING_CANCElED_PICKUP_DATE_ERROR", "Can't cancel booking.pickup  date exceed the today");
define("FEEDBACK_BOOKING_CANCElED_PER_DATE_ERROR", "Can't cancel booking.Cancel date not in cancel period");
define("FEEDBACK_BOOKING_CANCElED_SUCCESS", "Booking successfully cancled!");

define("FEEDBACK_NEW_USER_SET_ALL_FIELDS", "Select or enter value for all fields");
define("FEEDBACK_NEW_USER_EMAIL_ERROR", "User email not valid email address");
define("FEEDBACK_PASSWORD_LENGTH", "Password length should be 6 to 10");
define("FEEDBACK_PASSWORD_NOT_MATCH", "Entered password and confirmed password not match");
define("FEEDBACK_NEW_USER_SUCCESS", "New user successfully created");
define("FEEDBACK_NEW_USER_FAILED", "Failed create new user");
define("FEEDBACK_NEW_USER_EMAIL_EXIST", "Entered email all redy registered email");

define("FEEDBACK_PASSWORD_CHANGE", "Incorrect old password");
define("FEEDBACK_PASSWORD_CHANGE_SUCCESS", "Password successfully change");
define("FEEDBACK_PASSWORD_CHANGE_FAILED", "Password changed failed");

define("FEEDBACK_FROGOT_PASSWORD_CAPCHA_FAILED", "The code you entered is incorrect. Please try again");
define("FEEDBACK_FROGOT_PASSWORD_EMAIL_FAILED", "You are not valid user");
define("FEEDBACK_FROGOT_PASSWORD_NEW", "You have requested that new password details be sent to you via email");
define("FEEDBACK_FROGOT_PASSWORD_NEW_FAILED", "Failed. Please try again");

define("FEEDBACK_USER_STATUS_INVALID", "Invalid user status.");
define("FEEDBACK_USER_STATUS_UPDATE_FAILED", "Sorry,can't complete your process");
define("FEEDBACK_USER_STATUS_UPDATE_SUCCESS", "User status changed");

define("FEEDBACK_USER_DELETE_SUCCESS", "User successfully deleted");
define("FEEDBACK_USER_DELETE_FAILED", "Failed to delete user");

define("FEEDBACK_OFFER_EMPTY", "Not found any offer");

define("FEEDBACK_OFFER_UPDATE_SUCESS", "Offer successfully updated");
define("FEEDBACK_OFFER_UPDATE_FAILED", "Failed offer update");

define("FEEDBACK_COMPANY_DETAIL_SMS_NUMBER_NO_CODE", "Invalid SMS alert no.Please enter SMS no with country code Ex:94xxxxxxxx");

define("FEEDBACK_NOT_VALID_CC1", "Your Credit card not valid");
define("FEEDBACK_NOT_VALID_CC2", "number");

define("FEEDBACK_BOOKING_CANCEL_NUMBER_ERROR", "Booking id not valid format");


define("FEEDBACK_DATE_INVALID", "Date not valid format");
define("FEEDBACK_RESPONSE_REQUEST_VALUE_EMPTY", "Plese eneter your response amount");

define("FEEDBACK_EXCEED_MAX_LENGTH", "exceed max length");

define("FEEDBACK_INVALID_RATE", "Rate must be numbers or decimal only(If decimal using 2 maximum decimal points) ");
define("FEEDBACK_NO_USERS", "Not found any users!");
define("FEEDBACK_BACKOFFICE_REPORT_VOUCHER_ERROR", "Sorry,Can't fount reservation information for genarate print view!");
define("MAX_UPLOAD_SIZE", 5000 * 1024);

define("USDCONVERT", 133);