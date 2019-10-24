<?php
include "../../dbinfo.php";
$cn5=mysqli_connect(Host,UN,PW,DBname);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['uun']))
{
    $unn=$_SESSION['uun'];
}
else {

    $unn=session_id();
}

if (isset($_POST["qnt"]) && isset($_POST["ppid"]))
{
    $qnt=$_POST["qnt"];
    $ppid=$_POST["ppid"];


    $qry = mysqli_query($cn5 , "call additemtocart('$unn','$ppid','$qnt');");

    if( mysqli_error($cn5)) echo mysqli_error($cn5) ;

    else header("location:../cart.php");

}
else  header("location:../product.php?id=$ppid&msg=err");
