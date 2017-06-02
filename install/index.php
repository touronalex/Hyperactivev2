<?php
/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/

date_default_timezone_set("UTC");
define("_LIBPATH","../admin/lib/");

include_once "../admin/lib/error/error.php";
include_once "../admin/lib/debug.php";
include_once "../admin/lib/template.php";
include_once "../admin/lib/template.dynamic.php";
include_once "../admin/lib/template.static.php";
include_once "../admin/lib/common.php";
include_once "../admin/lib/validator.php";
include_once "../admin/lib/config.php";
include_once "../admin/lib/include/dir.php";
include_once "../admin/lib/include/file.php";
include_once "../admin/lib/html.php";
include_once "../admin/lib/database.php";
include_once "../admin/lib/sessions.php";


SessionManager::sessionStart("STB");

/**
* description
*
* @library	
* @author	
* @since	
*/
class CInstaller{

	

	/**
	* description
	*
	* @var type
	*
	* @access type
	*/
	var $menu = array(
		1	=> array(
			"link"		=> "index.php",
			"title"		=> "Starting Point",
			"nr"		=> "1",
			"class"		=> "not-switched",
		),

		2	=> array(
			"link"		=> "index.php?step=2",
			"title"		=> "Files Integrity",
			"nr"		=> "2",
			"class"		=> "not-switched",
		),

		3	=> array(
			"link"		=> "index.php?step=3",
			"title"		=> "Configuration",
			"nr"		=> "3",
			"class"		=> "not-switched",
		),

		4	=> array(
			"link"		=> "index.php?step=4",
			"title"		=> "MySQL Database",
			"nr"		=> "4",
			"class"		=> "not-switched",
		),

		5	=> array(
			"link"		=> "index.php?step=5",
			"title"		=> "Administrator Info",
			"nr"		=> "5",
			"class"		=> "not-switched",
		),

		6	=> array(
			"link"		=> "index.php?step=6",
			"title"		=> "Installing",
			"nr"		=> "6",
			"class"		=> "not-switched",
		),

		7	=> array(
			"link"		=> "index.php?step=7",
			"title"		=> "Finish Line",
			"nr"		=> "6",
			"class"		=> "not-switched",
		),

	);


	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function CInstaller() {

		$templates = array(
			"layout"	=>	"templates/layout.htm",
			"menu"		=>	"templates/menu.htm",
			"page"		=>	"templates/page.htm",
			"step1"		=>	"templates/step1.htm",
			"step2"		=>	"templates/step2.htm",
			"step3"		=>	"templates/step3.htm",
			"step4"		=>	"templates/step4.htm",
			"step5"		=>	"templates/step5.htm",
			"step6"		=>	"templates/step6.htm",
			"step7"		=>	"templates/step7.htm",
			"installed"	=>	"templates/installed.htm",
		);

		foreach ($templates as $key => $val) {
			$this->templates[$key] = new CTemplateDynamic($val);
		}		
	}

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function CheckCurrentStep() {
		//do nothing for the moment
	}
	

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function DoEvents() {

		$this->CheckInstallPermission();

		$this->CheckCurrentStep();

		switch ($_GET["step"]) {
			default:
				return $this->StepWelcome();
			break;


			case "2":

				if ($_GET["action"] == "check-files") {
					return $this->JSonCheckFiles();
				}
				
				return $this->StepCheckIntegrity();
			break;


			case "3":
				return $this->StepCheckConfiguration();
			break;

			case "4":

				if ($_GET["action"] == "validate") {
					return $this->JSonCheckMysql();
				}

				return $this->StepCheckMysql();
			break;

			case "5":

				if ($_GET["action"] == "validate") {
					return $this->JSonCheckAdmin();
				}

				return $this->StepCheckAdmin();
			break;

			case "6":

				if ($_GET["action"] == "install") {
					return $this->JSONInstall();
				}

				return $this->StepInstall();
			break;

			case "7":
				return $this->StepFinish();
			break;

		}
		
	}
	

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function Render($content , $step) {


		foreach ($this->menu as $key => $val) {
			if ($key < $step) {
				$this->menu[$key]["class"] = "previous-steps";
			} elseif ($key == $step) {
				$page = $this->templates["page"]->BlockReplace(
					"Page" , 
					array(
						"nr"	=> $val["nr"],
						"title"	=> $val["page_title"] ? $val["page_title"] : $val["title"]
					)
				);

				$this->menu[$key]["class"] = "active";
			}
		}
	
		echo $this->templates["layout"]->blockReplace(
			"Main" , 
			array(
				"page"		=> $page,
				"content"	=> $content , 
				"menu"		=> CHTML::Table(
					$this->templates["menu"] , 
					"" , 
					$this->menu
				),
			)
		);

		die();
	}
	

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepWelcome() {


		$this->Render(
			$this->templates["step1"]->blockreplace(
				"Main",
				array(
				
				)
			) , 
			1
		);
	}

	
	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepCheckConfiguration() {


		$checks = array(
			array(
				"title"	=> "Webserver" ,
				"value"	=> function_exists("apache_get_version") ?apache_get_version() :"unknown",
				"class"	=> "ok",
			),

			array(
				"title"	=> "mod_rewrite" ,
				"value"	=> function_exists("apache_get_modules") ?( in_array("mod_rewrite" , apache_get_modules()) ? "loaded" : "missing" ) : "unknown",
				"class"	=> function_exists("apache_get_modules") ? (in_array("mod_rewrite" , apache_get_modules()) ? "ok" : "error") : "ok",
			),

			array(
				"title"	=> "Php Version" ,
				"value"	=> phpversion() ,
				"class"	=> phpversion() > "5" ? "ok" : "error",
			),

			array(
				"title"	=> "Memory Limit" ,
				"value"	=> ini_get("memory_limit"),
				"class"	=> "ok",
			),

			array(
				"title"	=> "Post Size" ,
				"value"	=> ini_get("post_max_size"),
				"class"	=> "ok",
			),

			array(
				"title"	=> "Upload Max Filesize" ,
				"value"	=> ini_get("upload_max_filesize"),
				"class"	=> "ok",
			),

			array(
				"title"	=> "Safe Mode" ,
				"value"	=> $this->PhpSet("safe_mode"),
				"class"	=> $this->PhpSet("safe_mode") == "enabled" ? "error" : "ok",
			),

			array(
				"title"	=> "Json Extension" ,
				"value"	=> function_exists('json_encode') ? "installed" : "missing",
				"class"	=> function_exists('json_encode') ? "ok" : "error",
			),

			array(
				"title"	=> "Curl Extension" ,
				"value"	=> function_exists('curl_version') ? "installed" : "missing",
				"class"	=> function_exists('curl_version') ? "ok" : "error",
			),

			array(
				"title"	=> "GD Extension" ,
				"value"	=> function_exists('gd_info') ? "installed" : "missing",
				"class"	=> function_exists('gd_info') ? "ok" : "error",
			),

			array(
				"title"	=> "MySQL Extension" ,
				"value"	=> function_exists('mysql_connect') ? "installed" : "missing",
				"class"	=> function_exists('mysql_connect') ? "ok" : "error",
			),


			array(
				"title"	=> "MySQLi Extension" ,
				"value"	=> function_exists('mysqli_connect') ? "installed" : "missing",
				"class"	=> function_exists('mysqli_connect') ? "ok" : "error",
			),

			array(
				"title"	=> "File Uploads" ,
				"value"	=> $this->PhpSet("file_uploads"),
				"class"	=> $this->PhpSet("file_uploads") == "enabled" ? "ok" : "error",
			),

			array(
				"title"	=> "./upload/" ,
				"value"	=> is_writable("../upload/") ? "writable" : "not writable",
				"class"	=> is_writable("../upload/") ? "ok" : "error",
			),

		);


		foreach ($checks as $key => $val) {
			if ( ($val["class"] == "error") && !stristr($val["title"] , "mysql")) {
				$error = true;
			}			

			if (stristr($val["title"] , "mysql")) {
				if ($val["class"] == "ok") {
					$mysql = true;
				}				
			}					
		}

		if (!$mysql) {
			$error = true;
		}
		
		

		$content = $this->templates["step3"]->BlockReplace(
			"Main" , 
			array(
				"content"	=> CHTML::Table(
					$this->templates["step3"],
					"" , 
					$checks
				),
				"button"	=> $error ? "" : $this->templates["step3"]->blockreplace(
					"Next",
					array()
				)
			)
		);

		$this->Render(
			$content , 
			3
		);

	}
	

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function PhpSet($var) {

		$data = ini_get($var);

		if ($data) {
			return "enabled";
		} else {
			return "disabled";
		}
		
	}

	
	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepCheckMysql() {

		$content = $this->templates["step4"]->BlockEmptyVars(
			"Main" , 
			$_SESSION["install"]["mysql"]
		);

		$this->Render(
			$content , 
			4
		);

	}

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function JSonCheckMysql() {

		if (!$_GET["server"]) {
			$_GET["server"] = "localhost";
		}
		

		$return = array(
			"server"	=> "",
			"user"		=> "",
			"pass"		=> "",
			"database"	=> "",
		);

		StembaseErrorsHandlerDisable();

		if (function_exists("mysql_connect")) {

			 $conn = mysql_connect(
				 $_GET["server"],
				 $_GET["user"],
				 $_GET["pass"]
			);

			if (!$conn) {

				switch (mysql_errno()) {
					case 2002:
					case 2003:
					case 2004:
					case 2005:
					case 2006:
					case 2007:
						$return["server"] = "error";
					break;

					case 1045:
					case 1044:
						$return["user"] = "error";
						$return["pass"] = "error";
						$return["database"] = "";
					break;

				}
				
			} else {
			}

			if (!mysql_select_db($_GET["database"])) {

				$return["database"] = "error";
			} else {
				$return["database"] = "ok";
			}
			
		} elseif (function_exists("mysqli_connect")){

			 $conn = mysqli_connect(
				 $_GET["server"],
				 $_GET["user"],
				 $_GET["pass"]
			);

			if (!$conn) {

				switch (mysqli_errno()) {
					case 2002:
					case 2003:
					case 2004:
					case 2005:
					case 2006:
					case 2007:
						$return["server"] = "error";
					break;

					case 1045:
					case 1044:
						$return["user"] = "error";
						$return["pass"] = "error";
					break;

				}
				
			} else {
			}

			if (!mysqli_select_db($_GET["database"])) {

				$return["database"] = "error";
			} else {
				$return["database"] = "ok";
			}
		}
		

		if (!in_array($return , "error")) {

			$_SESSION["install"]["mysql"] = array(
				 "server"	=> $_GET["server"],
				 "user"		=> $_GET["user"],
				 "pass"		=> $_GET["pass"],
				 "database"	=> $_GET["database"]
			);
		}
		
		echo json_encode($return);

		die();
	}
	

	
	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepCheckIntegrity() {


		$this->Render(
			$this->templates["step2"]->blockreplace(
				"Main",
				array(
				
				)
			) , 
			2
		);
	}

