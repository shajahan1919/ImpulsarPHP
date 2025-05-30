<center><h1>WelCome</h1></center>
<br>Language Default:<?php echo $this->language('basic.home.welcome_message'); ?><br>
<br>Language Hindi:<?php echo $this->language('basic.home.welcome_message','hi'); ?><br>
<br>Language Telug:<?php echo $this->language('basic.home.welcome_message','tel'); ?><br>
<br>Language English:<?php echo $this->language('basic.home.welcome_message','en'); ?><br>
<br>
<br>User1 Lat,Longs: 17.3981833,78.4198291<br>
<br>User2 Lat,Longs: 17.5159184,78.5205795<br>
<br>Distance from User1 to User2 : <?php echo round($this->geoLocation->distanceByLatLong(17.5159184,78.5205795,17.3981833,78.4198291,'K'),2);?> KM<br>
<br>ROOT_DIR_PATH: <?php echo $this->getRootDir(); ?><br>
<br>VENDOR_BASIC_EXPIRY_DAYS: <?php echo $this->getUserConstant('VENDOR_BASIC_EXPIRY_DAYS'); ?><br>
<br>APP_NAME_CONSTANT: <?php echo $this->getUserConstant('APP_NAME'); ?><br>
<br>site_url: <?php echo $this->site_url(); ?><br>
<br>GUID Test: <?php echo $this->guid(); ?><br>
<br>APP_ENV: <?php echo $this->getEnv('APP_ENV'); ?><br>
<br>APP_NAME: <?php echo $this->getEnv('APP_NAME'); ?><br>

<br>cache Name: <?php echo $this->cache->get('Name'); ?><br>
<br>cache Age: <?php echo $this->userCache->get('Age'); ?><br>
<br>
<?php
phpinfo();
?>
