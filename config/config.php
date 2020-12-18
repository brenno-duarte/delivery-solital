<?php

/**
 * CONFIG CONSTANTS
 */
define('ERRORS_DISPLAY', true);

/**
 * GUARDIAN CONSTANTS
 */

define('URL_LOGIN', '/admin/login');
define('URL_DASHBOARD', '/admin/dashboard');
define('INDEX_LOGIN', 'solital_index_login');

/**
 * OPENSSL CONSTANTS
 */

define('SECRET_IV', pack('a16', 'first_secret'));
define('SECRET', pack('a16', 'second_secret'));

/**
 * EMAIL CONSTANTS
 */
define('EMAIL', [
    'SENDER' => 'brennoduarte2015@outlook.com',
    'RECIPIENT' => 'brennoduarte2015@outlook.com'
]);

/**
 * MONOLOG DIRECTORY
 */
define('MONOLOG_DIR', dirname(__DIR__).'/app/LogFiles/');

/**
 * UPLOAD FILES DIRECTORY
 */
define('UP_DIR', '/var/www/html/Delivery-solital/public/assets/_img');