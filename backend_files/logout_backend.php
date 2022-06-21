<?php
session_start();
session_unset();
session_destroy();

$url = "http://localhost/social/index.php";
header("Refresh: 1; URL = $url");
