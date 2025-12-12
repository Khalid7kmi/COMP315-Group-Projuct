<?php
    
    $host = "sql100.infinityfree.com";
    $username = "if0_39836550";
    $password = "**********";
    $db = "if0_39836550_food_ordering_system";

date_default_timezone_set('Asia/Riyadh');

   $conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET time_zone = '+03:00'");

    
    ?>
