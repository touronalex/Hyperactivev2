<?php
/*
	Stempora web framework
	copyright (c) 2002-2014 Stempora
		web:  www.stempora.com
		mail: support@stempora.com
		
*/



global $time , $site;

$time2 = microtime(true);

$stats = STP_SHOW_STATS;


if ($stats) {
	$_TSM["PUB:STATS"] = 
	'<div class="stats" style="text-align: center">' .
	"<pre>Execution Time: " . (($time2 - $time))  . " seconds</pre>" .
	"<pre>Num Queries: " . $site->db->NumQueries() . "</pre>" . '</div>';
} else {
	$_TSM["PUB:STATS"] = "";
}


//"<center>" . convert(memory_get_usage() - $start  ) . "</center>";
//*/

?>