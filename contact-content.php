<?php
if (DEBUG) {
    print '<!-- Loading contact content -->' . PHP_EOL;
}
$pmkFormID = null;
$name = '';
$company = '';
$emailAddress = '';
$primaryPhoneType = 'cell';
$primaryPhoneNumber = '';
$secondaryPhoneType = '';
$secondaryPhoneNumber = '';
$inquiryType = 'general';
$inquiryDetails = '';
$additionalComments = '';
if (DEBUG) {
    print '<!-- Variables initialized -->' . PHP_EOL;
}
$dataBase = new DataBase('jbourde2_writer', DATABASE_NAME);
if (DEBUG) {
    print '<!-- Database connection made -->' . PHP_EOL;
}

// Temporary use until better authentication function is found
$validUser = TRUE;
if ($validUser) {
    if (DEBUG) {
        print '<!-- Valid user found -->' . PHP_EOL;
    }
    $pmkFormID = (isset($_GET['formID']) ? (int) htmlspecialchars($_GET['formID']) : null);

    if ($pmkFormID > 0) {
        $sql = 'SELECT fldName, fldCompany, fldEmail, fldPrimaryPhoneType, fldPrimaryPhoneNumber, fldSecondaryPhoneType, fldSecondaryPhoneNumber, fldInquiryType, fldInquiryDetails, fldAdditionalComments ';
        $sql .= 'FROM ' . CONTACT_FORM . ' ';
        $sql .= 'WHERE pmkFormID = ?';

        $records = $dataBase->select($sql, array($pmkFormID));

        if (!empty($records)) {
            $name = $records[0]['fldName'];
            $company = $records[0]['fldCompany'];
            $emailAddress = $records[0]['fldEmail'];
            $primaryPhoneType = $records[0]['fldPrimaryPhoneType'];
            $primaryPhoneNumber = $records[0]['fldPrimaryPhoneNumber'];
            $secondaryPhoneType = $records[0]['fldSecondaryPhoneType'];
            $secondaryPhoneNumber = $records[0]['fldSecondaryPhoneNumber'];
            $inquiryType = $records[0]['fldInquiryType'];
            $inquiryDetails = $records[0]['fldInquiryDetails'];
            $additionalComments = $records[0]['fldAdditionalComments'];
            if (DEBUG) {
                print '<!-- Variables initialized from database -->' . PHP_EOL;
            }
        }
    }
}

if (DEBUG) {
    print '<p>' . 'Form Variables' . '<p>';
    print '<p>' . $pmkFormID . '<p>';
    print '<p>' . $emailAddress . '<p>';
    print '<p>' . $primaryPhoneType . '<p>';
    print '<p>' . $primaryPhoneNumber . '<p>';
    print '<p>' . $secondaryPhoneType . '<p>';
    print '<p>' . $secondaryPhoneNumber . '<p>';
    print '<p>' . $inquiryType . '<p>';
    print '<p>' . $inquiryDetails . '<p>';
    print '<p>' . $additionalComments . '<p>';
}

