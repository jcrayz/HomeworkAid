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
            $homework_id = $_GET["homeworkID"];
            ?>
            completeHomework(<?=$homework_id?>);
            <div class="content">
            <?php
                $query = "UPDATE homework SET done='1' WHERE user_id='$user_id' AND homeworkID='$homework_id'";
                echo $query;
                $result = mysqli_query($db, $query);
                header("Location: view.php");
            ?>
            </div>
        </body>
    </html>
</DOCTYPE>