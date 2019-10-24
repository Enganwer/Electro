<?php
session_start();
session_unset();
unset($_COOKIE["vendorpanelun"]);
header("location:../header.php");