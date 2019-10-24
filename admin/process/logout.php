<?php
session_start();
session_unset();
unset($_COOKIE["adminpanelun"]);
header("location:../header.php");