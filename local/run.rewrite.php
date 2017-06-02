<?php
/*
	Stempora web framework
	copyright (c) 2002-2013 Stempora
		web:  www.stempora.com
		mail: support@stempora.com

	$Id: name.php,v 0.0.1 dd/mm/yyyy hh:mm:ss oxylus Exp $
	description
*/



//$_MODULES["stembase"]->private->vars->data["set_links_type"] = "1";
// dependencies
global $_GET , $myget , $site , $_LANG , $_LANG_RAW;

//$_MODULES["stembase"]->private->vars->data["set_links_type"] = 1;


if ($_SERVER["REQUEST_URI"]) {
	$_SERVER_URL = $_SERVER["REQUEST_URI"];
} else
	$_SERVER_URL = $_SERVER["REDIRECT_URL"];

$_SERVER_URL = urldecode(($_SERVER_URL));

//check if the site its hosted in a subdomain
if ($script_path = dirname($_SERVER["SCRIPT_NAME"])) {
	
	if ($script_path != "/") {
		$_SERVER_URL = str_replace(
			$script_path , 
			"", 
			$_SERVER_URL
		);
	}	
}
//check if the urls its build with index.php

//check for the default configuration for links
if (substr($_SERVER_URL,0,1) == "/") {
	$_SERVER_URL = substr($_SERVER_URL,1);
} 


if (stristr($_SERVER_URL , "?")) {
	$proc = explode("?" , $_SERVER_URL);
	$vars = $proc["1"];
	$_SERVER_URL = $proc[0];

	$vars = @explode("&" , $vars);

	if (count($vars)) {
		foreach ($vars as $key => $val) {
			$var = explode("=" , $val);			
			$_GET[$var[0]] = urldecode($var[1]);
		}		
	}
}


if ($site->vars->data["set_multilanguage"]) {

	if ($_GET["_LANG"]) {
		$_LANG = $_GET["_LANG"];
	} else {
	
		$tmp = explode("/" , $_SERVER_URL);

		if (!trim($tmp[1]) && (count($tmp)==2)) {
			unset($tmp[1]);
		}
		

		if (count($tmp) >= 2) {
			$mod_code = trim($tmp[1]);		
		}

		//auto insert the language code
		//fucked up code, will need improvement
		if (strlen($tmp[0]) == 2) {
			global $_LANG;

			$_LANG = $tmp[0];
			$_GET["_LANG"] = $_LANG;

			if (trim($tmp[1]) == "") {
				unset($tmp[1]);
			}
			

			if (count($tmp) == 1) {
				$_SERVER_URL = "";
			}				

			$detected_lang = true;
		} else {
			

			//check if there is any language saved in cookie
			if ($_COOKIE["lang"]) {
				$_LANG = $_COOKIE["lang"];
			} else {			
				//try to detect the language based on the http_accept_language
				 $_LANG = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	
			}
		}
	}


	$site->modules["languages"]->DetectLang($_LANG);


	
} else {

	//read the first language

	$tmp = explode("/" , $_SERVER_URL);
	$mod_code = trim($tmp[0]);

	$site->modules["languages"]->DefaultLang();
}

//if redirects module is loaded check for any possible redirect for this url.
if ($_MODULES["redirects"]) {
	$_MODULES["redirects"]->Detect($_SERVER_URL);
}

if (!$_GET["_LANG"]) {
	$_GET["_LANG"] = $_LANG;
}


