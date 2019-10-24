<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);

if (isset($_POST["un"])&&isset($_POST["pw"])&&isset($_POST["fname"])&&isset($_POST["mob"])&&isset($_POST["address"]))
{
    $un=$_POST["un"];
    $pw=$_POST["pw"];
    $fname=$_POST["fname"];
    $mob=$_POST["mob"];
    $address=$_POST["address"];
    $address=mysqli_real_escape_string($cn,$address);
    $qry = mysqli_query($cn , "call adduser('$un','$pw','$mob','$fname','$address');");

    if( mysqli_error($cn)) echo mysqli_error($cn) ;

   else header("location:../login.php");

}
else echo  header("location:../register.php?error=invalid");
