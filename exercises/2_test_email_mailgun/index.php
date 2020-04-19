<?php
    //https://github.com/mailgun/mailgun-php
    //Authorized Recipients -> afegir a 'yomogan@gmail.com'
    
    function send_mailgun($email){
    	$config = array();
    	$config['api_key'] = "3c810cd432414abf720c814ed946e7a9-915161b7-4f781302"; //API Key
    	$config['api_url'] = "https://api.mailgun.net/v2/sandbox055a9dec63954d5391e27b99c28e326f.mailgun.org/messages"; //API Base URL

    	$message = array();
    	$message['from'] = "admin@neteco.com";
    	$message['to'] = $email;
    	$message['h:Reply-To'] = "ruralshoponti@gmail.com";
    	$message['subject'] = "Hello, this is a test";
    	$message['html'] = 'Hello ' . $email . ',</br></br> This is a test';
     
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $config['api_url']);
    	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    	curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_POST, true); 
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	return $result;
    }
    
    $json = send_mailgun('yomogan@gmail.com');
    print_r($json);
