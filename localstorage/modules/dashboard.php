<?php
require_once "connection.php";

function get_ip()
{
    $ch = curl_init ();
    curl_setopt ($ch, CURLOPT_URL, "http://ipecho.net/plain");
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

    $pubip = curl_exec ($ch);
    curl_close ($ch);

    return $pubip;
}


function node_panel()
{
    
}
