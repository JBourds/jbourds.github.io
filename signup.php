<?php
include 'top.php';
include LIB_PATH . 'User.php';
if (DEBUG) {
    print '<!-- Top Loaded -->';
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'signup-content.php';
if (DEBUG) {
    print '<!-- Signup Form Loaded -->';
}
include 'footer.php';
if (DEBUG) {
    print '<!-- Footer Loaded -->';
}
?>