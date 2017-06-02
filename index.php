<?php 
/*
	Stempora Web Framework
	Copyright (c) 2002-2014 Stempora. 
	All rights reserved.
		web:  www.stempora.com
		mail: support@stempora.com				
*/
error_reporting(0);

//check if the site was installed
if (!file_exists("upload/conf/database.php")) {
	header("Location: install/");
	exit();
}

// dependencies
$_GET["mod"] = "detect-redirect";


require "stembase.php";

?>