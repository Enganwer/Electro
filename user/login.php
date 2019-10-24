    <?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset( $_SESSION["uun"]))
        header("location:index.php");
    include "header.php";
    ?>
    <div class="account-in">
        <div class="container" style="text-align: left">


            <div class="col-md-6 account-top ">
                <form method="post" action="process/login_proc.php"  class="demo-form" data-parsley-validate="" style="text-align: left ; ">
                    <div style="text-align: left">
                        <h3>Account</h3>
                        <span>*User Name <span>
                        <input type="text"  name="un" class="form-control" required="" style="width: 300px; align-content: left">
                    </div>
					<br>
                    <div style="text-align: left">
                        <span class="pass">*Password </span>
                        <input type="password"  required name="pw" class="form-control" required style="width: 300px">
                    </div >
					<div class="col-md-6">
                    <input type="submit" value="Login" class="form-control">
					</div>
                    <script>
                        $(function(){
                            $('.parsley-validate').parsley();
                        })
                    </script> <br>

                </form>
            </div>
            <div class="clearfix"> </div>
            <a href="register.php"  class="create col-md-2 col-md-offset-3">New Account</a>
        </div>

    </div>

    <?php include "footer.php"?>


