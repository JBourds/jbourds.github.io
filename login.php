<?php
include 'top.php';
include LIB_PATH . 'Login.php';
if (DEBUG) {
    print '<!-- Top Loaded -->';
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'login-content.php';
if (DEBUG) {
    print '<!-- Login Form Loaded -->';
}
include 'footer.php';
if (DEBUG) {
    print '<!-- Footer Loaded -->';
}
?>