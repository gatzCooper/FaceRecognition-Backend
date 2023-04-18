<?php
include('layout/headF.php');
?>


<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name"><img src="assets/images/logo.png" alt="logo" width="100%"></h1>

        </div>
        <h3>&nbsp;</h3>
        <form class="m-t" method="POST" action="models/user.php?do=forgotPassword">

            <div class="form-group">
              <h2>Enter your email</h2>
                <input type="text" name="email" class="form-control" placeholder="Email" required="" autofocus>
            </div>


            <button type="submit" name="btnlogin" class="btn btn-primary block full-width m-b">Submit</button>


        
            <a class="btn btn-sm btn-white btn-block" href="signin.php">Signin</a>
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
