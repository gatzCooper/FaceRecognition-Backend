<?php
include_once('../config.php');


if (isset($_GET['url'])) {
    $url = $_GET['url'];
    header('Location: '.$url);
    die();
}

if ($_GET['do'] == 'resetPassword') {
    $email = $_POST['email'];
    $newpass = $_POST['newpass'];
    $conpass = $_POST['conpass'];

    if ($newpass <> $conpass) {
        $message = 'Input password not matched.';
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    $data = array("password" => endecrypt($newpass, 'd'));
    db_update('tbl_users', $data, ['id' => $_POST['user_id']]);

    $message = "Password successfully reset.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../change-password.php';</script>";
    exit();
}


if ($_GET['do'] == 'updatePassword') {
    $curpass = $_POST['curpass'];
    $curpass = endecrypt($_POST['curpass'], 'd');
    echo $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $conpass = $_POST['conpass'];

    if ($curpass <> $oldpass) {
        $message = 'Old password not matched.';
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    if ($newpass <> $conpass) {
        $message = 'Password not matched.';
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    $data = array("password" => endecrypt($newpass, 'd'));
    db_update('tbl_users', $data, ['id' => $_POST['user_id']]);
    $message = "Password successfully updated.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../change-password.php';</script>";
    exit();
}

if ($_GET['do'] == 'updateAccount') {
    $t = $_GET['do'];
    //   `role`,  `bday`, `age`, `gender`,  `address`, `pic`,    `attempt_no`, `username`, `password`, `status
    $data = array("userNo" => $_POST['userNo'], "fname" => $_POST['fname'], "lname" => $_POST['lname'], "mname" => $_POST['mname'], "contact" => $_POST['contact'], "email" => $_POST['email'],
        "address" => $_POST['address'], "department" => $_POST['department'], "schedule" => $_POST['schedule'],"is_teaching" => $_POST['is_teaching']);
    db_update('tbl_users', $data, ['id' => $_POST['user_id']]);

    $message = "Information successfully updated.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../ae-account.php?t=$t';</script>";
    exit();
}


if ($_GET['do'] == 'updateVaccine') {
    $t = $_GET['do'];
    $data = array("vaccine_status" => $_POST['vaccine_status']);
    db_update('tbl_users', $data, ['id' => $_POST['user_id']]);
    $message = "Information successfully updated.";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../ae-account.php?t=$t';</script>";
    exit();
}


if ($_GET['do'] == 'logout') {
    unset($_SESSION['user_id']);
    unset($_SESSION['Clogged_in']);
    unset($_SESSION['user_id']);
    unset($_SESSION['org_id']);
    unset($_SESSION['profile_pic']);
    unset($_SESSION['user_name']);
    unset($_SESSION['logged_in']);

    $message = "Successfully Logout.\\n";
    echo "<script type='text/javascript'>alert('$message');window.location.href='../index.php';</script>";
    exit();
}


?>