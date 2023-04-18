<?php


  function itexmo(){
    try {
        $ch = curl_init();
        $itexmo = array(
            "Email"=> "aliali091726@gmail.com",
            "Password"=> "itexmopass1.",
            "ApiCode"=> "PR-MEDDI119133_03BZN",
            "Message"=> "Test itexmo",
            "Recipients"=> ["09959155840","09959155840"],
        );
        curl_setopt($ch, CURLOPT_URL , "https://api.itexmo.com/api/broadcast-2d");
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS , http_build_query($itexmo));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        $response  =curl_exec($ch);
        curl_close($ch);

        return $response;
    }catch (Exception $ex){
        return $ex->getMessage();
    }
}

itexmo();



function itextmo($number,$message){
    $ch = curl_init();
    $parameters = array(
        'apikey' => '3c14fc0a1cf07e58bfdb191a189a0e74', //Your API KEY
        'number' => $number,
        'message' => $message,
        'sendername' => 'SEMAPHORE'
    );
    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt( $ch, CURLOPT_POST, 1 );

    //Send the parameters set above with the request
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

    // Receive response from server
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close ($ch);
}

//itextmo('09959155840','Testing semaphone');



?>