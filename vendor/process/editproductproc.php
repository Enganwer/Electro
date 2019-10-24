<?php
if (isset($_POST["pid"])&&isset($_POST["pnm"])&&isset($_POST["qnt"])&&isset($_POST["pr"]))
{
    $pid=$_POST["pid"];
    $pnt=$_POST["pnm"];
    $qnt=$_POST["qnt"];
    $pr=$_POST["pr"];
    include "../../dbinfo.php";
    $cn=mysqli_connect(Host,UN,PW,DBname);
    mysqli_query($cn,"update products set product_name='$pnt',quantity='$qnt',price='$pr' where product_id='$pid'");
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else  header("location:../viewproducts.php");
}
else header("location:../viewproducts.php?error=inv");