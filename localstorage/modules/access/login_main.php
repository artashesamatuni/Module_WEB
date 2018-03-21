<?php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';

head();
start_line();
$cur = 'Access control';
show_menu($cur);
read_config();
footer();
end_line();

function read_config()
{
    $conn    = Connect();
    $sql = "SELECT id, username, passcode FROM admin";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["username"]=='admin')
            {
            echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>
                    <div class=\"w3-container w3-border w3-light-gray\">
                    <div class=\"w3-container w3-center\">
                        <h3>Change Password for ".$row["username"]."</h3>
                    </div>
                    <br/>
                    <form method=\"post\" action=\"save_pass.php\">
                    <input name=\"id\" type=\"hidden\" value=\"".$row["id"]."\"/>
                    <input name=\"username\" type=\"hidden\" value=\"".$row["username"]."\"/>
                    <div class=\"w3-row-padding\">
                        <label>Currnen Password</label><input name=\"cur_pass\" class=\"w3-input w3-border\" type=\"text\" />
                    </div>
                    <div class=\"w3-row-padding\">
                        <label>New Password</label><input name=\"new_pass1\" class=\"w3-input w3-border\" type=\"text\" />
                    </div>
                    <div class=\"w3-row-padding\">
                        <label>Repeat Password</label><input name=\"new_pass2\" class=\"w3-input w3-border\" type=\"text\" />
                    </div>
                    <br/>
                <div class=\"w3-row-padding\">
                    <div class=\"w3-right\">
                        <input type=\"submit\" class=\"w3-button w3-green\" name=\"save_pass\" value=\"Save\" />
                    </div>
                </div>
            </form>
                <br/>
                </div>
                </div>\n";
            }
        }
    }
    $conn->close();
}

?>
