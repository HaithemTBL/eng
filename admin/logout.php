<?php 
session_start();
session_destroy();
header('location: /eng/admin/login.php');
exit();