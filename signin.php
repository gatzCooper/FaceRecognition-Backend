<?php
include('layout/headF.php');
?>

<div>
    <h2 style=" color: #FFFF00; font-size:55px; font-family: impact; padding-top: 10px; text-align:center; text-shadow: 3px 3px  #0000FF"> FACE RECOGNITION DTR</h2>
</div>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>

        <div>
            <h1 class="logo-name"><img src="assets/images/logo.png" alt="logo" width="100%"></h1>

        </div>
        <h3>&nbsp;</h3>
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
            <p class="text-muted text-center">
                <small>Do not have an account?</small>
            </p>
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
