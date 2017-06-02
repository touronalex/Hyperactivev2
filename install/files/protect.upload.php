<?php
/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/

$file = "
<IfModule mod_php4.c>
  php_flag engine Off
</IfModule>
<IfModule mod_php5.c>
  php_flag engine Off
</IfModule>
<IfModule mod_php6.c>
  php_flag engine Off
</IfModule>
<IfModule mod_cgi.c>
  Options -ExecCGI
</IfModule>

<Files *.php>
    Order Deny,Allow
    Deny from all
</Files>

RemoveHandler .cgi .pl .py .pyc .pyo .phtml .php .php3 .php4 .php5 .php6 .pcgi .pcgi3 .pcgi4 .pcgi5 .pchi6 .inc
RemoveType .cgi .pl .py .pyc .pyo .phtml .php .php3 .php4 .php5 .php6 .pcgi .pcgi3 .pcgi4 .pcgi5 .pchi6 .inc
SetHandler None
#SetHandler default-handler
#ForceType text/plain";


SaveFileContents("../upload/.htaccess" , $file);

$output[] = "Generating /upload/.htaccess";


?>