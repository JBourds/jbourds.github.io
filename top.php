<?php
include 'lib/constants.php';
$directoryDepth = 0; 
    $domainLength = strlen(DOMAIN);
    $labPrefix = '';
    // Loop through every character in the path after the domain to determine the depth of the file
    for ($index = $domainLength + 1; $index < strlen(BASE_PATH); $index++) { // + 1 ignores the backslash after the domain
        // Since this comes directly after the domain, it will pull the first two directories after the domain <cs148/<lab>/
        if ($directoryDepth < 2) {
            $labPrefix .= BASE_PATH[$index];
        }
        if (BASE_PATH[$index] == '/') {
            $directoryDepth++;
        }
        
    }
    // Creates the prefix to put in front of relative links based on how far down in the directory it is in order to bring user to the www-root/ directory
    $directoryPrefix = '';
    for ($step = 0; $step < $directoryDepth; $step++) {
        $directoryPrefix .= '../';
    }

    // Pulls the folder and lab directory out of the base path variable and adds it to the directory prefix.
    $directoryPrefix .= $labPrefix;

    // Additional debugging statement
    if (DEBUG) {
        print '<p>' . $directoryPrefix . '</p>';
    }

    // Get the file name to display the correct css page
    $fileName = PATH_PARTS['filename'];

?>

<!DOCTYPE html)>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jordan Bourdeau Portfolio</title>
    <meta name="Author" content="Jordan Bourdeau">
    <meta name="Description" content="Jordan Bourdeau Programming Portfolio">
    <link rel="stylesheet" type="text/css" href="<?php print $directoryPrefix; ?>css/main.css?version=<?php print time(); ?>">
    <link rel="stylesheet" type="text/css" href="<?php print $directoryPrefix; ?>css/<?php print $fileName; ?>.css?version=<?php print time(); ?>">
    <link rel="stylesheet" type="text/css" media="(max-width: 600px)" href="<?php print $directoryPrefix; ?>css/phone.css?version=<?php print time(); ?>">
    <link rel="stylesheet" type="text/css" media="(max-width: 1100px)" href="<?php print $directoryPrefix; ?>css/tablet.css?version=<?php print time(); ?>">
    <link rel="stylesheet" type="text/css" media="(min-width: 3000px)" href="<?php print $directoryPrefix; ?>css/ultrawide.css?version=<?php print time(); ?>">
</head>

<body>

<?php
include 'header.php';
include 'nav.php';
?>