if (!$_GET["module_id"]) {

	//fast quick for when the site its in root

		
	if (!$mod_code && !$_SERVER_URL) {

//		if (!$_LANG_RAW["default"]) {
//		}

		//if detected its not default then redirect to detected
		if (!$detected_lang && !$_LANG_RAW["lang_default"]) {
			urlRedirect($_LANG_RAW["link"]);
		}
			
		//get the first module
		$module = $_MODULES["modules"]->GetFirstModule(true);


		if (!$site->vars->data["set_links_type"]) {
			$_SERVER_URL = "/" . $module["mod_url"] . "/";			
		} else {
			$_SERVER_URL = "/" . $module["mod_url"] . "/";
		}
	} else {

		//get the detected module
		$module = $_MODULES["modules"]->GetModuleByCode($mod_code , true);


		//try to read 
		if (!is_array($module) && $mod_code) {
			$module = $_MODULES["modules"]->GetDefaultModuleByUrl($mod_code , true);
		}

	}
}


if (is_array($module)) {


	switch ($module["module_type"]) {
		//instance module
		case "1":
			$_GET["module_id"] = $module["mod_id"];
		break;

		//system module
		case "2":
			$_GET["module_id"] = $module["module_id"];
		break;
	}	
}



//load the redirects path


$redirects = $site->rewriteRules;


//change the modules code in the rules
if (is_array($redirects)) {
	foreach ($redirects as $key => $val) {

		if (trim($val)) {	


			switch ($module["module_type"]) {
				//instance
				case "1":
					$rules[] = str_replace(
						"__" . $module["mod_module_code"] . "_module__" , 
						$module["mod_url"],
						trim($val)
					);
				break;

				//uniquer
				case "2":
					$rules[] = str_replace(
						"__" . $module["module_code"] . "_module__" , 
						$module["module_url"],
						trim($val)
					);
				break;

				default:
					$rules[] = trim($val);
				break;
			}
			
		}
	}

	if (is_array($rules)) {
		//this script its killing the global $_GET
		$htaccess = new HTAccess ($_GET);
		foreach ($rules as $key => $val) {
			$htaccess->setLine($val);				
		}
	}


	//process the link and extra variables
	
	if (!$site->vars->data["set_links_type"]) {
		$link = str_replace("index.php/" , "" , $_SERVER_URL);
	} else  {
		$link = $_SERVER_URL;
	}

	if (substr($link,0,1) == "/") {
		$link = substr($link,1);
	}



	if (strstr($link , "?")) {
		$link = explode("?" , $link );
		$vars = explode("&" , $link["1"]);
		$link = $link[0];
		
		foreach ($vars as $key => $val) {
			$tmp = explode("=" , $val );
			if (!$_GET[trim($tmp[0])])
				$_GET[trim($tmp[0])] = ($tmp[1]);
		}								
	}			

//		debug($link,1);


	if (is_Array($rules)) {
		$htaccess->execute($link);
	}

	if ($_GET["_PAGE"]) {
		global $_PAGE;
		$_PAGE = $_GET["_PAGE"];
	}			
	
	if ($_GET["sub"]) {
			//ckean the output as far
			//ob_clean();
			header("HTTP/1.1 200 OK");
	}
}


global $_LANG , $_TSM;

if ($_GET["_LANG"] && !$_LANG) {

	$_LANG = $_GET["_LANG"];

}

if ($site->vars->data["set_multilanguage"]) {
	if (!$_GET["_LANG"]) {
		$_LANG = $_GET["_LANG"] = $site->vars->data["set_language"];
	}
}

$_TSM["_LANG"] = $_LANG;


if (STP_ENABLE_ONEPAGE &&($_PAGE != "ajax") && is_object($_MODULES["onepage"]) ) {
	$_MODULES["onepage"]->Load();
}

if (($_PAGE != "ajax") && is_object($_MODULES["maintenance"]) ) {
	$_MODULES["maintenance"]->Load();
}


//check if the scriptname its php
if ($_GET["mod"] == "detect-redirect") {

	$_GET["mod"] = "redirects";
	$_GET["module_id"] = "redirects";
	$_GET["sub"] = "errorpage";
	$_GET["code"] = "404";

	//$_TSM["PB_EVENTS"] = $_MODULES["redirects"]->ErrorPage("404" , true);
	global $_PAGE;
	$_PAGE = "admin/modules/redirects/pages/";
}


?>