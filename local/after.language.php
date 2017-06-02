<?php
/*
	Stempora web framework
	copyright (c) 2002-2013 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
*/


global $site;

if ($site->vars->data["set_multilanguage"]) {
	$_TSM["PUB:LANG_MENU"] = $site->modules["languages"]->Menu();
} else {
	$_TSM["PUB:LANG_MENU"] = "";
}

global $_LANG;

$_TSM["PUB:LANG"] = $_LANG;


//global language

//global $_LANG_DATA;

$_LANG_DATA  = $site->modules["languages"]->LoadVars();

if (is_array($_LANG_DATA)) {

	$_TSM = array_merge(
		$_LANG_DATA , 
		$_TSM
	);

}



global $_LANG_RAW;
$_TSM["PUB:LANG_DIR"] = $_LANG_RAW["lang_dir"];
$_TSM["PUB:TIMESTAMP"] = time();