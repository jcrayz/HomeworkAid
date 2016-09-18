<?php
    function idError($missingID) {
        if ($missingID)
            print "<span class=\"errorMsg\">Course ID is required.</span>";
    }
    
    function badId($badId) {
        if ($badId)
            print "<span class=\"errorMsg\">Course ID must follow format AAA###.</span>";
    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <?php session_start(); ?>
            <link href="style.css" type="text/css" rel="stylesheet" />
        </head>
        
        <body>
            
            <?php
            include "window.php";
            $user_id = $_SESSION["userid"];
            
            if (isset($_POST["addButton"])) {
                $courseID = $_POST["courseID"];
                $courseTitle = $_POST["courseTitle"];
                $instructor = $_POST["courseInstructor"];
                $timesPerWeek = $_POST["numMeetings"];
                if (!$courseID)
                    $missingID=true;
                else if (!preg_match('/[a-zA-z][a-zA-z][a-zA-z][0-9][0-9][0-9]/', $courseID)) {
                    $badID = true;
                }
                else {
                    $sql = "INSERT INTO courses VALUES (null, '$courseID', '$courseTitle', '$instructor', '$timesPerWeek', '$user_id')";
                    $result = mysqli_query($db,$sql);
                    header("Location: manageCourses.php");
                }
            }
            if (isset($_POST["cancelButton"])) {
                header("Location: manageCourses.php");
            }
            ?>
            <div class="content">
                <h2>Add a Course</h2>
                
                <form action="addCourse.php" method="post">
                    <div class="addCourseStyle">
                        Course ID (required) <input type="text" name="courseID" placeholder="ex. ENG101" /><?php idError($missingID); badId($badID); ?>
                        <br/><br/>
                        Course Title (optional) <input type="text" name="courseTitle" maxlength="18" placeholder="ex. Basics of Comp" /><br/><br/>
                        Instructor (optional) <input type="text" name="courseInstructor" maxlength="18" placeholder="ex. Dr. James" /><br/><br/>
                        Meets <input type="number" name="numMeetings" min="0" max="4" value="2" /> times per week<br/><br/>
                        <!--Time selection-->
                        <input type="submit" name="addButton" value="Add" />
                        <input type="submit" name="cancelButton" value="Cancel" />
                    </div>
                </form>
            </div>
        </body>
    </html>
