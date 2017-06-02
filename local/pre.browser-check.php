<?php
/*
	Stempora Web Framework
	Copyright (c) 2002-2014 Stempora. 
	All rights reserved.
		web:  www.stempora.com
		mail: support@stempora.com				
*/


preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);

if (count($matches)>1){
	$version = $matches[1];

	switch(true){
		case ($version<9):
			echo CFile::Get("assets/browser/index.html");
			die();
		break;

	}
}

?>