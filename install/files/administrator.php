<?php
/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/



//check if admin already exists

//$admin = $db->QFetchArray("SELECT * FROM site_users WHERE user_login LIKE '{$_SESSION['install']['admin']['user']}'");

if (is_array($admin)) {

	$db->QueryUpdate(
		"site_users" , 
		array(
			"user_password"			=> md5($_SESSION["install"]["admin"]["pass"]),			
			"user_email"			=> $_SESSION["install"]["admin"]["email"],			
			"user_level"			=> "0",
			"user_protect_delete"	=> "1"
		),
		"user_id={$admin[user_id]}"
	);

	$output[] = "Updated administrator `" . $_SESSION["install"]["admin"]["user"] . "` password.";

} else {

	//insert new record
	$id = $db->QueryInsert(
		"site_users" , 
		array(
			"user_first_name"		=> "Administrator",
			"user_login"			=> $_SESSION["install"]["admin"]["user"],			
			"user_password"			=> md5($_SESSION["install"]["admin"]["pass"]),			
			"user_email"			=> $_SESSION["install"]["admin"]["email"],			
			"user_level"			=> "0",
			"user_protect_delete"	=> "1",
			"user_log_create"		=> time(),
		)
	);

	$output[] = "Added administrator `" . $_SESSION["install"]["admin"]["user"] . "`.";

	//autologin user in admin 
	$user = $db->QFetchArray("SELECT * FROM site_users WHERE user_id={$id}");
			
	$_SESSION["store"]["minibase"]["user"] = 1;
	$_SESSION["store"]["minibase"]["raw"] = $user;

}



?>