<nav class="nav" name="nav" id="nav">
    <a class="<?php
                if (PATH_PARTS['filename'] == "index") {
                    print 'activePage';
                }
                ?>" href="<?php print $directoryPrefix; ?>index.php">Home</a>
    <a class="<?php
                if (PATH_PARTS['filename'] == "resume") {
                    print 'activePage';
                }
                ?>" href="<?php print $directoryPrefix; ?>resume.php">Resume</a>
    <a class="<?php
                if (PATH_PARTS['filename'] == "contact") {
                    print 'activePage';
                }
                ?>" href="<?php print $directoryPrefix; ?>contact.php">Contact Me</a>
</nav>