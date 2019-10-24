<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION["uun"]))
{
    header("location:../login.php");

}
else {
    $uun = $_SESSION["uun"];
    echo $uun;
    include "../../dbinfo.php";
    $cn5 = mysqli_connect(Host, UN, PW, DBname);
    mysqli_query($cn5, "call submit_cart('$uun')");

    if (mysqli_error($cn5)) echo mysqli_error($cn5);

    else {
        if ($_POST['pay'] == "paypal")
            header("location:https://www.paypal.com");
        else header("location:../index.php");
    }
}