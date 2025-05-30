<?php

	/*
		Library : Device / BrowserFind
		Description	: For Device / UDID Operation
		Author		: Shajahan Basha Syed
		
	*/
	
class device{
	var $domain;
	
	function __Construct($domain){
		$this->$domain = $domain;
	}
	function visitorIP(){ 
	
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
				$TheIp=$_SERVER['REMOTE_ADDR'];  
		} 
						
		return trim($TheIp);
	}
	function curPageURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $this->$domain.":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } 	else {
		  $pageURL .= $this->$domain.$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}	
	function BrowserFind(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')){$browser = 'Chrome';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')){$browser = 'Safari';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko')){if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')){$browser = 'Netscape';}else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/4.0.1')){
			 $browser = 'Mozilla4';}else{$browser = 'Mozilla3';}}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')){$browser = 'InternetExplorer8';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')){$browser = 'InternetExplorer7';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')){$browser = 'InternetExplorer6';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')){$browser = 'InternetExplorer9';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')){$browser = 'InternetExplorer10';}
		else if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') === true){$browser = 'Opera';}
		else{$browser = 'Other browsers';}
		return $browser;
	}	
	function getDevice(){
		$tablet_browser = 0;
		$mobile_browser = 0; 
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		} 
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		} 
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
		} 
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
					'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
					'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
					'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
					'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
					'newt','noki','palm','pana','pant','phil','play','port','prox',
					'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
					'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
					'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
					'wapr','webc','winw','winw','xda ','xda-');
				 
		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		} 
		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
			$mobile_browser++;
			//Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
			  $tablet_browser++;
			}
		}
		if ($tablet_browser > 0) {
		   $browser_info='tablet';
		}
		else if ($mobile_browser > 0) {
		   $browser_info='mobile';
		}
		else {
		   $browser_info='desktop';
		}
		return $browser_info;
	}

}
?>