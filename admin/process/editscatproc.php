<?php
if (isset($_POST["cid"])&&isset($_POST["cat"]))
{
    $cid=$_POST["cid"];
    $cnm=$_POST["cat"];
    include "../../dbinfo.php";
    $cn=mysqli_connect(Host,UN,PW,DBname);
    mysqli_query($cn,"update brands set brand_name='$cnm' where brand_id='$cid'");
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else header("location:../viewbrands.php");
}
else header("location:../viewbrands.php?error=inv");