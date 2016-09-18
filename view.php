<!DOCTYPE html>
  <html>
      <head>
          <?php session_start(); ?>
          <link href="style.css" type="text/css" rel="stylesheet" />
          <script src="dynamicContent.js" type="text/javascript"></script>
          <title>View List</title>
      </head>
      
      <body>
          <?php include "window.php"; ?>  
          <div class = "content">
              <?php
                print "Hello, " . $_SESSION["name"] . "!";
                date_default_timezone_set('America/Los_Angeles');
                $today = getdate();
                print "<br/>Today is " . $today["month"] . " " . $today["mday"] . ", " . $today["year"];
                $todayDate = date($today["year"] . "-" . $today["mon"] . "-" . $today["mday"]);
                
              ?>
              <h3>Current Homework</h3>
              <span class="faded">Scroll down to see more assignments.</span>
              <!--<br/><br/>
              <form action="view.php">
                  <div class="viewPage">
                      <label><input type="radio" name="dateRange" value="viewTomorrow" />Tomorrow</label>
                      <label><input type="radio" name="dateRange" value="viewWeek" />This Week</label>
                      <label><input type="radio" name="dateRange" value="viewMonth" />This Month</label>
                      <label><input type="radio" name="dateRange" value="viewAll" checked="checked" />This Semester</label>
                  </div>
              </form>
              <br/>-->
              <div class="homeworkList">
                <?php
                  $user_id = $_SESSION["userid"];
                  $query = "SELECT homework.homeworkID, homework.course_id, homework.title, homework.due, courses.id, courses.code, homework.done 
                  FROM homework JOIN courses ON homework.course_id=courses.id WHERE homework.user_id='$user_id' AND homework.done=0
                  AND homework.due>='$todayDate' ORDER BY homework.due";
                  $result = mysqli_query($db,$query);
                  while ($row = mysqli_fetch_assoc($result)) {
                    print "<span class=\"italics\">Course:</span> " . $row["code"] . "<br/><span class=\"italics\">Title:</span> " . $row["title"] . "<br/><span class=\"italics\">Due:</span> " . $row["due"] . 
                    "<br/><button title=\"Complete this assignment\" onclick=\"completeHomework(" . $row["homeworkID"] . ")\">Complete?</button>" . "<br/><br/>";
                  }
                ?>
              </div>
              <br/>
              <div>
                  <button name="viewList" disabled="disabled">List All</button>
                  <button name="viewCalendar" onclick="document.location.href='viewCalendar.php';">Calendar Week</button><br/>
              </div>
              <!--
              <form action="view.php">
                <div class="faded">
                  <label><input type="checkbox" name="showPastDue" value="yes" />Show completed assignments</label>
                </div>
              </form>-->
          </div>
      </body>
  </html>  
</DOCTYPE>