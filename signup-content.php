<?php
if (DEBUG) {
    print '<!-- Loading contact content -->' . PHP_EOL;
}
$pmkUserID = null;
$name = '';
$username = '';
$password = '';
$confirmPassword = '';
$email = '';
$phoneNumber = '';
$permissions = 'none';
if (DEBUG) {
    print '<!-- Variables initialized -->' . PHP_EOL;
}
?>

<main id="main" class="main grid-layout">
    <section class="form">
        <form id="signup-form" method="post">
            <h2 class="form-title">Sign-Up</h2>
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $dataIsGood = true;
                    $username = getData('txtUsername');
                    $password = getData('txtPassword');
                    $confirmPassword = getData('txtConfirmPassword');
                    $name = getData('txtName');
                    $email = getData('txtEmailAddress');
                    $phoneNumber = getData('txtPhoneNumber');

                    if (DEBUG) {
                        print '<!-- Data loaded from form -->' . PHP_EOL;
                    }
                    if ($username == "") {
                        print '<p class="mistake">Must enter username</p>';
                        $dataIsGood = false;
                    } elseif (!verifyLoginField($username)) {
                        print '<p class="mistake">Username contains invalid characters</p>' . PHP_EOL;
                        $dataIsGood = false;
                    }
                    if ($password != $confirmPassword) {
                        print '<p class="mistake">Passwords must match</p>';
                        $dataIsGood = false;
                    } else {
                        if ($password == "") {
                            print '<p class="mistake">Must enter password</p>';
                            $dataIsGood = false;
                        } elseif (!verifyLoginField($password)) {
                            print '<p class="mistake">Password contains invalid characters</p>' . PHP_EOL;
                            $dataIsGood = false;
                        }
                    }
                    
                    if ($name == "") {
                        print '<p class="mistake">Must enter name</p>' . PHP_EOL;
                        $dataIsGood = false;
                    } elseif (!verifyAlphaNum($name)) {
                        print '<p class="mistake">Name contains invalid characters</p>' . PHP_EOL;
                        $dataIsGood = false;
                    }
                    if ($email == "") {
                        print '<p class="mistake">Must enter email address.</p>';
                        $dataIsGood = false;
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        print '<p class="mistake">Your email isn\'t correct.</p>';
                        $dataIsGood = false;
                    }
                    if ($phoneNumber == "") {
                        print '<p class="mistake">Must enter phone number</p>' . PHP_EOL;
                        $dataIsGood = false;
                    } elseif (!verifyAlphaNum($phoneNumber)) {
                        print '<p class="mistake">Phone number contains invalid characters</p>' . PHP_EOL;
                        $dataIsGood = false;
                    }

                    if (DEBUG) {
                        print '<!-- Form data sanitized -->' . PHP_EOL;
                    }

                    if($dataIsGood) {
                        $success = false;
                        $newUser = new User($username, $password, $name, $email, $phoneNumber);
                        $newUser->makeUserAccount() ? $success = true : $succes = false;
                        if ($success) {
                            print '<h2 class="formSuccess">Account Created!</h2>';
                        }
                    }
                }
            ?>
            <fieldset id="login-fields">
                <p>
                    <label for="txtUsername" class="block">Username</label>
                    <input id="txtUsername" type="text" name = "txtUsername" value="<?php print $username; ?>" required class="wide-input">
                </p>

                <p>
                    <label for="txtPassword" class="block">Password</label>
                    <input id="txtPassword" type="password" name = "txtPassword" value="<?php print $password; ?>" required class="wide-input">
                </p>

                <p>
                    <label for="txtConfirmPassword" class="block">Confirm Password</label>
                    <input id="txtConfirmPassword" type="password" name = "txtConfirmPassword" value="<?php print $confirmPassword; ?>" required class="wide-input">
                </p>
            </fieldset>

            <fieldset id="user-fields">
                <p>
                    <label for="txtName" class="block">Name</label>
                    <input id="txtName" type="text" name="txtName" value="<?php print $name; ?>" required class="wide-input">
                </p>

                <p>
                    <label for="txtEmailAddress" class="block">Email Address</label>
                    <input id="txtEmailAddress" type="text" name="txtEmailAddress" value="<?php print $email; ?>" required class="wide-input">
                </p>

                <p>
                    <label for="txtPhoneNumber" class="block">Primary Phone Number</label>
                    <input id="txtPhoneNumber" type="text" name="txtPhoneNumber" value="<?php print $phoneNumber; ?>" required class="wide-input">
                </p>
            </fieldset>

            <p class="center">
                <input type="submit" value="Submit" class="wide-input submit">
            </p>
        </form>
    </section>

    <?php
    include 'socials.php';
    include 'direct-contact.php';
    ?>
</main>