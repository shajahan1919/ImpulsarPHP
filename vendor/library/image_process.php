<?php
	/*
		Library : Image Process
		Description	: To manipulate or work with Images
		Author		: Shajahan Basha Syed
		
	*/
	class image_process{
		function resizeImage($image, $width, $height, $scale) {
			$image_data 	= getimagesize($image);
			$imageType 		= image_type_to_mime_type($image_data[2]);
			$newImageWidth 	= ceil($width * $scale);
			$newImageHeight = ceil($height * $scale);
			$newImage 		= imagecreatetruecolor($newImageWidth,$newImageHeight);
			
			switch($imageType) {
				case "image/gif":
					$source = imagecreatefromgif($image); 
					break;
				case "image/pjpeg":
				case "image/jpeg":
				case "image/jpg":
					$source = imagecreatefromjpeg($image); 
					break;
				case "image/png":
				case "image/x-png":
					$source = imagecreatefrompng($image); 
					break;
			}
			imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
			
			switch($imageType) {
				case "image/gif":
					imagegif($newImage,$image); 
					break;
				case "image/pjpeg":
				case "image/jpeg":
				case "image/jpg":
					imagejpeg($newImage,$image,90); 
					break;
				case "image/png":
				case "image/x-png":
					imagepng($newImage,$image);  
					break;
			}
			chmod($image, 0777);
			
			return $image;
		}
		
		function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
			list($imagewidth, $imageheight, $imageType) = getimagesize($image);
			$imageType 									= image_type_to_mime_type($imageType);
			
			$newImageWidth 	= ceil($width * $scale);
			$newImageHeight = ceil($height * $scale);
			$newImage 		= imagecreatetruecolor($newImageWidth,$newImageHeight);
		   
			switch($imageType) {
				case "image/gif":
					$source = imagecreatefromgif($image); 
					break;
				case "image/pjpeg":
				case "image/jpeg":
				case "image/jpg":
					$source = imagecreatefromjpeg($image); 
					break;
				case "image/png":
				case "image/x-png":
					$source = imagecreatefrompng($image); 
					break;
			}
			imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
			switch($imageType) {
				case "image/gif":
					imagegif($newImage,$thumb_image_name); 
					break;
				case "image/pjpeg":
				case "image/jpeg":
				case "image/jpg":
					imagejpeg($newImage,$thumb_image_name,90); 
					break;
				case "image/png":
				case "image/x-png":
					imagepng($newImage,$thumb_image_name);  
					break;
			}
			chmod($thumb_image_name, 0777);
			
			return $thumb_image_name;
		}
		
		function getHeight($image) {
			$sizes = getimagesize($image);
			$height= $sizes[1];
			
			return $height;
		}
		
		function getWidth($image) {
			$sizes = getimagesize($image);
			$width = $sizes[0];
			
			return $width;
		}
	}
	class SimpleImage {
   
		   var $image;
		   var $image_type;
		 
		   function load($filename) {
			  $image_info = getimagesize($filename);
			  $this->image_type = $image_info[2];
			  if( $this->image_type == IMAGETYPE_JPEG ) {
				 $this->image = imagecreatefromjpeg($filename);
			  } elseif( $this->image_type == IMAGETYPE_GIF ) {
				 $this->image = imagecreatefromgif($filename);
			  } elseif( $this->image_type == IMAGETYPE_PNG ) {
				 $this->image = imagecreatefrompng($filename);
			  }
			 
		   }
		 function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
			  if( $image_type == IMAGETYPE_JPEG ) {
				 imagejpeg($this->image,$filename,$compression);
			  } elseif( $image_type == IMAGETYPE_GIF ) {
				 imagegif($this->image,$filename);         
			  } elseif( $image_type == IMAGETYPE_PNG ) {
				 imagepng($this->image,$filename);
			  }   
			  if( $permissions != null) {
				 chmod($filename,$permissions);
			  }
		 }
		 function output($image_type=IMAGETYPE_JPEG) {
			  if( $image_type == IMAGETYPE_JPEG ) {
				 imagejpeg($this->image);
			  } elseif( $image_type == IMAGETYPE_GIF ) {
				 imagegif($this->image);         
			  } elseif( $image_type == IMAGETYPE_PNG ) {
				 imagepng($this->image);
			  }   
		 }
		 function getWidth() {			 
			  return imagesx($this->image);
		 }
		 function getHeight() {
			  return imagesy($this->image);
		 }
		 function resizeToHeight($height) {
			  $ratio = $height / $this->getHeight();
			  $width = $this->getWidth() * $ratio;
			  $this->resize($width,$height);
		 }
		 function resizeToWidth($width) {
			   $w = $this->getWidth();
			   if($w>$width)
			  {
			  $ratio = $width / $this->getWidth();
			  $height = $this->getheight() * $ratio;
			  $this->resize($width,$height);
			  }
		 }
		 function scale($scale) {
			 $w = $this->getWidth();
			 $h=$this->getHeight();
			  if($w>$scale)
			  {
			  $width = ($scale/$w) * $w;
			  $height = ($scale/$h) * $h;
			  $this->resize($width,$height);
			  }
		 }
		 function resize($width,$height) {
			  $new_image = imagecreatetruecolor($width, $height);
			  imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
			  $this->image = $new_image;   
		 } 
	   
	}
?>