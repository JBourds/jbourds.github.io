<?php
if (DEBUG) {
    print '<!-- Loading contact content -->' . PHP_EOL;
}
$username = '';
$password = '';
if (DEBUG) {
    print '<!-- Variables initialized -->' . PHP_EOL;
}
?>

<main id="main" class="main grid-layout">
    <section class="form">
        <form id="login-form" method="post">
            <h2 class="form-title">Login</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $dataIsGood = true;
                $username = getData('txtUsername');
                $password = getData('txtPassword');

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
                if ($password == "") {
                    print '<p class="mistake">Must enter password</p>';
                    $dataIsGood = false;
                } elseif (!verifyLoginField($password)) {
                    print '<p class="mistake">Password contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if (DEBUG) {
                    print '<!-- Form data sanitized -->' . PHP_EOL;
                }

                if ($dataIsGood) {
                    $success = (new Login($username, $password))->getSuccess();
                    if ($success) {
                        print '<h2 class="formSuccess">Login Successfull!</h2>';
                    } else {
                        print '<h2 class="mistake">Login Failed!</h2>';
                    }
                }
            }
            ?>
            <fieldset id="login-fields">
                <p>
                    <label for="txtUsername" class="block">Username</label>
                    <input id="txtUsername" type="text" name="txtUsername" value="<?php print $username; ?>" required class="wide-input">
                </p>

                <p>
                    <label for="txtPassword" class="block">Password</label>
                    <input id="txtPassword" type="password" name="txtPassword" value="<?php print $password; ?>" required class="wide-input">
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