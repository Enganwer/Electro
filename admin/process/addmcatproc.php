<?php
if (isset($_POST["cat"])) {
    $cnm=$_POST["cat"];
    include "../../dbinfo.php";
    $cn = mysqli_connect(Host, UN, PW, DBname);
    mysqli_query($cn, "insert into categories value (null,'$cnm')");
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else header("location:../addmcat.php");
}
else header("location:../addmcat.php?error=inv");