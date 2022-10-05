<?php
include 'top.php';
?>

<main id="main" class="main grid-layout">

    <section class="introduction">
        <h2>Hello and Welcome!</h2>
        <p>This is the portfolio website for Jordan Bourdeau,
            rising sophomore Computer/Data Science double major at the University of
            Vermont.
            I will be updating this website as I grow and create
            more projects related to software development, data science, machine
            learning,
            and anything else which I find interesting!
        </p>
        <h2 class="bold">What are you interested in?</h2>
        <ul class="section-list">
            <li>
                <a href="resume.php#education">Education</a>
            </li>
            <li>
                <a href="resume.php#experience">Experience</a>
            </li>
            <li>
                <a href="resume.php#relevant-coursework">Relevant Coursework</a>
            </li>
            <li>
                <a href="resume.php#projects">Projects</a>
            </li>
        </ul>

    </section>

    <section class="img-section">
        <div class="img-div">
            <img alt="Me in a tuxedo at a McDonalds" src="images/dapperpicture.jpg">
            <figcaption>Me in a McDonalds wearing a tuxedo</figcaption>
        </div>
    </section>

    <section class="aboutMe shadow">
        <h2>About Me</h2>
        <p>I'm a UVM student double majoring in computer and data science. My primary interests are in software engineering and data science, more specifically machine learning and AI.
            My interest in computers dates back to my grandfather who was an IT person for as long as computers had problems to fix. I attribute a lot of my interest in playing computers to him.
            In addition to my interest in computers, I am also an avid gym-goer/recreational powerlifter.
        </p>
        <a href="resume.php#projects" class="block aboutMe">Check out my Coding Projects!</a>
        <a href="https://www.openpowerlifting.org/u/jordanbourdeau" target = "_blank" class="block aboutMe">Check out my Open Powerlifting Page!</a>
    </section>

</main>

<?php
include 'footer.php';
?>