<?php

function verifyAlphaNum($testString)
{
    return (preg_match("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}

function verifyLoginField($testString) {
    return (preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/", $testString));
}

function getData($field)
{
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

?>