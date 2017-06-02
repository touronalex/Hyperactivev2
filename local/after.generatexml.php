<?php
/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/


if ($_GET["action"] == "generatefiles") {

	$files = CDir::GetFilesRec("./");

	if (is_array($files)) {


		foreach ($files as $key => $val) {

			if (!stristr($val , "@") && !stristr($val , "upload/") && !stristr($val , "install/")) {
				$xml.= "\t<file path=\"" . str_replace(".//" , "" , $val) . "\" size=\"" . filesize($val) . "\" />\n";
			}
			
		}
		
		saveFileContents(
			"install/files.xml",
			"<files>\n" . $xml . "</files>"
		);
	}
	
}



?>