	function JSonCheckFiles() {

		$files = new CConfig("files.xml");

		$files = $files->vars["files"]["file"];

		$batch = 50;
		$count = count($files);
		$start = $_GET["start"];

		$progress = $start * 100 / $count;


		$cur_files = array_slice(
			$files , 
			$start , 
			$batch
		);

		foreach ($cur_files as $key => $val) {

			if (file_exists("../" . $val["path"])) {
				if (filesize("../" . $val["path"]) != $val["size"]) {
					$errors[] = '<span style="color: red">' . $val["path"] . '</span>'  . " (" . filesize("../" . $val["path"]) . "b instead of {$val[size]}b)";
				} else {
	//				$errors[] = $val["path"];
				}
			} else {
					$errors[] = '<span style="color: red">' . $val["path"] . '</span>'  . " ( missing )";
			}
			
		}

		

		if ($start > $count) {
			echo json_encode(array(
				"progress"	=> min(100 , round($progress)),				
				"errors"	=> $errors,
			));
		} else {
			echo json_encode(array(
				"link"		=> "index.php?step=2&action=check-files&start=" . ($start + $batch ),
				"progress"	=> round($progress),
				"errors"	=> $errors,
			));
		}

		die();
	}



	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepCheckAdmin() {

		$content = $this->templates["step5"]->BlockEmptyVars(
			"Main" , 
			$_SESSION["install"]["admin"]
		);

		$this->Render(
			$content , 
			5
		);

	}

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function JSonCheckAdmin() {
		$_SESSION["install"]["admin"] = $_POST;

		die("1");
	}
	


	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepInstall() {


		$this->Render(
			$this->templates["step6"]->blockreplace(
				"Main",
				array(
				
				)
			) , 
			6
		);
	}


