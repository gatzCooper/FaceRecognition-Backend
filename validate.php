<?php 
require_once('config.php');
// extracting POST Variables
extract($_POST);
$error = [];

$stmt = $db->prepare("SELECT * FROM `tbl_users` WHERE userNo = :userNo ");
$stmt->bindParam(':userNo', $userNo, PDO::PARAM_STR);
if (isset($id) && $id > 0) {
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
}

$stmt->execute();
if ($stmt->rowCount() > 0) {
    $error['field_name'] = 'userNo';
    $error['msg']=" Id Number is already exists on the user list";
}

echo json_encode($error);
?>
