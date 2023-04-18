<nav class="navbar navbar-expand-sm navbar-light bg-light p-0">
    <div class="container">

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <!--USER ACCESS LEVEL-->
                <ul class="navbar-nav m-auto">
                <li class="nav-item active">
                        <a class="nav-link" href="main.php">Home</a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, <?=$_SESSION['fullname'];?></a>
                        <ul class="dropdown-menu fade-up" aria-labelledby="dropdown1">
                            <li class="dropdown-item"><a  href="change-password.php">Change Password</a></li>
                            <li class="dropdown-item" ><a href="ae-account.php?t=updateAccount">Update Account</a></li>
                            <?php if ($_SESSION['role'] == 'Admin') { ?>
                                <li class="dropdown-item" ><a href="account-details.php?t=Details">Account Details</a></li>
                            <?php }?>
                        </ul>
                    </li>
                </ul>


                <?php if ($_SESSION['role'] == 'Admin') { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboards.php">Dashboards</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>

                <li class="nav-item active">
                    <a class="nav-link" href="attendances.php">DTR Report</a>
                </li>
          <!--          <li class="nav-item active">
                        <a class="nav-link" href="advertisements.php">Advertisements</a>
                    </li-->
                <?php }else  { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="myattendance.php">DTR Report</a>
                    </li>

          <?php } ?>
                <li class="nav-item active">
                    <a class="nav-link" href="models/do.php?do=logout" onclick="return  confirm('Are you sure ?')">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

