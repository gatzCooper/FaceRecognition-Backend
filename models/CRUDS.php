<?php
require_once "../config.php";
echo $function = $_POST['func_param'];

switch ($function) {

    //Advertisement
    case "IUAdvertisement" :
        $temp = $_FILES["img"]["tmp_name"];
        $img = $_FILES["img"]["name"];
        move_uploaded_file($temp, "../assets/uploads/" . $img);

        $data = array("img" => $img, "url" => $_POST['url'],"title" => $_POST['title'], "description" => $_POST['description']);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_advertisements', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../advertisements.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_advertisements', $data);
            echo "<script type='text/javascript'>window.location.href='../advertisements.php?r=added';</script>";
        }
        break;

    case "deleteAdvertisement" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_advertisements', $where);
        echo "<script type='text/javascript'>window.location.href='../advertisements.php?r=deleted';</script>";
        break;



    //User
    case "IUUser" :
        $role = $_POST['role'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $username = $_POST['email'];
        $password = endecrypt($_POST['password'], 'e');

        $email = $_POST['email'];
        $emailCode = substr(md5(mt_rand()), 0, 32);
        $status =  $_POST['status'];

        $data = array( "userNo" => $_POST['userNo'], "email" => $email, "contact" => $contact,
            "fname" => $fname, "lname" => $lname, "mname" => $mname, "role" => $role, "username" => $username, "password" => $password,
             "status" =>$status, "emailCode"=>$emailCode,"address" => $_POST['address'],"department" => $_POST['department'],"schedule" => $_POST['schedule']);


        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_users', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../users.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_users', $data);
            echo "<script type='text/javascript'>alert('User Added successfully.');window.location.href='../users.php?r=added';</script>";
        }
        break;

    case 'deleteUser':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $data = array('status' => 'Deleted');
        $query = db_update('tbl_users', $data, $where);
        echo "<script type='text/javascript'>window.location.href='../users.php?r=deleted';</script>";
        break;

    //Constant
    case "IUConstant" :
        $category = $_POST['category'];
        $value = $_POST['value'];
        $sub_value = $_POST['sub_value'];
        $data = array("category" => $category, "value" => $value, "sub_value" => $sub_value);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_constants', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../constants.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_constants', $data);
            echo "<script type='text/javascript'>window.location.href='../constants.php?r=added';</script>";
        }
        break;

    case "deleteConstant" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_constants', $where);
        echo "<script type='text/javascript'>window.location.href='../constants.php?r=deleted';</script>";
        break;

    //USer schedule

    case "User_Schedule":
   // Retrieve form data
   $userID = $_POST['id'];
   $workDay = $_POST['workDay'];
   $subjectCode = $_POST['SubjectCode'];
   $startTime = $_POST['startTime'];
   $endTime = $_POST['endTime'];
   $currentDate = new DateTime();


    // Format the combined date and time value into a string
    $formattedStartTime = date('H:i:s', strtotime($startTime));
    $formattedEndDateTime = date('H:i:s', strtotime($endTime));

    $db = db_connect();
    $query ="INSERT INTO tbl_schedule(userId,workDay,startTime,endTime,subjectCode)VALUES($userID, '$workDay', '$formattedStartTime', '$formattedEndDateTime', '$subjectCode' )";
    
    try {
        $sth = $db->prepare($query);
        $sth->execute();

    } catch (PDOException $e) {
    }

    echo "<script type='text/javascript'>alert('Schedule has been added.');window.location.href='../users.php?r=added';</script>";
    break;

}
?>