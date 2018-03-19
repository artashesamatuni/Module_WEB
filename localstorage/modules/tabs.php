<?php


function draw_tabs($t_names, $sel)
{
    $n = count($t_names);
    echo "<div class='w3-row w3-light-gray'>\n";
    for ($i = 1; $i <= $n; $i++) {
        echo "<div class='w3-col  m".(12/$n)." s".(12/$n)."'>\n";
        if ($i==$sel) {
            echo "<button onclick=\"fn_".$i."()\" class='w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top' id='btn".$i."'>".$t_names[$i-1]."</button>\n";
        } else {
            echo "<button onclick=\"fn_".$i."()\" class='w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-left w3-border-top' id='btn".$i."'>".$t_names[$i-1]."</button>\n";
        }
        echo "</div>\n";
    }
    echo "</div>\n";
    //------------------------------------------------------------------

    echo "\n<script type='text/javascript'>\n";
    //echo "function fn_".$sel."();\n";

    for ($i =1; $i <= $n; $i++) {
        echo "function fn_".$i."() {
        var x = document.getElementById(\"tab".$i."\");
        if (x.className.indexOf(\"w3-show\") == -1) {
            x.className = \"w3-container w3-show\";";
        for ($j =1; $j <= $n; $j++) {
            if ($i==$j) {
                echo "\ndocument.getElementById(\"btn".$j."\").className = \"w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top\";\n";
                echo "document.getElementById(\"tab".$j."\").className = \"w3-container w3-show\";";
            } else {
                echo "\ndocument.getElementById(\"btn".$j."\").className = \"w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-left w3-border-top\";\n";
                echo "document.getElementById(\"tab".$j."\").className = \"w3-container w3-hide\";";
            }
        }
        echo "\n}\n";
        echo "document.cookie = \"c_tab=".$i."\";\n";
        echo "}\n";
    }
    echo "fn_".$sel."();";
    echo "\n</script>\n";
}
