<?php
require_once "../config.php";
unset($_SESSION['userid']);
header('Location: /index.php');
?>