	function JSonInstall() {

		$files = new CConfig("install.xml");

		$files = $files->vars["files"]["file"];

		$batch = 1;
		$count = count($files);
		$start = $_GET["start"];

		$progress = $start * 100 / $count;


		$cur_files = array_slice(
			$files , 
			$start , 
			$batch
		);

		foreach ($cur_files as $key => $val) {

			if (file_exists($val["path"])) {

				$output[] = '<span style="color: ">Executing: ' . $val["path"] . "</span>";

				$path = pathinfo($val["path"]);

				switch ($path["extension"]) {

					//mysql updates
					case "sql":

						$this->RunSQLFile($val["path"]);
					break;

					case "php":
						$return = $this->RunExternal($val["path"]);

						if (is_array($return)) {
							foreach ($return as $key => $val) {
								$output[] = $val;
							}							
						}						
					break;
				}					

			} else {
				$output[] = '<span style="color: red">File not found: ' . $val["path"] . '</span>';
			}
			
		}

		

		if ($start > $count) {
			echo json_encode(array(
				"progress"	=> min(100 , round($progress)),				
				"output"	=> $output,
			));
		} else {
			echo json_encode(array(
				"link"		=> "index.php?step=6&action=install&start=" . ($start + $batch ),
				"progress"	=> round($progress),
				"output"	=> $output,
			));
		}

		die();
	}


