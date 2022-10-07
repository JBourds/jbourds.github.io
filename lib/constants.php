<?php
define('DEBUG', FALSE);

$_SERVER = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);

define('SERVER', $_SERVER['SERVER_NAME']);

define ('DOMAIN', '//' . SERVER);

define ('PHP_SELF', $_SERVER['PHP_SELF']);
define('PATH_PARTS', pathinfo(PHP_SELF));

define('BASE_PATH', DOMAIN . PATH_PARTS['dirname'] . '/');

define ('LIB_PATH', 'lib/');

define ('DATABASE_NAME', 'JBOURDE2_resume');

define ('CONTACT_TABLE', 'tblResumeContactForm');
define ('ACCOUNTS_TABLE', 'tblResumeUserAccount');
define ('INFO_TABLE', 'tblResumeUserInfo');

define ('THROW_NONE', 0);
define('THROW_DUPLICATE_USERNAME', 1);
define('THROW_ALPHA_NUM', 2);
define('THROW_SIZE', 3);
define('ACCOUNT_NOT_CREATED', 4);
define('INFO_NOT_CREATED', 5);


if (str_contains(BASE_PATH, 'live')) {
    define ('SITE_STATUS', 'live/');
}
elseif (str_contains(BASE_PATH, 'dev')) {
    define ('SITE_STATUS', 'dev/');
}
else {
    define ('SITE_STATUS', '');
}

define ('URL', 'https://jbourde2.w3.uvm.edu/resume/' . SITE_STATUS);

if(DEBUG) {
    print '<p>' . 'Domain: ' . DOMAIN . '</p>';
    print '<p>' . 'PATH_PARTS file name: ' . PATH_PARTS['filename'] . '</p>';
    print '<p>' . 'PHP_SELF: ' . PHP_SELF . '</p>';
    print '<p>' . 'BASE_PATH: ' . BASE_PATH . '</p>';
    print '<p>' . 'LIB_PATH: ' . LIB_PATH . '</p>';
    print '<p>' . 'DATABASE_NAME: ' . DATABASE_NAME . '</p>';
    print '<p>' . 'CONTACT_TABLE: ' . CONTACT_TABLE . '</p>';
    print '<p>' . 'ACCOUNTS_TABLE: ' . ACCOUNTS_TABLE . '</p>';
    print '<p>' . 'INFO_TABLE: ' . INFO_TABLE . '</p>';
    print '<p>' . 'SITE_STATUS: ' . SITE_STATUS . '</p>';
}
?>
<!-- CONSTANTS LOADED -->