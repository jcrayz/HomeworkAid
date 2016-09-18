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
                $course_id= $_GET["courseID"];
                $query = "SELECT code, title, instructor, numMeetings FROM courses WHERE student_id='$user_id' AND id='$course_id'";
                $result = mysqli_query($db,$query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $courseCode = $row["code"];
                    $courseTitle = $row["title"];
                    $courseInstructor = $row["instructor"];
                    $numMeetings = $row["numMeetings"];
                }
                
                if (isset($_POST["commitButton"])) {
                $courseCode = $_POST["courseCode"];
                $courseTitle = $_POST["courseTitle"];
                $instructor = $_POST["courseInstructor"];
                $timesPerWeek = $_POST["numMeetings"];
                $course_id = $_POST["id"];
                if (!$courseCode)
                    $missingID=true;
                else if (!preg_match('/[a-zA-z][a-zA-z][a-zA-z][0-9][0-9][0-9]/', $courseCode)) {
                    $badID = true;
                }
                else {
                    $sql = "UPDATE courses SET code='" . $courseCode . "', title='" . $courseTitle . "', instructor='" . $instructor . "', 
                        numMeetings=" . $timesPerWeek ." WHERE id=" . $course_id . " AND student_id=" . $user_id;
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
                
                <form action="editCourse.php" method="post">
                    <div class="addCourseStyle">
                        Course ID (required) <input type="text" name="courseCode" value="<?=$courseCode?>" /><?php idError($missingID); badId($badID); ?>
                        <br/><br/>
                        Course Title (optional) <input type="text" name="courseTitle" maxlength="18" value="<?=$courseTitle?>" /><br/><br/>
                        Instructor (optional) <input type="text" name="courseInstructor" maxlength="18" value="<?=$courseInstructor?>" /><br/><br/>
                        Meets <input type="number" name="numMeetings" min="0" max="4" value="<?=$numMeetings?>" /> times per week<br/><br/>
                        <input type="hidden" name="id" value="<?=$course_id?>" />
                        <!--Time selection-->
                        <input type="submit" name="commitButton" value="Done" />
                        <input type="submit" name="cancelButton" value="Cancel" />
                    </div>
                </form>
            </div>
        </body>
    </html>
</DOCTYPE>