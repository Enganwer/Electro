<?php
if (isset($_POST["cat"])) {
    $cnm=$_POST["cat"];

    include "../../dbinfo.php";
    $cn = mysqli_connect(Host, UN, PW, DBname);
    $cnm=mysqli_real_escape_string($cn,$cnm);

    mysqli_query($cn, "insert into brands  value (null,'$cnm')");
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else header("location:../addbrand.php");
}
else header("location:../addbrand.php?error=inv");