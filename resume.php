<?php
include 'top.php';
?>

    <main id="main" class="main grid-layout resume-background">

        <section class="resume-header">
            <section class = "section-header">
                <h2 class="bold">Jordan Bourdeau</h2>
                <div class="line"></div>
                <p class="address">15 Linda Avenue, Swanton VT 05488 | </p>

                <a href="contact.html" class="contact-me inline">Contact Me</a>
                <p>Portfolio Site: https://jbourds.github.io/</p>
            </section>
        </section>

        <section id="education" class="education">
            <section class="section-header">
                <h2 class="bold section-header">Education<p></p>
                    <div class="line"></div>
                </h2>
            </section>

            <section class="university">
                <p class="university inline-block">University of Vermont (UVM), Burlington VT</p>
                <p class="college-graduation right">Anticipated Graduation May 2025</p>
                <p class="major">Pursuing double majors in Computer and Data Science</p>
            </section>

            <section class="high-school">
                <p class="high-school inline-block">Missisquoi Valley Union High School (MVU), Swanton VT</p>
                <p class="high-school-graduation right">Graduated June 2021</p>
                <p class="high-school-honors">Honors: Valedictorian, Green and Gold Scholar, Presidential Education
                    Award, Pro Merito, U.S. Army Scholar/Athlete Award</p>
                <p class="high-school-gpa">4.3 GPA</p>
                <p class="sat-score">1450 SAT Score</p>
            </section>

        </section>

        <section id="experience" class="experience">
            <section class="section-header">
                <h2 class="bold">Past Work Experience</h2>
                <div class="line"></div>
            </section>
            <section class="it-internship">
                <h3>IT Internship: Summer 2021 - Present</h3>
                <p>Interned with the IT department of an area
                    business (Superior Technical Ceramics, St Albans VT 05488) working in a
                    variety of different capacities.
                    While here, I did traditional helpdesk style
                    work solving/troubleshooting computer problems, was able to take on a
                    few smaller scale programming projects,
                    and received a smattering of experience with
                    programs and frameworks such as Microsoft Azure, Office 365, MS SQL
                    Management Studio,
                    Infor ERP, and a few other
                    programs.
                </p>

                <p>Summary of Applied Skills:</p>
                <ul>
                    <li>IT Helpdesk</li>
                    <li>Software Maintenance/Development</li>
                    <li>SQL</li>
                    <li>Scripting with AutoIt to automate tasks and create GUIs (similar to Visual Basic and C#)</li>
                    <li>Excel Work</li>
                    <li>Writing Process Documentation</li>
                </ul>
            </section>

        </section>

        <section id="relevant-coursework" class="relevant-coursework">
            <section class="section-header">
                <h2 class="bold">Relevant Coursework</h2>
                <div class="line"></div>
            </section>

            <section class="classes">
                <ul>
                    <li>Algorithms and Data Structures (C++)</li>
                    <li>Intro to Data Science (R)</li>
                    <li>Database Design for the Web (HTML, CSS, PHP, SQL)</li>
                    <li>Intermediate Programming (Java)</li>
                    <li>Accelerated Introductory Programming (Python)</li>
                    <li>Intro to Web Site Development (HTML, CSS, PHP, SQL)</li>
                    <li>Applied Probability</li>
                    <li>Discrete Math</li>
                    <li>Calculus I, II, and III</li>
                    <li>Linear Algebra</li>
                    <li>Statistics for Engineering</li>
                </ul>
            </section>
        </section>

        <section id="projects" class="projects">
            <section class="section-header">
                <h2 class="bold section-header">Programming Projects</h2>
                <div class="line"></div>
            </section>

            <section class="projects">

                <ul>
                    <li>
                        <h4>Powerlifting Coaching Web Application</h4>
                        <p>***In Progress</p>
                        <p>This program is java-based and designed to work as a web app for coaches to work with clients
                            remotely. Although this is in the early state, here is what has been done so far:</p>
                        <ul>
                            <li>Locally hosted server and database</li>
                            <li>Custom login feature with permission based access to web pages</li>
                            <li>Salted and hashed login using argon2 algorithm</li>
                            <li>Custom library for representing and editing programs. Includes ability for
                                custom-defined exercises.</li>
                        </ul>
                    </li>

                    <li>
                        <h4>Plagiarism Detector</h4>
                        <p>This program was the final project for UVM's introductory programming course (CS021).
                            It works by taking a wikipedia link for a topic and the file's name to check then it will go
                            line by line through the file
                            breaking up the words into lists which it then compares the sequence of to the wikipedia
                            page entered.
                            Then, it will follow the links in the references section of the wikipedia page to a
                            user-defined depth and repeat
                            the same process on those pages as well.
                        </p>
                        <p>Note: This was a project made very early on in my education, take it with a grain of salt :)
                        </p>
                        <a href="https://github.com/JBourds/CS021-Final-Project">Github Repo:
                            https://github.com/JBourds/CS021-Final-Project</a>
                    </li>

                    <li>
                        <h3>This Website!</h3>
                        <p>This website is created from scratch to serve as a portfolio and virtual resume.</p>
                    </li>

                    <li>
                        <h3>Web Development Final Project</h3>
                        <a href="https://jbourde2.w3.uvm.edu/cs008/final/index.php">Chess.edu Website:
                            https://jbourde2.w3.uvm.edu/cs008/final/index.php</a>
                        <p>This website was created for a final project in an intro to website development class.
                            It covered use of HTML, CSS, PHP, SQL, and some Javascript code to create a fully functional
                            website which interacts with a database and utilizes many of the built-in HTML functions
                            such
                            as forms and other tools.
                        </p>
                    </li>
                </ul>
            </section>

        </section>
    </main>

<?php
include 'footer.php';
?>