<!DOCTYPE html>
  <html>
      <head>
          <?php session_start(); ?>
          <link href="style.css" type="text/css" rel="stylesheet" />
          <script src="dynamicContent.js" type="text/javascript"></script>
          <title>View Calendar</title>
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
                $wday = $today["wday"];
                $weekday = $today["weekday"];
                $user_id = $_SESSION["userid"];
                
              ?>
              <h3>Current Homework</h3>
              <span class="faded">Mouse over an assignment to see course code.</span><br/><br/>
              <!--<form action="view.php">
                  <div class="viewPage">
                      <label><input type="radio" name="dateRange" value="viewTomorrow" />Tomorrow</label>
                      <label><input type="radio" name="dateRange" value="viewWeek" />This Week</label>
                      <label><input type="radio" name="dateRange" value="viewMonth" />This Month</label>
                      <label><input type="radio" name="dateRange" value="viewAll" checked="checked" />This Semester</label>
                  </div>
              </form>
              <br/>-->
              <table>
                  <tr><th>SUN</th><th>MON</th><th>TUES</th><th>WED</th><th>THUR</th><th>FRI</th><th>SAT</th></tr>
                  <tr><?php
                  for ($k = 0; $k < $wday; $k++) {
                    print "<td>---------</td>";
                  }
                  
                  //Print today's assignments
                  $queryToday = "SELECT homework.homeworkID, homework.course_id, homework.title, homework.due, courses.id, courses.code, homework.done 
                  FROM homework JOIN courses ON homework.course_id=courses.id WHERE homework.user_id='$user_id' AND homework.done=0
                  AND homework.due='$todayDate'";
                  $resultToday = mysqli_query($db,$queryToday) or die(mysqli_error($db));
                  print "<td>";
                  foreach ($resultToday as $row) {
                      print $row["title"] . "<br/>";
                  }
                  print "</td>";
                  
                  //Print future assignments
                  $laterDate = $todayDate;
                  for ($k=($wday+1); $k < 7; $k++) {
                    $laterDate++;
                    $queryLater = "SELECT homework.homeworkID, homework.course_id, homework.title, homework.due, courses.id, courses.code, homework.done 
                    FROM homework JOIN courses ON homework.course_id=courses.id WHERE homework.user_id='$user_id' AND homework.done=0
                    AND homework.due='$laterDate'";
                    $resultLater = mysqli_query($db,$queryLater) or die(mysqli_error($db));
                    print "<td>";
                    foreach ($resultLater as $row) {
                        print "<span title=\"" . $row["code"] . ":&nbsp;" . $row["title"] . "\">" . $row["title"] . "</span><br/>";
                    }
                    print "</td>";
                    $j++;
                  }?></tr>
              </table>
              <br/>
              <div>
                <button name="viewList" onclick="document.location.href='view.php';">List All</button>
                <button name="viewCalendar" disabled="disabled">Calendar Week</button><br/>
              </div>
              <!--<form action="view.php">
                <div class="faded">
                  <label><input type="checkbox" name="showPastDue" value="yes" />Show completed assignments</label>
                </div>
              </form>-->
          </div>
      </body>
  </html>  
</DOCTYPE>