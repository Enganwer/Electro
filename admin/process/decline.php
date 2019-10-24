<?php
if (isset($_GET["cnm"])) $cnm=$_GET["cnm"];
else header("location:../viewmcat.php?error=inv");


include  "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
mysqli_query($cn,"update products set product_status='refuced' where product_id='$cnm'");
if( mysqli_error($cn)) echo mysqli_error($cn) ;

else header("location:../index.php");