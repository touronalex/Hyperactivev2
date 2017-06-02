<?php
/*
	Stempora Web Framework
	Copyright (c) 2002-2014 Stempora. 
	All rights reserved.
		web:  www.stempora.com
		mail: support@stempora.com				
*/

global $site;

$_TSM["PUB:HOME_LINK"] = $_CONF["url"] . ($site->vars->data["set_multilanguage"] ?  $_LANG . "/" : "");

?>