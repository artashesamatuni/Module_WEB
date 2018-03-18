<?php
include 'settings.php';

function head()
{
    global $board;
    global $max_window;
    global $min_window;
    echo "<!doctype html>
        <html lang=\"en\">
          <head>
            <meta charset=\"utf-8\">
            <title>".$board."</title>
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"icon\" href=\"favicon.ico\" type=\"image/x-icon\">
            <meta name=\"description\" content=\"".$board."\">
            <meta name=\"author\" content=\"EagleMON\">
            <meta name=\"theme-color\" content=\"#000000\" />
            <link rel=\"stylesheet\" href=\"/localstorage/css/w3.css\">
            <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">
          </head>\n";
          echo "<body class='w3-content' style='max-width:".$max_window."px;min-width:".$min_window."px'>\n";
}

function footer()
{
    global $max_window;
    global $min_window;
    echo "<div class=\"w3-bottom w3-light-gray\" style=\"max-width:".$max_window."px;min-width:".$min_window."px\">
            <div class=\"w3-bar w3-center\">".date("h").":".date("i")." ".date("a")." ".date("l").", ".date("d")." ".date("M")." ".date("Y")."</div>
              <div class=\"w3-bar w3-center\">
                <h4><span class=\"w3-text-gray\">Eagle</span><span class=\"w3-text-orange\">MON</span></h4>
              </div>
             </div>
    </body>
</html>";
}

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>
