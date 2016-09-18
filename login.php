<!DOCTYPE html>
    <html>
        <head>
            <?php session_start(); ?>
            <link href="style.css" type="text/css" rel="stylesheet" />
            
            <title>Login</title>
            
            <h1>HomeworkAid<img src="HWgraphic.JPG" alt="HomeworkAid" class="loginGraphic" /></h1>  <!--Header and graphic-->
            <h3>Your Personal Homework Manager</h3>
        </head>
        
        <body>
            <?php                           //Connect to database
            $servername = getenv('IP');
            $username = getenv('C9_USER');
            $password = "";
            $database = "egr223";
            $dbport = 3306;
            // Create connection
            $db = new mysqli($servername, $username, $password, $database,
            $dbport);
            // Check connection
            if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
            }
            //echo "Connected successfully (".$db->host_info.")";
            
            if (isset($_POST["login"])) {           //Check login
                $query = "select * from users";
                $result = mysqli_query($db, $query);
                $validLogin = false;
                while ($row = mysqli_fetch_assoc($result)) {
                    if (($row['username']==$_POST["username"])&&($row['password']==$_POST["pw"])) {
                        $validLogin = true;
                        $id=$row['id'];
                        $username=$row['username'];
                        $name=$row['name'];
                    }

                }
                if ($validLogin) {
                    $_SESSION["username"]=$username;
                    $_SESSION["name"]=$name;
                    $_SESSION["userid"]=$id;
                    header("Location: view.php");   
                }
                else {
                    echo "<br><div class=\"errorMsg\">ERROR: Invalid Login Credentials!</div><br>";
                }
            }
            ?>
            <form action="login.php" method="post">
                <div class="loginStyle">
                    Username: <input type="text" name="username" maxlength=15 /> <br/><br/>       <!--Enter username and password-->
                    Password: <input type="password" name="pw" maxlength=30 /> <br/><br/>
                    
                    <input type="submit" name="login" value="GO" /> <br/><br/>       <!--Submit login info-->
                    
                </div>
            </form>
            <br/><div class="footnote">
                Don't have an account?  Click <a href="register.php">here</a> to register.
            </div>
        </body>
    </html>
</DOCTYPE>