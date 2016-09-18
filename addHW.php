<?php
    function checkTitle($missingTitle) {
        if ($missingTitle)
            print "<span class=\"errorMsg\">Homework must be given a title.</span>";
    }
    
    function checkDueDate($missingDate) {
        if ($missingDate)
            print "<span class=\"errorMsg\">Please provide a due date.</span>";
    }
    
    function dateToday() {
        date_default_timezone_set('America/Denver');
        $today = getdate();
        $year = $today["year"];
        $month = $today["mon"];
        if ($month < 10)
            $month = "0" . $month;
        $day = $today["mday"];
            if ($day < 10)
        $day = "0" . $day;
        print $year . "-" . $month . "-" . $day;
    }
?>

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
                $numMilestones = $_GET["numMilestones"];
                
                if (isset($_POST["addHW"])) {
                    $course = $_POST["course"];
                    $title = $_POST["hwName"];
                    $dueDate = $_POST["dueDate"];
                    if (!$title) {
                        $missingTitle = true;
                    }
                    if (!$dueDate) {
                        $missingDate = true;
                    }
                    if (!$missingDate && !$missingTitle) {
                        $sql = "INSERT INTO homework VALUES (null, '$course', '$title', '$user_id', '$dueDate', '0')";
                        $result = mysqli_query($db,$sql);
                        print "<span class=\"content\">There are " . $numMilestones . " milestones</span>";
                        for ($j=0; $j < $numMilestones; $j++) {
                            $milestoneTitle = $_POST["milestones"][$j];
                            $milestoneDue = $_POST["dueDates"][$j];
                            $sql = "INSERT INTO homework VALUES (null, '$course', '$milestoneTitle', '$user_id', '$milestoneDue', '0')";
                            $result = mysqli_query($db,$sql);
                        }
                        header("Location: view.php");
                    }
                }
                
                $tempName = $_GET["hwTitle"];
                $tempDue = $_GET["due"];
                $tempCourse = $_GET["courseCode"];
                
            ?>
            <div class="content">
                <h2>Add an Assignment</h2>
                <form action="addHW.php?numMilestones=<?= $numMilestones?>" method="post">
                    <div class="addHwStyle">
                        Course  <?php
                                    $query = "SELECT id, code from courses where student_id='$user_id'";
                                    $result = mysqli_query($db, $query);
                                    print "<select id=\"courseCode\" name=\"course\">";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?php if ($tempCourse == $row['id']) print "selected"; ?>>
                                        <?= $row['code'] ?>
                                        </option>
                                    <?php
                                    }
                                    print "</select>";
                                     ?><br/><br/>
                        Assignment <input type="text" id="hwName" name="hwName" placeholder="ex. English outline" <?php if ($tempName) print "value=\"" . $tempName . "\""; ?> maxlength="30" /><?php checkTitle($missingTitle); ?><br/><br/>
                        Due Date <input type="date" id="dueDate" name="dueDate" <?php if ($tempDue) print "value=\"" . $tempDue . "\""; ?> min="<?php dateToday() ?>" /><?php checkDueDate($missingDate); ?><br/><br/>
                        <input type="checkbox" id="addReminder" value="addRem" onclick="reminder(<?=$numMilestones?>);" />
                        <label for="addReminder">Add a reminder?</label>
                        <img src="questionmark.png" alt="reminderNote" id="questionGraphic" title="Reminders help you stay on track to complete milestones
                        for larger assignments" />
                        
                        <?php
                            //If they want to add a milestone, then the menu extends
                            for ($i=1; $i<=$numMilestones; $i++) { ?>
                                <br/><br/>Milestone <?=$i?> <input type="text" name="milestones[]" placeholder="ex. Find sources" maxlength="30" />
                                <br/><br/>Due by <input type="date" name="dueDates[]" min="<?php dateToday() ?>" />
                        <?php } ?>
                        <br/><br/>
                        <input type="submit" name="addHW" value="Add Assignment" />
                    </div>
                </form>
            </div>
        </body>
    </html>
</DOCTYPE>