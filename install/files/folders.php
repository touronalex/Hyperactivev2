<?php
/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/


$folders = array(
	"_thumbs",
	"tmp",
	"import",
	"conf",
	"import",
	"pages",
	"queue",
	"default-images",
	"watermarks",
	"_cache",
);

foreach ($folders as $key => $val) {

	if (is_dir("../upload/" . $val)) {
		$output[] = "Already Exists /upload/{$val}/";
	} else {	
		mkdir("../upload/" . $val , 0777);

		$output[] = "Created /upload/{$val}/";
	}
}

?>