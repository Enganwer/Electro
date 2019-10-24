<?php
include "../../dbinfo.php";
$cn5=mysqli_connect(Host,UN,PW,DBname);

if (isset($_POST["msg"])&&isset($_POST["rate"]) && isset($_POST["vid"]))
{
    $rate=$_POST["rate"];
    $msg=$_POST["msg"];
    $vvid=$_POST["vid"];
    session_start();
    if(isset($_SESSION['uun']))
    {
        $unn=$_SESSION['uun'];
    }
    else {
        header("location:../contact.php?error=invalid2");
    }

    $msg=  mysqli_real_escape_string($cn5,$msg);
    $qry = mysqli_query($cn5 , "call rate_vendor('$vvid','$unn','$rate','$msg');");

    if( mysqli_error($cn5)) echo mysqli_error($cn5) ;

    else header("location:../vendor.php?vid=$vvid");

}
else echo  header("location:../contact.php?error=invalid1");
