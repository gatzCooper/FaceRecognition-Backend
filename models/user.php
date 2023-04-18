<?php
include_once('../config.php');

if ($_GET['do'] == 'updateAccount') {
    $data = array("fname" => $_POST['fname'], "lname" => $_POST['lname'], "mname" => $_POST['mname'], "contact" => $_POST['contact'], "email" => $_POST['email'],
        "address" => $_POST['address'] );
    db_update('tbl_users', $data, ['id' => $_SESSION['user_id']]);

    $message = "Information successfully updated.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../updateprofile.php?';</script>";
    exit();
}


if ($_GET['do'] == 'changePasswordUser') { //Changepassword
    $rtype = $_POST['rPassword'];
    $npas = $_POST['nPassword'];
    if ($rtype <> $npas) {
        $message = 'Password not matched.';
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    $cpassword = endecrypt($_POST['cPassword'], 'e');
    $npassword = endecrypt($_POST['nPassword'], 'e');

    $id=$_SESSION['user_id'];
    $result = $db->prepare("SELECT * FROM tbl_users WHERE id='$id' AND password='$cpassword'");
    $result->execute();
    if ($row = $result->fetch()) {
        $q = $db->prepare("UPDATE tbl_users SET password='$npassword' WHERE id='$id'");
        $q->execute(array());
        $_SESSION['password']=$npassword;
        $message = "Successfully changed.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    } else {
        $message = "Invalid old password type.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();

    }
}


if ($_GET['do'] == 'forgotPassword') {
    $email = $_POST['email'];

    $result = $db->prepare("SELECT *,CONCAT(fname,' ',lname) fullname FROM  tbl_users WHERE email='$email'");
    $result->execute();
    if ($row = $result->fetch()) {
        $username = $row['username'];
        $password = endecrypt($row['password'], 'd');
        $to = $email;
        $from = $server_email;
        $subject = $system_title;
        $txt = "Your username $username and password $password";
        $headers = "From:" . $from;
        mail($to, $subject, $txt, $headers);
        $message = 'Email successfully sent';
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    } else {
        $message = 'Email not found.';
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }
}


if ($_GET['do'] == 'saveRegistration') {
    $username = ($_POST['email']);
    $password = endecrypt($_POST['password'], 'e');
    $email = ($_POST['email']);
    $contact = ($_POST['contact']);
    $address = ($_POST['address']);

    $xsplit = explode(",", $_POST['name']);
    $lname = $xsplit[0];
    $fname = $xsplit[1];
    $mname = '';
    $status = 'Active';
    $role = $_POST['role'];
    $emailCode = substr(md5(mt_rand()), 0, 32);

    $userNo = ($_POST['userNo']);

    $bday = ($_POST['bday']);
    $department = ($_POST['department']);
   $schedule= $_POST['schedule'];

    if (strpos($email, '.com') !== false) { }
    else{
        $message = "Email is invalid.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    if (isExists('tbl_users', ['email' => $email]) === true) {
        $message = "Email already exists.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    if (isExists('tbl_users', ['username' => $username, 'password' => $password]) === true) {
        $message = "Username Or Password already exists.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    $data = array("userNo"=>$userNo,"role" => $role, "fname" => $fname, "lname" => $lname,
        "emailCode" => $emailCode, "contact" => $contact, "username" => $username, "address" => $address, "email" => $email,
        "password" => $password,   "status" => $status,"bday"=> $bday,"department"=>$department,"schedule"=>$schedule  );
    $user_id=  db_insert('tbl_users', $data) ;


    $message = "Information successfully added.";
  //  echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php?';</script>";
}

if ($_GET['do'] == 'login') { //Login
       $a = $_POST['username'];
     $b = endecrypt($_POST['password'], 'e');

    $result = $db->prepare("SELECT *,CONCAT(fname,' ',lname) fullname FROM tbl_users WHERE username='$a' ");
    $result->execute();
    if ($row = $result->fetch()) {
        $id=$row['id'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['logged_in'] = "true";
        $_SESSION['user_profile'] = $row['pic'];
        $_SESSION['user_name'] = $row['fullname'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_contact'] = $row['contact'];
        $_SESSION['timestamp'] = time();
        $_SESSION['last_login_timestamp'] = time();
        $attempt=$row['attempt_no'];
        $remain=2-$attempt;

        if ($row['status'] =='Inactive') { //Correct
            $message = "Your account inactive.";
            echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php';</script>";
            exit();
        }

        if ($attempt >= 3) { //Correct
            $message = "Your account is lock.";
            echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php';</script>";
            exit();
        }


        if ($row['password'] == $b) { //Correct
            $res= my_query("UPDATE `tbl_users` SET attempt_no=0  WHERE id='$id'");
            $message = "Log in successfully.";
            if($row['role']=='Admin' ){
                echo "<script type='text/javascript'>window.location.href='../main.php';</script>";
            }else{
                echo "<script type='text/javascript'>window.location.href='../main.php';</script>";
            }
            exit();
        } else {
            $message = "Incorrect username/password.  You have " . $remain ." attempts remain. Your account will disable.";
            $res= my_query("UPDATE `tbl_users` SET attempt_no=attempt_no+1  WHERE id='$id'");
            echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php';</script>";
            exit();
        }


    } else {

        //
        $message = "Invalid username or password.";
        echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php';</script>";
        exit();
    }
}

if ($_GET['do'] == 'logout') {
    unset($_SESSION['user_id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['role']);
    unset($_SESSION['username']);
    unset($_SESSION['Clogged_in']);
    unset($_SESSION['logged_in']);

    $message = "Successfully Logout.\\n";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../index.php';</script>";
    exit();


}

?>