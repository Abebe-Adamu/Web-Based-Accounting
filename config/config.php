<?php

setlocale(LC_MONETARY, ' en_US.UTF-8');
defined('SITE_NAME') or define('SITE_NAME', 'Chart of Accounts');
defined('SITE_DESCRIPTION') or define('SITE_DESCRIPTION', 'This is a simple bank application');

if (dirname(__FILE__) == '/home/vagrant/custom_bank/config') {

    $env = 'dev';

} else if (dirname(__FILE__) == '/home/vagrant/chart_of_accounts/config') {
    $env = 'staging';
} else {

    $env = 'prod';
}


if ($env == 'prod') {
    defined('DB_HOST') or define('DB_HOST', 'localhost');
    defined('DB_USER') or define('DB_USER', 'root');
    defined('DB_PASS') or define('DB_PASS', '');
    defined('DB_NAME') or define('DB_NAME', 'custom_bank');

} else if ($env == 'staging') {
    defined('DB_HOST') or define('DB_HOST', 'localhost');
    defined('DB_USER') or define('DB_USER', 'root');
    defined('DB_PASS') or define('DB_PASS', '');
    defined('DB_NAME') or define('DB_NAME', 'chart_of_accounts');
} else {

    defined('DB_HOST') or define('DB_HOST', 'localhost');
    defined('DB_USER') or define('DB_USER', 'root');
    defined('DB_PASS') or define('DB_PASS', '');
    defined('DB_NAME') or define('DB_NAME', 'custom_bank');

}


