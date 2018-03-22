<?php
include 'settings.php';


function check_user()
{
    session_start();

    # Check for session timeout, else initiliaze time

    if (isset($_SESSION['timeout'])) {
        # Check Session Time for expiry
        #
        # Time is in seconds. 10 * 60 = 600s = 10 minutes
        if ($_SESSION['timeout'] + 30 * 60 < time()) {
            session_destroy();
        }
    } else {
        # Initialize variables
        $_SESSION['user']   = "";
        $GLOBALS['user']    = "";
        $_SESSION['pass']   = "";
        $_SESSION['page']   = "";
        $_SESSION['timeout'] = time();
    }

    # Store POST data in session variables
    if (isset($_POST["user"])) {
        $_SESSION['user'] = $_POST['user'];
        $GLOBALS['user'] = $_POST['user'];
        $_SESSION['pass'] = hash('sha256', $_POST['pass']);
        $_SESSION['page'] = "main.php";
    }

    # Check Login Data
    #
    # Password is hashed (SHA256)

    global $servername;
    global $dbusername;
    global $dbpassword;
    global $dbname;
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);
    $sql = "SELECT username, passcode FROM admin";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($_SESSION['user'] == $row["username"]
            && $_SESSION['pass'] == $row["passcode"]) {
              switch($row["username"])
              {
                case 'admin':
                  $_SESSION['priority'] = 1;
                break;
                case 'user':
                  $_SESSION['priority'] = 2;
                break;
                case 'guest':
                  $_SESSION['priority'] = 3;
                break;
                default:
                break;
              }
                return $_SESSION['user'];
            } else {
                require_once 'basic.php';
                head();
                start_line();
                echo "<div class=\"w3-content\" style=\"max-width:300px\">
                        <br/>
                        <div class=\"w3-card-4 w3-light-grey\">
                      	<form method=\"POST\" action=\"\">
                      	<div class=\"w3-container w3-center\">
                      		<h3>Access Control</h3>
                      		<img src=\"localstorage/images/img_avatar".rand(1, 6).".png\" class=\"w3-circle\" alt=\"Avatar\" style=\"width:60%\">
                      	</div>
                      	<div class=\"w3-container\">
                      		<label>Username</label>
                      		<input type=\"text\" class=\"w3-input w3-border\" placeholder=\"Enter Username\" name=\"user\" required>
                      		<label>Password</label>
                      		<input type=\"password\" class=\"w3-input w3-border\" placeholder=\"Enter Password\" name=\"pass\" required>
                      	</div>
                      	<div class=\"w3-container w3-center\">
                      		<br/>
                      		<button type=\"submit\" class=\"w3-button w3-green\"name=\"submit\" value=\"Login\">Login</button>
                      		<br/>
                      	</div>
                      	</form>
                      	<br/>
                        </div>
                      </div>\n";
                end_line();

                return null;
            }
        }
    }
}
?>
