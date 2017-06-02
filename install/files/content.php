<?php
/*
	Stempora Web Framework
	Copyright (c) 2002-2014 Stempora. 
	All rights reserved.
		web:  www.stempora.com
		mail: support@stempora.com				
*/

	$content_files = array(
		"files/content/logo.png"	=> "../upload/logo.png",
		"files/content/logo-mini.png"	=> "../upload/logo-mini.png",
		"files/content/avatar.jpg"	=> "../upload/default-images/avatar.jpg",
	);

	foreach ($content_files as $key => $val) {

		copy($key , $val );
		chmod($val, 0777 );

		$output[] = "Copied {$val}";

	}
	
?>