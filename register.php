<!DOCTYPE html>
    <html>
        <head>
            <link href="style.css" type="text/css" rel="stylesheet" />
            <title>Register</title>
        </head>
        
        <body>
            <?php
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
            //echo "Connected successfully (".$db->host_info.")";
            
            if (isset($_POST["register"])) {
                $name = $_POST["name"];
                $username = $_POST["username"];
                $password = $_POST["pw"];
                $email = $_POST["email"];
                $sql = "INSERT INTO users VALUES (null, '" . $name ."', '" . $username ."', '" . $password ."' , '" . $email . "', null)";
                $result = mysqli_query($db, $sql);
                
                if (!$result) {
                	print "<div class=\"errorMsg\">Error inserting!</div>";
                } else {
                header("Location: login.php");
                }
            }
            ?>

            <form action="register.php" method="post">
                <div class="registerStyle">
                    <h3>Register</h3>
                    Name:<input type="text" name="name" /><br/><br/>
                    Username:<input type="text" name="username" /><br/><br/>
                    Password:<input type="password" name="pw" /><br/><br/>
                    E-Mail:<input type="email" name="email" /><br/><br/>
                    <select name="season">
                        <option selected="selected">Spring</option>
                        <option>Fall</option>
                    </select>
                    <select name="year">                            <!--Enter year...There should be a better way to do this section-->
                        <option selected="selected">2016</option>
                        <option>2017</option>
                    </select>
                    <br/><br/>
                    Start Date: <input type="date" name="startDate" min="2016-01-01"  /> <br/>  <!--Semester Start/End dates-->
                    End Date: <input type="date" name="startDate" min="2016-01-02"  />          <!--Consider moving this to registration? Or just removing it-->
                    <br/><br/><input type="submit" name="register" value="Register" />
                </div>
            </form>
        </body>
    </html>
</DOCTYPE>
