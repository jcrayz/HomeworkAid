<!DOCTYPE html>
    <html>
        <head>
            <link href="style.css" type="text/css" rel="stylesheet" />
        </head>
        <body>
            <div id=pageHead>
                <h1>HomeworkAid<img src="HWgraphic.JPG" alt="HomeworkAid" class="loginGraphic" /></h1>  <!--Header and graphic-->
                <h4 id="semesterYear">Spring 2016</h4>
            </div>
            
            <?php
            if (isset($_POST["view"])) {
                header("Location: view.php");
            }
            if (isset($_POST["add"])) {
                header("Location: addHW.php?numMilestones=0");
            }
            if (isset($_POST["courses"])) {
                header("Location: manageCourses.php");
            }
            
            $servername = getenv('IP');
            $username = getenv('C9_USER');
            $password = "";
            $database = "egr223";
            $dbport = 3306;
            // Create connection
            $db = new mysqli($servername, $username, $password, $database, $dbport);
            
            // Check connection
            if ($db->connect_error) {
            	die("Connection failed: " .$db->connect_error);
            }
            ?>
            
            <form action="window.php" method="post">
                <div id="menuBar">
                    <ul>
                        <li><button type="submit" class="menuButtons" name="view">View Homework</button></li>
                        <li><button type="submit" class="menuButtons" name="add">Add Homework</button></li>
                        <li><button type="submit" class="menuButtons" name="courses">Manage Courses</button></li>
                    </ul>
                    <span id="logoutLink"><a href="logout.php">Logout</a></span>
                </div>
            </form>
        </body>
    </html>
</DOCTYPE>