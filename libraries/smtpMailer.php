<?php

require 'PHPMailer-master/PHPMailerAutoload.php';

class smtpMailer{

  var $mailer;

  function __Construct(){
	
    $this->mailer = new PHPMailer;

    return $this->mailer;
  }
  
  function settings($settings){
	 
	 
    $this->mailer->isSMTP($settings['isSMTP']);
    $this->mailer->SMTPDebug = $settings['SMTPDebug'];
    
    $this->mailer->Host = $settings['Host'];
    $this->mailer->Port = $settings['Port'];
    $this->mailer->SMTPAuth = $settings['SMTPAuth'];
    $this->mailer->SMTPSecure = $settings['SMTPSecure'];
    $this->mailer->Username = $settings['Username'];
    $this->mailer->Password = $settings['Password'];
    $this->mailer->isHTML($settings['isHTML']);

    $this->mailer->setFrom($settings['senderEmail'], $settings['senderName']);
  }
  function smtpdetails(){
    $smtp = array();
    $smtp['Host'] = $this->mailer->Host;
    $smtp['Port'] = $this->mailer->Port;
    $smtp['SMTPAuth'] = $this->mailer->SMTPAuth;
    $smtp['SMTPSecure'] = $this->mailer->SMTPSecure;
    $smtp['Username'] = $this->mailer->Username;
    $smtp['Password'] = $this->mailer->Password;
    return $smtp;
  }
  function toAddress($email,$name=''){ 
    $this->mailer->addAddress($email,$name);
  }

  function addReplyTo($email,$name=''){
    $this->mailer->addReplyTo($email,$name='');
  }


  function addCC($email,$name=''){
    $this->mailer->addCC($email,$name);
  }

  function addBCC($email,$name=''){
    $this->mailer->addBCC($email,$name);
  }

  function send($subject,$message){
    $this->mailer->Subject = $subject;
   
	if($this->mailer->isHTML){		
		 $this->mailer->msgHTML = $message;
		 $mail->AltBody = $subject;
	} else{
		 $this->mailer->Body = $message;
		
	}
    
    $status = $this->mailer->send();
    return $status;
  }

  function errorMessage(){
    return $this->mailer->ErrorInfo;
  }


}
?>
