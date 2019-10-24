<?php
session_start();
if(!empty( $_SESSION["uun"]))
    header("location:index.php");
session_abort();
include "header.php";
?>
<head>
    <style>
        .mans {
            background: #F9D9BE;
            color: #000;
            font-size: 1em;
            padding: 0.8em 2em;
            transition: 0.5s all;
            -webkit-transition: 0.5s all;
            -moz-transition: 0.5s all;
            -o-transition: 0.5s all;
            display: inline-block;
            text-transform: uppercase;
            border: none;
            outline: none;
            margin-left: 10%;
            margin-top: 1%;
            width: 20%;
        }
        .mans:hover{
            background: #000;
            color:#F9D9BE;
        }
    </style>
</head>
<div class="account-in">
    <div class="container">
        <form action="process/registration_proc.php" method="post" data-parsley-validate="">
            <div class="register-top-grid register-bottom-grid " style="text-align: right">
                <h2>معلومات شخصيه</h2>
                <div style="text-align: right">
                    <span>الاسم كامل<label>*</label></span>
                    <input type="text" name="fname" required="">
                </div>

                <div style="text-align: right">
                    <span>اسم المستخدم<label>*</label></span>
                    <input type="text" name="un" required="">
                </div>
                <div style="text-align: right">
                    <span>الهاتف<label>*</label></span>
                    <input type="text" name="mob" required data-parsley-pattern="05\d{8}">
                </div>
                <div style="text-align: right">
                    <span>كلمه المرور<label>*</label></span>
                    <input type="password" id="pw" name="pw" required>
                </div>
                <div style="text-align: right">
                    <span>تأكيد كلمه المرور<label>*</label></span>
                    <input type="password" data-parsley-equalto="#pw" required>
                </div>
                <div style="text-align: right">
                    <span>العنوان<label>*</label></span>
                    <input type="text" name="address" required>
                </div>
                <div class="clearfix"> </div>

                </div>
            </div>
    <input type="submit" class="mans" align="left" value="تأكيد">
    <script>
        $(function(){
            $('.parsley-validate').parsley();
        })
    </script>
        </form>

    </div>
</div>
<?php include "footer.php"?>