	function RunExternal($file) {
		global $base, $site , $_SESS , $_TSM;

//		if ($file["usedb"]) {

		$db = new CDataBase(array(
			"type"		=> "mysql",
			"server"	=> $_SESSION["install"]["mysql"]["server"],
			"login"		=> $_SESSION["install"]["mysql"]["user"],
			"password"	=> $_SESSION["install"]["mysql"]["pass"],
			"default"	=> $_SESSION["install"]["mysql"]["database"],
		));

//		}
		

		$output = null;

		if (file_exists($file)) {
			include_once($file);
		}

		return $output;

	}

	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function RunSQLFile($file) {
		$db = new CDataBase(array(
			"type"		=> "mysql",
			"server"	=> $_SESSION["install"]["mysql"]["server"],
			"login"		=> $_SESSION["install"]["mysql"]["user"],
			"password"	=> $_SESSION["install"]["mysql"]["pass"],
			"default"	=> $_SESSION["install"]["mysql"]["database"],
		));

		$queries = $db->SplitStrQueries(
			Cfile::GetContents($file)
		);

		if (is_Array($queries)) {
			foreach ($queries as $k => $v) {
				$db->Query($v);
			}				
		}
	}
	


	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function StepFinish() {

		$link = "http://" . dirname( $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"] ) ;

		$link = dirname($link) . "/";



		$data = array(
			"link"	=> $link,
			"user"	=> $_SESSION["install"]["admin"]["user"],
			"pass"	=> $_SESSION["install"]["admin"]["pass"],
			"email"	=> $_SESSION["install"]["admin"]["email"],
		);




		$this->Render(
			$this->templates["step7"]->blockreplace(
				"Main",
				$data
			) , 
			7
		);
	}


	/**
	* description
	*
	* @param
	*
	* @return
	*
	* @access
	*/
	function CheckInstallPermission() {

		if (!$_SESSION["install"]) {

			if (file_exists("../upload/conf/database.php")) {
				$this->menu[1]["page_title"] = "Already Installed";

				$this->Render(
					$this->templates["installed"]->blockreplace(
						"Main",
						array(
						
						)
					) , 
					1
				);
			}
			

		}	


	}
	

}

$install = new CInstaller();
return $install->DoEvents();

?>
