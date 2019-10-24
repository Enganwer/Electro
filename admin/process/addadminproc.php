<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);

if (isset($_POST["un"])&&isset($_POST["pw"])&&isset($_POST["fname"])&&isset($_POST["mob"])&&isset($_POST["address"]))
{
    $un=$_POST["un"];
    $pw=$_POST["pw"];
    $fname=$_POST["fname"];
    $mob=$_POST["mob"];
    $address=$_POST["address"];
    $un=mysqli_real_escape_string($cn,$un);
    $pw=mysqli_real_escape_string($cn,$pw);
    $fname=mysqli_real_escape_string($cn,$fname);
    $mob=mysqli_real_escape_string($cn,$mob);
    $address=mysqli_real_escape_string($cn,$address);


    if ($_FILES["img"]["size"] >0 )
    {
        $img_name ="../../images/users/$un" . date("Ymdhis").".".pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION  );
        $img_name1 ="../images/users/$un" . date("Ymdhis").".".pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION  );
        move_uploaded_file($_FILES["img"]["tmp_name"] , $img_name);
        $qry = mysqli_query($cn , "insert into users (user_name, password, full_name, mobile, role, adress, img) values('$un','$pw','$fname','$mob','admin','$address','$img_name1');");

        echo mysqli_error($cn);
    }
    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else header("location:../addadmin.php");

}
else echo  header("location:../addadmin.php?error=invalid");
