<?php 

if (isset($_GET["message"]) && isset($_GET["message"])){
    $status = $_GET["status"];
    $message = $_GET["message"];

    echo "<h3 class='$status text-center'>$message</h3>";
}