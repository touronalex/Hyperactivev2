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

if ($_MODULES["shortcodes"]) {
	$this->layout->body->output = $_MODULES["shortcodes"]->Process($this->layout->body->output);
}

?>