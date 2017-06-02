<?php
/*
	Stempora web framework
	copyright (c) 2002-2013 Stempora
		web:  www.oxylus.ro
		mail: support@oxylus.ro		

*/



	if (strtoupper($_SERVER["HTTPS"]) == "ON") {

		$_TSM["PRIV.BASE.HREF"] = 	"https://" . dirname( $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"] ) . "/";
	} else {
		$_TSM["PRIV.BASE.HREF"] = 	"http://" . dirname( $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"] ) . "/";
	}
	
		


	$_CONF["url"] = $_TSM["PRIV.BASE.HREF"] ;


	$_TSM["PRIV.SELF_URI"] = 
			((strtoupper($_SERVER["HTTPS"]) == "ON" ? "https://" :  "http://") . 
			$_SERVER["HTTP_HOST"] . 
//			($_SERVER["SERVER_PORT"] != 80 ? ':' . $_SERVER["SERVER_PORT"] : '') .
			$_SERVER["REQUEST_URI"]);

	$_TSM["PRIV.SELF_URI_ENC"] = urlencode($_TSM["PRIV.SELF_URI"]);

	$_TSM["PRIV.SELF_URI_NV"] = @explode("?" , $_TSM["PRIV.SELF_URI"]);
	$_TSM["PRIV.SELF_URI_NV"] = $_TSM["PRIV.SELF_URI_NV"][0];
	
?>