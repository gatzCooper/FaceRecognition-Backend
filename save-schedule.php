<?php
// Connect to database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'faceattendancedb';
$conn = mysqli_connect($host, $user, $password, $dbname);

// Retrieve form data
$userid = $_POST['id'];
$day = $_POST['day'];
$subjectcode = $_POST['subjectcode'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

// Insert data into table
$sql = "INSERT INTO tbl_schedule (userid, workday, subjectcode, startTime, endTime) VALUES ('$userid','$day', '$subjectcode', '$startTime', '$endTime')";
$result = mysqli_query($conn, $sql);

// Check if insertion was successful
if ($result) {
  echo 'Schedule saved successfully.';
} else {
  echo 'Error saving schedule: ' . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

?>
