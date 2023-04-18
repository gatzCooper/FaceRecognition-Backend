<?php
include('layout/headF.php');
?>


<div class="container-fluid bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <div class="row">

                </div>
            </div>


            <div class="col-md-4">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h2>Face Recognition Daily Time Record</h2>
            <h1 class="logo-name"><img src="assets/images/logo.png" alt="logo" width="100%"></h1>

        </div>
        <form class="m-t" method="POST" action="models/user.php?do=login">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
            </div>

            <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'" id="rememberme" class="filled-in chk-col-pink">
            <label for="rememberme">Show password</label>

            <button type="submit" name="btnlogin" class="btn btn-primary block full-width m-b">Login</button>


            <a href="#"></a>
            <!-- <p class="text-muted text-center">
                <small>Do not have an account?</small>
            </p> -->
            <!--            <a class="btn btn-sm btn-white btn-block" href="signup.php">Create an account</a> <br/>-->
            <a class="btn btn-sm btn-white btn-block" href="forgotpassword.php">Forgot Password</a>
        </form>
        <p class="m-t"></p>

    </div>
</div>

<!-- Mainly scripts -->
<script src="assets/js/jquery-2.1.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/popup_style.css">
</body>

</html>
