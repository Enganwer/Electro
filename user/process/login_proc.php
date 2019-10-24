<?php
if (isset($_POST["un"])&&isset($_POST["pw"]))
{
    $un=$_POST["un"];
    $pw=$_POST["pw"];
    include "../../dbinfo.php";
    $cn=mysqli_connect(Host,UN,PW,DBname);

    $rslt=mysqli_query($cn,"select check_user('$un','$pw');");
    $arr=mysqli_fetch_array($rslt);
    if ($arr["0"]=='1')
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //session_start();
        $_SESSION["uun"]=$un;
        $sid=session_id();
      //  echo $_SESSION["uun"];
        $cn7=mysqli_connect(Host,UN,PW,DBname);
        $rslt2=mysqli_query($cn7,"select EXISTS (select * from vendor_intialcart where client_id='$sid')");
        $arr2=mysqli_fetch_array($rslt2);
        if($arr["0"]=='1') {
            mysqli_query($cn7, "delete from vendor_intialcart where client_id=(select cast(id as char(52)) from users where user_name='$un')");
            mysqli_query($cn7, "update vendor_intialcart set client_id=(select cast(id as char(52)) from users where user_name='$un') where client_id='$sid';");
        }
        header("location:../index.php");

    }

    else header("location:../login.php?error=inv");


}
else  header("location:../login.php?error=inv");