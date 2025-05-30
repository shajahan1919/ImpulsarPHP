<?php
	/*
		Library : General
		Description	: For general operation functions
		Author		: Shajahan Basha Syed
		
	*/
	class generators{
		public function password_generator($size){
			$characters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9","!","#","_","%","&");
					//make an "empty container" or array for our keys
			$keys = array();			
			//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
			while(count($keys) < $size) {				
				$x = mt_rand(0, count($characters)-1);
				if(!in_array($x, $keys)) {
				   $keys[] = $x;
				}
			}			
			foreach($keys as $key){
			   $random_chars .= $characters[$key];
			}
			return $random_chars;
		}

		public function username_generator($namestring,$size){
			$characters = array("0","1","2","3","4","5","6","7","8","9");
					//make an "empty container" or array for our keys
			$keys = array();			
			//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
			while(count($keys) < $size) {				
				$x = mt_rand(0, count($characters)-1);
				if(!in_array($x, $keys)) {
				   $keys[] = $x;
				}
			}			
			foreach($keys as $key){
			   $random_chars .= $characters[$key];
			}
			$username = $namestring.$random_chars;
			return $username;
		}
		public function username_cgenerator($namestring,$size){
			$characters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9");
					//make an "empty container" or array for our keys
			$keys = array();			
			//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
			while(count($keys) < $size) {				
				$x = mt_rand(0, count($characters)-1);
				if(!in_array($x, $keys)) {
				   $keys[] = $x;
				}
			}			
			foreach($keys as $key){
			   $random_chars .= $characters[$key];
			}
			$username = $random_chars;
			return $username;
		}
		public function rannum_generator($namestring,$size){
			$characters = array("0","1","2","3","4","5","6","7","8","9");
					//make an "empty container" or array for our keys
			$keys = array();			
			//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
			while(count($keys) < $size) {				
				$x = mt_rand(0, count($characters)-1);
				if(!in_array($x, $keys)) {
				   $keys[] = $x;
				}
			}			
			foreach($keys as $key){
			   $random_chars .= $characters[$key];
			}
			$username = $namestring.$random_chars;
			return $username;
		}
	}

?>