<a href="#nav">
    <p class="arrow down"></p>
</a>


    <?php
    if($fileName == "index") {
        print '
        <header class="paper-background">
        <div class="toprow header-grid-layout">
        <p class="left-side card">802.782.3288</p>
        <p class="right-side-top card">
            <span class="align-right">University of Vermont</span>
        </p>
        <p class="right-side-bottom card">Computer and Data Science Major</p>
        </div>

        <div class="middlerow">
            <h1 class="title card">Jordan Bourdeau</h1>
            <p class="card">Programmer</p>
        </div>

        <div class="bottomrow">
            <a href="contact.php" class="right-side card">Contact:
                <span class="bold">Phone Email Social Media</span>
            </a>
        </div>
        ' . PHP_EOL;
    }

    else {
        print '<header class="universal-header-text">
        <h1 class="header">Jordan Bourdeau Portfolio</h1>' . PHP_EOL;
    }
    ?>

    

</header>