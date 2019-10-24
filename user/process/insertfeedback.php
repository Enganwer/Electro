<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);

if (isset($_POST["rate"])&&isset($_POST["msg"]))
{
    if (empty($_POST["name"]) or $_POST["name"]=="Name (not required)") {
        $name = 'no name';
    }
    else $name=$_POST["name"];
    $rate=$_POST["rate"];
    $msg=$_POST["msg"];
      $msg=  mysqli_real_escape_string($cn,$msg);
      $name=mysqli_real_escape_string($cn,$name);
    $qry = mysqli_query($cn , "insert into feedback value('$name','$rate','$msg');");

    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else header("location:../contact.php?msg=1");

}
else echo  header("location:../contact.php?error=invalid");
