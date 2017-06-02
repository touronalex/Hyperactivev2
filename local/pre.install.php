<?php
/*
	Stempora Web Framework
	Copyright (c) 2002-2014 Stempora. 
	All rights reserved.
		web:  www.stempora.com
		mail: support@stempora.com				
*/

global $base;

if (!$base->vars->data["set_installer_done"]) {
	urlredirect("admin/");
}


?>