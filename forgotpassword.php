<?php
$forgotPasswordUsername = '';
$forgotPasswordEmail = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validUsername = true;
    $forgotPasswordUsername = getData('txtForgotPasswordUsername');
    if ($forgotPasswordUsername == "") {
        print '<p class="mistake">Must enter a username</p>';
        $validUsername = false;
    } elseif (verifyLoginField($forgotPasswordUsername)) {
        print '<p class="mistake">Username contains invalid characters</p>' . PHP_EOL;
        $validUsername = false;
    }

    $user = new User($forgotPasswordUsername, '', '', '', '');
}
?>
<form id="forgot-password" method="post">
<fieldset id="username">
    <p>
        <label for="txtForgotPasswordUsername" class="block">Username</label>
        <input id="txtForgotPasswordUsername" type="text" name="txtForgotPasswordUsername" value="<?php print $forgotPasswordUsername; ?>" required class="wide-input">
    </p>

</fieldset>

<p class="center">
    <input type="submit" value="Send reset password link" class="wide-input submit">
</p>
</form>