<?php
/*
		Library : Mailer
		Description	: For Email operations
		Author		: Shajahan Basha Syed
		
	*/
	class mailer{
		var $status;
		var $headers;
		var $from;
		var $to;
		var $subject;
		var $message;
		
		function __Construct(){
			$this->status=null;
		}
		
		function send_mail($from,$to,$subject,$message){
			$this->from = $from;
			$this->to = $to;
			$this->subject = $subject;
			$this->message = $message;
			$this->headers = "MIME-Version: 1.0 \r\nFrom: ".$this->from. "\r\n";
			$this->status = mail($this->to,$this->subject,$this->message,$this->headers);
			return $this->status;
		}
		
		function send_webmail($from,$to,$subject,$message){
			$this->from = $from;
			$this->to = $to;
			$this->subject = $subject;
			$this->message = stripslashes($message);
			$this->headers = "MIME-Version: 1.0 \r\nContent-type:text/html;charset=UTF-8" . "\r\nFrom: ".$this->from. "\r\n";
			$this->status = @mail($this->to,$this->subject,$this->message,$this->headers);
			return $this->status;
		}


		function send_webmail_attachment($from,$to,$subject,$message, $filepath){
			$eol = PHP_EOL;
			$separator = md5(time());  
			$this->from = $from;
			
			$this->to = $to;
			$this->subject = $subject;
			$this->message = stripslashes($message);
			$filepathArray = explode("/",$filepath);
			$filename = end($filepathArray);

			$headers = "";
 
			// main header
			if( !empty($from) )
			$headers  .= "From: ".$this->from.$eol;	
			
			if( !empty($from) )
			$headers .= "Reply-To: ". $this->from.$eol;	
		
			$headers .= "MIME-Version: 1.0".$eol; 	
			

			$attachment = chunk_split( base64_encode(file_get_contents($filepath)) );

			$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";
			$this->headers = $headers;

			$body = "";
			$body .= "--".$separator.$eol;
			$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
			$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;//optional defaults to 7bit
			$body .= $this->message.$eol;
		
			// attachment
			$body .= "--".$separator.$eol;
			$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
			$body .= "Content-Transfer-Encoding: base64".$eol;
			$body .= "Content-Disposition: attachment".$eol.$eol;
			$body .= $attachment.$eol;
			$body .= "--".$separator."--";
			
			$this->status = @mail($this->to,$this->subject,$body,$this->headers);
			return $this->status;
		}
		
	}
?>