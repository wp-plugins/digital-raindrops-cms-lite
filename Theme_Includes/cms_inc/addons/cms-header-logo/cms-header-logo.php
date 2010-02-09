<?php
$logosrc = TEMPLATEPATH. '/images/logo.png';
if (file_exists($logosrc)){ ?>
	<div id="cms-header-logo"> 
	  <a href=<?php echo "'http://www.digitalraindrops.net/'"; ?> ></a>
	</div> 
<?php } ?>