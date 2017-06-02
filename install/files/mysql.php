<?php

/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/


$file_name = "../upload/conf/database.php";
$conf_file = "<?php

\$_CONF['database'] = array(
	'type'		=> 'mysql',		
	'server'	=> '{$_SESSION[install][mysql][server]}',		
	'login'		=> '{$_SESSION[install][mysql][user]}',		
	'password'	=> '{$_SESSION[install][mysql][pass]}',		
	'default'	=> '{$_SESSION[install][mysql][database]}',	
);

?>";

//save the file
CFile::SaveContents($file_name , $conf_file);
@chmod($file_name , 0777);

$output[] = "Saved upload/conf/database.php";

/*
CFile::SaveContents("../upload/conf/.htaccess"  ,"Deny from  all");

$output[] = "Generated upload/conf/.htaccess";

*/
?>