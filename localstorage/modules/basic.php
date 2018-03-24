<?php
include 'settings.php';

function head()
{
    global $board;
    echo "<!doctype html>
        <html lang=\"en\">
          <head>
            <meta charset=\"utf-8\">
            <title>".$board."</title>
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"icon\" href=\"/localstorage/favicon.ico\" type=\"image/x-icon\">
            <meta name=\"description\" content=\"".$board."\">
            <meta name=\"author\" content=\"EagleMON\">
            <meta name=\"theme-color\" content=\"#000000\" />
            <link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">
            <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">
            <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
          </head>\n";
}

function footer()
{
    global $max_window;
    global $min_window;

    echo "<div class=\"w3-bottom w3-light-gray w3-card\" style=\"max-width:".$max_window."px;min-width:".$min_window."px\">
            <div id=\"links\" class=\"w3-bar w3-center\"><i class=\"fa fa-amazon\"></i></div>
            <div id=\"clock\" class=\"w3-bar w3-center\">empty</div>
              <div class=\"w3-bar w3-center\">
                <h4><span class=\"w3-text-gray\">Eagle</span><span class=\"w3-text-orange\">MON</span></h4>
              </div>
              <div class=\"w3-bar w3-center\">Sesion started: ".isset($_SESSION['started'])." Timeout: ".isset($_SESSION['timeout'])." User: ".isset($_SESSION['user'])." page: ".isset($_SESSION['page'])."</div>
         </div>\n";

         echo "<script>
         var refInterval = window.setInterval('update_time()', 10000); // 10 seconds
         var update_time = function() {
             $.ajax({
                url: '/localstorage/modules/get_time.php',
                success: function (response) {
                 $('#clock').html(response);
                }
            });
         };
         update_time();
         </script>\n";
}




function start_line()
{
    global $max_window;
    global $min_window;
    echo "<body class='w3-content' style='max-width:".$max_window."px;min-width:".$min_window."px'>\n";
}
function end_line()
{
    echo "</body>
    </html>\n";
}

function modal($id,$label,$body)
{
    echo "<div id=\"".$id."\" class=\"w3-modal\">
            <div class=\"w3-modal-content\">
                <span onclick=\"document.getElementById('".$id."').style.display='none'\" class=\"w3-button w3-light-gray w3-text-red w3-display-topright\"><i class=\"fa fa-close\"></i></span>
                <div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n
                    <h4>".$label."</h4>
                    <div>".$body."</div>
                </div>
            </div>
        </div>\n";
}


function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function snackbar($msg)
{
echo "<style>
      #snackbar {
          visibility: hidden;
          min-width: 250px;
          margin-left: -125px;
          background-color: #333;
          color: #fff;
          text-align: center;
          border-radius: 2px;
          padding: 16px;
          position: fixed;
          z-index: 1;
          left: 50%;
          bottom: 30px;
          font-size: 17px;
      }
      #snackbar.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, fadeout 0.5s 2.5s;
      }

      @-webkit-keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
      }

      @keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
      }

      @-webkit-keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
      }

      @keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
      }
      </style>";
  echo "<div id=\"snackbar\">".$msg."</div>";

  echo "<script>
      var x = document.getElementById(\"snackbar\")
      x.className = \"show\";
      setTimeout(function(){ x.className = x.className.replace(\"show\", \"\"); }, 3000);
      </script>";
      return $msg;

}



?>
