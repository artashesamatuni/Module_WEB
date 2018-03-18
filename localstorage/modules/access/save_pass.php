<?php
require '../connection.php';
require '../basic.php';
head();
echo "<body class='w3-content' style='max-width:300px'>";
$conn = Connect();

$sql = "SELECT id, username, passcode FROM admin";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["username"]=='admin')
        {
            echo "<div id=\"id01\" class=\"modal\">";
            echo "<br/>
                  <div class=\"w3-card-4 w3-light-grey\">
                    <form method=\"POST\" action=\"\">
                    <div class=\"w3-container w3-center\">
                        <h3>Error</h3>
                    </div>
                    <br/>
                    <div class=\"w3-container w3-center\">";
                    #
                    $cur_pass = $conn->real_escape_string(hash('sha256', $_POST['cur_pass']));
                    # Check current password
                    if ($row["passcode"]===$cur_pass)
                    {
                        # Current password is correct
                        $new_pass1             = $conn->real_escape_string($_POST['new_pass1']);
                        $new_pass2             = $conn->real_escape_string($_POST['new_pass2']);
                        # Check new passwords
                        if ($new_pass1==$new_pass2)
                        {
                            # New passwords are equal
                            $cript_pass = hash('sha256', $new_pass1);
                            echo $cript_pass."<br/>";
                        }
                        else {
                            echo "Password doesn't match confirmation";
                        }
                    }
                    else {
                        echo "Current password doesn't match";
                    }
                    #
              echo "</div>
                    <br/>
                    <div class=\"w3-container w3-center\">
                        <button type=\"button\" class=\"w3-button w3-red\" onclick=\"document.getElementById('id01').style.display='none';window.history.back();\">OK</button>
                    </div>
                    <br/>
                    </div>
                    </div>";
        }
    }
}

echo "</body>\n";
echo "</html>";

$conn->close();
 ?>
