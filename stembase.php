<?php
/*
	Stempora Web Framework
	Copyright (c) 2002-2014 Stempora. 
	All rights reserved.
		web:  www.stempora.com
		mail: support@stempora.com				
*/


if ($_SERVER["REQUEST_URI"]) {
	if (is_array($tmp = explode("?" , $_SERVER["REQUEST_URI"]))) {
		$tmp = explode("&" , $tmp["1"]);
		foreach ($tmp as $key => $val) {
			$_tmp = explode("=" , $val);

			if ($_tmp[0]) {
				$_GET[$_tmp[0]] = urldecode($_tmp[1]);
			}			
		}		
	}	
}

$_PAGE = $_GET["_PAGE"];
$_ADMIN = false;

$time = microtime(true);

require "admin/config.php";

$time2 = microtime(true);

if ($_PAGE !="ajax") {

//	echo "<pre>Execution Time: " . (($time2 - $time))  . " seconds</pre>";
//	echo "<pre>Num Queries: " . $site->db->NumQueries() . "</pre>";
	/*
	echo "<pre>Queries: \n";
	print_r($site->db->queries);
	echo "</pre>";
*/
}


?>