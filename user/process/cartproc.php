<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ( isset($_GET["pid"]) and isset($_GET["proc"]))
{
    if(isset($_SESSION["uun"]))
    $cid=$_SESSION["uun"];
    else $cid=session_id();

    $pid=$_GET["pid"];
    $proc=$_GET["proc"];
}
else header("location:../cart.php?msg=inv");


//echo "$cid   $pid";


include  "../../dbinfo.php";
$cn5=mysqli_connect(Host,UN,PW,DBname);

if($proc=="rem")
    mysqli_query($cn5,"call removeitemfromcart('$cid','$pid')");
else if ($proc=="plus")
    mysqli_query($cn5,"call cartplus('$cid','$pid')");
else if ($proc=="min")
    mysqli_query($cn5,"call cartminus('$cid','$pid')");



if( mysqli_error($cn5)) echo mysqli_error($cn5) ;
else header('Location: ' . $_SERVER['HTTP_REFERER']);