function verifyAlphaNum($testString)
{
    return (preg_match("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
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

<main id="main" class="main grid-layout">

    <section class="form">
        <form id="contact-form" method="post">

            <h2 class="form-title">Contact Form</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $dataIsGood = true;
                $name = getData('txtName');
                $company = getData('txtCompany');
                $emailAddress = getData('txtEmailAddress');
                $emailAddress = filter_var($emailAddress, FILTER_SANITIZE_EMAIL);
                $primaryPhoneType = getData('radPrimaryPhoneType');
                $primaryPhoneNumber = getData('txtPhoneNumber');
                $secondaryPhoneType = getData('radSecondPhoneType');
                $secondaryPhoneNumber = getData('txtSecondPhoneNumber');
                $inquiryType = getData('lstInquiryType');
                $inquiryDetails = getData('txtInquiryDetails');
                $additionalComments = getData('txtAdditionalComments');
                if (DEBUG) {
                    print '<!-- Data loaded from form -->' . PHP_EOL;
                }

                if ($name == "") {
                    print '<p class="mistake">Must enter name</p>' . PHP_EOL;
                    $dataIsGood = false;
                } elseif (!verifyAlphaNum($name)) {
                    print '<p class="mistake">Name contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if ($company == "") {
                    print '<p class="mistake">Must enter company</p>' . PHP_EOL;
                    $dataIsGood = false;
                } elseif (!verifyAlphaNum($company)) {
                    print '<p class="mistake">Company name contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if ($emailAddress == "") {
                    print '<p class="mistake">Must enter email address.</p>';
                    $dataIsGood = false;
                } elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                    print '<p class="mistake">Your email isn\'t correct.</p>';
                    $dataIsGood = false;
                }

                if ($primaryPhoneType == "") {
                    print '<p class="mistake">Must enter primary phone type</p>' . PHP_EOL;
                    $dataIsGood = false;
                } elseif (!verifyAlphaNum($primaryPhoneType)) {
                    print '<p class="mistake">Primary phone type contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if ($primaryPhoneNumber == "") {
                    print '<p class="mistake">Must enter primary phone number</p>' . PHP_EOL;
                    $dataIsGood = false;
                } elseif (!verifyAlphaNum($primaryPhoneNumber)) {
                    print '<p class="mistake">Primary phone number contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                // Secondary phone type/number can be empty but must contain valid characters
                if ($secondaryPhoneType == "") {
                   // Do nothing
                } elseif (!verifyAlphaNum($secondaryPhoneType)) {
                    print '<p class="mistake">Secondary phone type contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if ($secondaryPhoneType != "" && $secondaryPhoneNumber == "") {
                    print '<p class="mistake">Secondary phone number cannot be empty if type is selected. If this is a mistake, just re-enter your primary phone number.</p>' . PHP_EOL;
                    $dataIsGood = false;
                 }

                if ($secondaryPhoneNumber == "") {
                    // Do nothing
                } elseif (!verifyAlphaNum($secondaryPhoneNumber)) {
                    print '<p class="mistake">Secondary phone number contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                // These sections don't allow question marks in the input boxes?
                if ($inquiryType == "") {
                    print '<p class="mistake">Must select inquiry type</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if ($inquiryDetails == "") {
                    print '<p class="mistake">Must enter inquiry details</p>' . PHP_EOL;
                    $dataIsGood = false;
                } elseif (!verifyAlphaNum($inquiryDetails)) {
                    print '<p class="mistake">Inquiry details contains invalid characters</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if ($additionalComments == "") {
                    // Do nothing
                } elseif(!verifyAlphaNum($additionalComments)) {
                    print '<p class="mistake">Additional comments has unusable characters.</p>' . PHP_EOL;
                    $dataIsGood = false;
                }

                if (DEBUG) {
                    print '<!-- Form data sanitized -->' . PHP_EOL;
                }

                if ($dataIsGood) {
                    try {
                        $sql = 'INSERT INTO ' . CONTACT_FORM . ' SET 
                            pmkFormID = ?,
                            fldName = ?,
                            fldCompany = ?,
                            fldEmail = ?,
                            fldPrimaryPhoneType = ?,
                            fldPrimaryPhoneNumber = ?,
                            fldSecondaryPhoneType = ?,
                            fldSecondaryPhoneNumber = ?,
                            fldInquiryType = ?,
                            fldInquiryDetails = ?,
                            fldAdditionalComments = ? 
                            ON DUPLICATE KEY UPDATE
                            fldName = ?,
                            fldCompany = ?,
                            fldEmail = ?,
                            fldPrimaryPhoneType = ?,
                            fldPrimaryPhoneNumber = ?,
                            fldSecondaryPhoneType = ?,
                            fldSecondaryPhoneNumber = ?,
                            fldInquiryType = ?,
                            fldInquiryDetails = ?,
                            fldAdditionalComments = ?';
    
                        $params = array(
                            $pmkFormID, $name, $company, $emailAddress, $primaryPhoneType, $primaryPhoneNumber, $secondaryPhoneType, $secondaryPhoneNumber, $inquiryType, $inquiryDetails, $additionalComments,
                            $name, $company, $emailAddress, $primaryPhoneType, $primaryPhoneNumber, $secondaryPhoneType, $secondaryPhoneNumber, $inquiryType, $inquiryDetails, $additionalComments
                        );
    
                        if ($dataBase->insert($sql, $params)) {
                            // Get the newly insert primary key to create the link with
                            $sql = 'SELECT LAST_INSERT_ID()';
                            $pmkFormID = $dataBase->getLastID();

                            print '<h2 class="formSuccess">Form Submission Confirmed</h2>';
                            // Make the reply to address the person who is submitting the form
                            $replyAddress = $emailAddress;
                            $headers = "From: " . $replyAddress . "\r\n";
                            $headers .= "Reply-To: " . $replyAddress . "\r\n";
                            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                            $mailToAddress = 'jordanbourdeau03@outlook.com';
    
                            $subject = 'New Submission on Portfolio Website';
                            $message = '<html><body>' . PHP_EOL;
                            $message .= '<h1>Contact Form Submission:</h1>' . PHP_EOL;

                            
                            $message .= '<a href = "' . URL . 'contact.php?formID=' . $pmkFormID . '">View/Edit Submission Directly</a>';
                            $message .= '<p>Form ID: ' . $pmkFormID . '</p>' . PHP_EOL;
                            $message .= '<p>Name: ' . $name . '</p>' . PHP_EOL;
                            $message .= '<p>Company: ' . $company . '</p>' . PHP_EOL;
                            $message .= '<p>Email Address: ' . $emailAddress . '</p>' . PHP_EOL;
                            $message .= '<p>Primary Phone Type: ' . $primaryPhoneType . '</p>' . PHP_EOL;
                            $message .= '<p>Primary Phone Number: ' . $primaryPhoneNumber . '</p>' . PHP_EOL;
                            $message .= '<p>Secondary Phone Type: ' . $secondaryPhoneType . '</p>' . PHP_EOL;
                            $message .= '<p>Secondary Phone Number: ' . $secondaryPhoneNumber . '</p>' . PHP_EOL;
                            $message .= '<p>Inquiry Type: ' . $inquiryType . '</p>' . PHP_EOL;
                            $message .= '<p>Inquiry Details: ' . $inquiryDetails . '</p>' . PHP_EOL;
                            $message .= '<p>Additional Comments: ' . $additionalComments . '</p>' . PHP_EOL;
                            $message .= '</body></html>';
    
                            mail($mailToAddress, $subject, $message, $headers);
                        } else {
                            print '<h2 class="formFailure">Form Submission Failed</h2>';
                            foreach ($params as $param) {
                                $pos = strpos($sql, '?');
                                if ($pos !== false) {
                                    $sql = substr_replace($sql, '"' . $param . '"', $pos, strlen('?'));
                                }
                            }
                        }
    
                        // Debugging SQL Statement
                        print $dataBase::DB_DEBUG ? $dataBase->displaySQL($sql, $params) : '';
                    } catch (PDOException $e) {
                        print '<p>Couldn\'t insert the record, please contact the website admin.</p>';
                    }
            }
      
            }
            ?>
            <p class="center">I will try to respond to any contact forms within 48 business hours</p>
            <fieldset id="contact-fields">
                <legend class="bold">Contact Fields</legend>

                <p>
                    <label for="txtName" class="block">Name</label>
                    <input id="txtName" type="text" name="txtName" value="<?php print $name; ?>" required class="wide-input">
                </p>

                <p>
                    <label for="txtCompany" class="block">Company</label>
                    <input id="txtCompany" type="text" name="txtCompany" class="wide-input" value="<?php print $company; ?>">
                </p>

                <p>
                    <label for="txtEmailAddress" class="block">Email Address</label>
                    <input id="txtEmailAddress" type="text" name="txtEmailAddress" value="<?php print $emailAddress; ?>" required class="wide-input">
                </p>

                <p>Phone Number Type</p>

                <p>
                    <label for="radPrimaryPhoneType">Cell</label>
                    <input id="radPrimaryPhoneType" type="radio" name="radPrimaryPhoneType" value="cell" <?php if ($primaryPhoneType == "cell") print ' checked '; ?> required>
                </p>
                <p>
                    <label for="radPrimaryPhoneType">Work</label>
                    <input id="radPrimaryPhoneType" type="radio" name="radPrimaryPhoneType" value="work" <?php if ($primaryPhoneType == "work") print ' checked '; ?> required>

                </p>
                <p>
                    <label for="radPrimaryPhoneType">Home</label>
                    <input id="radPrimaryPhoneType" type="radio" name="radPrimaryPhoneType" value="home" <?php if ($primaryPhoneType == "work") print ' checked '; ?> required>

                </p>

                <p>
                    <label for="txtPhoneNumber" class="block">Primary Phone Number</label>
                    <input id="txtPhoneNumber" type="text" name="txtPhoneNumber" value="<?php print $primaryPhoneNumber; ?>" required class="wide-input">

                </p>

                <p>Phone Number Type</p>

                <p>
                    <label for="radSecondPhoneType">Cell</label>
                    <input id="radSecondPhoneType" type="radio" name="radSecondPhoneType" value="cell" <?php if ($secondaryPhoneType == "cell") print ' checked '; ?>>

                </p>
                <p>
                    <label for="radSecondPhoneType">Work</label>
                    <input id="radSecondPhoneType" type="radio" name="radSecondPhoneType" value="work" <?php if ($secondaryPhoneType == "work") print ' checked '; ?>>

                </p>
                <p>
                    <label for="radSecondPhoneType">Home</label>
                    <input id="radSecondPhoneType" type="radio" name="radSecondPhoneType" value="home" <?php if ($secondaryPhoneType == "home") print ' checked '; ?>>

                </p>

                <p>
                    <label for="txtSecondPhoneNumber" class="block">Secondary Phone Number (if applicable)</label>
                    <input id="txtSecondPhoneNumber" type="text" name="txtSecondPhoneNumber" value="<?php print $secondaryPhoneNumber; ?>" class="wide-input">

                </p>
            </fieldset>

            <fieldset id="inquiry-fields">
                <legend class="bold">Inquiry Fields</legend>

                <p>
                    <label for="lstInquiryType" class="block">Select your Inquiry Type</label>
                    <select name="lstInquiryType" name="lstInquiryType" required size="1" class="wide-input">
                        <option <?php if ($inquiryType == "job-opportunity") print ' selected '; ?>value="job-opportunity">Job Opportunity</option>
                        <option <?php if ($inquiryType == "commission") print ' selected '; ?>value="commission">Commission</option>
                        <option <?php if ($inquiryType == "question") print ' selected '; ?>value="question">Question</option>
                        <option <?php if ($inquiryType == "general") print ' selected '; ?>value="general">General</option>
                        <option <?php if ($inquiryType == "other") print ' selected '; ?>value="other">Other</option>
                    </select>
                </p>

                <p>
                    <label class="block" for="txtInquiryDetails">Inquiry Details</label>
                    <textarea id="txtInquiryDetails" name="txtInquiryDetails" value="<?php print $inquiryDetails; ?>" class="wide-input" required></textarea>
                </p>

                <p>
                    <label class="block" for="txtAdditionalComments">Additional Comments</label>
                    <textarea id="txtAdditionalComments" name="txtAdditionalComments" value="<?php print $additionalComments; ?>" class="wide-input"></textarea>
                </p>
            </fieldset>
            <p class="center">
                <input type="submit" value="Submit" class="wide-input submit">
            </p>
        </form>

    </section>

    <section class="socials">
        <h2>Follow me on Social Media!</h2>
        <a href="" class="center social-link">LinkedIn</a>
        <figure>
            <img src="">
        </figure>
        <a href="https://joinhandshake.com/employers/" class="center social-link">Handshake: jbourde2@uvm.edu</a>
        <figure>
            <img src="">
        </figure>
        <a href="https://www.instagram.com/jordan_bourdeau/?hl=en" class="center social-link">Instagram</a>
        <figure>
            <img src="">
        </figure>
        <a href="https://www.facebook.com/jordan.bourdeau.5" class="center social-link">Facebook</a>
        <figure>
            <img src="">
        </figure>
    </section>

    <section class="image1">
        <figure>
            <img>
            <figcaption></figcaption>
        </figure>
    </section>

    <section class="direct-contact">
        <h2>Contact me Directly</h2>
        <h3>Email</h3>
        <a href="mailto:jordanbourdeau03@outlook.com" class="contact-link">jordanbourdeau03@outlook.com</a>
        <h3>Cell Phone</h3>
        <a href="tel:+1(802)7823288" class="contact-link">802-782-3288</a>
    </section>

</main>