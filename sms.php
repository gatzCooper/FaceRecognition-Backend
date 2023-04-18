<html>
    <head>
    <meta http-equiv="refresh" content="3600;URL='sms.php'">
    </head>
    <body>
    
  


<?php

include_once ('config.php');

function itextmo($number, $message)
{
    $ch = curl_init();
    $parameters = array(
       'apikey' => 'a5abd33c5ee98cc1b2a3e0372e9d7e76', //Your API KEY  
        'number' => $number,
        'message' => $message,
        'sendername' => 'NORZAGARAY COLLEGE'
    );
    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, 1);

    //Send the parameters set above with the request
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

    // Receive response from server
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
}

 
$result = my_query("SELECT *,CONCAT(fname,' ',lname)name   FROM tbl_users   ");
for ($i = 1;  $row = $result->fetch();   $i++) {
    $id = $row['id'];
    $contact = $row['contact'];
    $sched = $row['schedule'];

    $split = explode('-', $sched);
    echo '<br/>';
   echo $split[1];
   echo '<br/>';
   echo  $timeNow = date("h:ia", strtotime("+30 minutes")) ;
   
    if (strtotime($split[1]) == strtotime($timeNow)) { 
    $msg = "ALERT NOTIF 5 MINS BEFORE TO LOGOUT";
      itextmo($contact, $msg);
}else{
$msg = "NO ALERT";
}
 
echo $msg;
}

?>


</body>
</html>