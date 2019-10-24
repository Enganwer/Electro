<?php
if (isset($_GET["un"])) $un=$_GET["un"];
else header("location:../removeadmin.php?error=inv");


include  "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
mysqli_query($cn,"delete from users where user_name='$un';");
if( mysqli_error($cn)) echo mysqli_error($cn) ;

else header("location:../removeadmin.php");