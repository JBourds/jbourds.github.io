<?php
include 'top.php';
include LIB_PATH . 'DataBase.php';
if (DEBUG) {
    print '<!-- Top Loaded -->';
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'contact-content.php';
if (DEBUG) {
    print '<!-- Contact Form Loaded -->';
}
include 'footer.php';
if (DEBUG) {
    print '<!-- Footer Loaded -->';
}
?>