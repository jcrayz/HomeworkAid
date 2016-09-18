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
                $course_id = $_GET["courseID"];
                $query = "DELETE FROM courses WHERE student_id='$user_id' AND id='$course_id'";
                $result = mysqli_query($db, $query);
                header("Location: manageCourses.php");
            ?>
        </body>
    </html>
</DOCTYPE>