<?php
/*
	Stempora web framework
	copyright (c) 2002-2013 Stempora
		web:  www.stempora.com
		mail: support@stempora.com

	$Id: name.php,v 0.0.1 dd/mm/yyyy hh:mm:ss oxylus Exp $
	description
*/

// dependencies


if ($_MODULES["users"]) {
	$_TSM["PUB:ACCOUNT_BUTTON"] = $_MODULES["users"]->TopMenu();
} else {
	$_TSM["PUB:ACCOUNT_BUTTON"] = "";
}



?>