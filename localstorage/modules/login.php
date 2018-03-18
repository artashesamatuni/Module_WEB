<?php
include 'settings.php';


function check_user()
{
    session_start();

    # Check for session timeout, else initiliaze time


    /*
    if (isset($_POST["user"]))
	{
        $user = $_POST['user'];
        $pass = hash('sha256', $_POST['pass']);
    }
	else
	{
        $user = "";
        $pass = "";
    }
*/

	if (isset($_SESSION['timeout'])) {
		# Check Session Time for expiry
		#
		# Time is in seconds. 10 * 60 = 600s = 10 minutes
		if ($_SESSION['timeout'] + 30 * 60 < time()){
			session_destroy();
		}
	}
	else {
		# Initialize variables
		$_SESSION['user']="";
		$_SESSION['pass']="";
		$_SESSION['timeout']=time();
	}

	# Store POST data in session variables
	if (isset($_POST["user"])) {
		$_SESSION['user']=$_POST['user'];
		$_SESSION['pass']=hash('sha256',$_POST['pass']);
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
    if ($result->num_rows > 0)
	{
        while ($row = $result->fetch_assoc())
		{
            if($_SESSION['user'] == $row["username"]
            && $_SESSION['pass'] == $row["passcode"])
            {
                return $_SESSION['user'];
            }



	//		if ($user == $row["username"] && $pass == $row["passcode"])
	//		{
	//			return $user;
	//		}



			else
			{   # Show login form. Request for username and password
				require_once 'basic.php';
				head();
				echo "<body class=\"w3-content\" style=\"max-width:300px\">";
				echo "<br/>
					  <div class=\"w3-card-4 w3-light-grey\">
						<form method=\"POST\" action=\"\">
						<div class=\"w3-container w3-center\">
							<h3>Access Control</h3>
							<img src=\"localstorage/images/img_avatar3.png\" class=\"w3-circle\" alt=\"Avatar\" style=\"width:80%\">
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
					  </div>";
					echo "</body>\n";
					echo "</html>";
					return Null;
			}
        }
    }

}

?>
