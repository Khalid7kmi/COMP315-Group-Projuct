<?php
    
    $host = "sql100.infinityfree.com";
    $username = "if0_39836550";
    $password = "**********";
    $db = "if0_39836550_food_ordering_system";


   $conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    
    ?>
