<?php
     // Your database connection code here (replace placeholders)
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "eng";

     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
