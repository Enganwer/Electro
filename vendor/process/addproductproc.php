<?php
include "../../dbinfo.php";
$cn=mysqli_connect(Host,UN,PW,DBname);
session_start();

/*if (!(empty($_POST["un"]) or
    empty($_POST["desc"])or
   empty($_POST["price"])or
   empty($_POST["cat"])or
   empty($_SESSION["quant"])or empty($_SESSION["brand"])))*/
{
    $pname=$_POST["un"];
    $desc=$_POST["desc"];
    $desc=mysqli_real_escape_string($cn,$desc);
    $price=$_POST["price"];
    $cat=$_POST["cat"];
    $quant=$_POST["quant"];
    $brand=$_POST["brand"];
    $uname=$_SESSION["venun"];
    $qry3=mysqli_query($cn,"select id from users where user_name='$uname'");
    $arr3=mysqli_fetch_array($qry3);
    $vid=$arr3[0];
    $qry = mysqli_query($cn , "call new_product('$pname',$cat,$brand,$quant,$vid,$price,'$desc');");
    $qry2=mysqli_query($cn,"select LAST_INSERT_ID()");
    $arr2= mysqli_fetch_array($qry2);
    $last_id =$arr2[0];
    echo $last_id."<br>";
    $count=0;
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
    {
        $count++;
        $file_name ="../../images/product/$count".date("Ymdhis").".".pathinfo($_FILES["files"]["name"][$key],PATHINFO_EXTENSION  );
        $file_name1 ="../images/product/$count".date("Ymdhis").".".pathinfo($_FILES["files"]["name"][$key],PATHINFO_EXTENSION  );
        echo $file_name1."<br>";
        move_uploaded_file($_FILES["files"]["tmp_name"][$key],$file_name);
        $qry1=mysqli_query($cn,"call new_prodimg ($last_id,'$file_name1')");
    }

    if( mysqli_error($cn)) echo mysqli_error($cn) ;

    else header("location:../addproduct.php");



}
/*else echo !empty($_POST["un"]).'<br>'.
    !empty($_POST["desc"]).'<br>'.
        !empty($_POST["price"]).'<br>'.
            !empty($_POST["cat"]).'<br>'.
                !empty($_POST["quant"]).'<br>'.
                    !empty($_POST["brand"]);*/
