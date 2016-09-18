<?php
    function fillTable($user_id) {
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
        $courseID = $_GET["courseID"];
        $query2 = "SELECT code, title, instructor, numMeetings from courses where id='$courseID' and student_id='$user_id'";
        $result2 = mysqli_query($db, $query2);
        $row = mysqli_fetch_assoc($result2);            
        print "<td>" . $row['code'] . "</td><td>" . $row['title'] . "</td><td>" . $row['instructor'] . "</td><td>" . $row['numMeetings'] . "</td>";
} ?>

<!DOCTYPE html>
    <html>
        <head>
            <?php session_start(); ?>
            <link href="style.css" type="text/css" rel="stylesheet" />
            <script src="dynamicContent.js" type="text/javascript"></script>
        </head>
        
        <body>
            <?php
                include "window.php";
                $user_id = $_SESSION["userid"];
            ?>
              
            <div class="content">
                View Course Details for:<?php
                    $selectedCourse = $_GET["courseID"];
                    $query = "SELECT * from courses where student_id='$user_id'";
                    $result = mysqli_query($db, $query);
                    print "<select name='course' id='selectCourse' onchange='detectID();'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value="<?= $row['id'] ?>"
                        <?php if ($row['id']==$selectedCourse)
                                print " selected=\"selected\"";?>>
                        <?= $row['code'] ?>
                        </option>
                    <?php
                    }
                    print "</select>";
                     ?><br/><br/>
                <table>
                    <tr>
                        <th>Course Code</th><th>Title</th><th>Instructor</th><th>Meetings/Week</th>
                    </tr>
                    <tr>
                        <?php fillTable($user_id); ?>
                    </tr>
                </table><br/>
                <form action="manageCourses.php" method="post">
                    <div class="manageCoursesButtons">
                        <input type="button" name="addCourse" value="Add a New Course" onclick="document.location.href='addCourse.php';"><br/>
                        <input type="button" name="editCourse" value="Edit This Course" onclick="document.location.href='editCourse.php?courseID=<?=$selectedCourse?>';"><br/>
                    </div>
                </form>
                <div class ="manageCoursesButtons">
                    <button onclick="deleteCourse(<?=$selectedCourse?>)">Delete This Course</button><br/><br/>
                </div>
            </div>
        </body>
    </html>
</DOCTYPE>