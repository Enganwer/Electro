<?php
 if (isset($_POST["un"])&&isset($_POST["pw"]))
 {
    $un=$_POST["un"];
     $pw=$_POST["pw"];
     include "../../dbinfo.php";
     $cn=mysqli_connect(Host,UN,PW,DBname);

     $rslt=mysqli_query($cn,"select check_admin('$un','$pw');");
     $arr=mysqli_fetch_array($rslt);
     if ($arr["0"]=='1')
     {
         if (isset($_POST["remember"]))
         {
             if ($_POST["remember"]=='1')
             {
                 setcookie("adminpanelun",$un,time()+(86400 * 30),"/");
             }
         }
         session_start();
         $_SESSION["admun"]=$un;
         header("location:../index.php");

     }
     else header("location:../login.php?error=inv");


 }
 else  header("location:../login.php?error=inv");