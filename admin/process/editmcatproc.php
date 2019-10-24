<?php
if (isset($_POST["cid"])&&isset($_POST["cat"]))
{
    $cid=$_POST["cid"];
    $cnm=$_POST["cat"];
    include "../../dbinfo.php";
    $cn=mysqli_connect(Host,UN,PW,DBname);
    mysqli_query($cn,"update categories set cat_name='$cnm' where cat_id='$cid'");
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else  header("location:../viewmcat.php");
}
else header("location:../viewmcat.php?error=inv");