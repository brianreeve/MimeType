<?php

/**
 * Run this in a browser or CLI to get an update mime type map based on the latest apache mime.types conf
 *
 * One usage:
 * 	php generate_mime_types_array.php &> mime_types.json
 *
 */

define('APACHE_MIME_TYPES_URL','http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');

function generateUpToDateMimeArray($url){

	$tab = "\t";
	$newline = "\n";

	if (FALSE) {
		$tab = '&nbsp;&nbsp;&nbsp;';
		$newline = '<br />';
	}

	$s=array();
	foreach(@explode("\n",@file_get_contents($url))as $x)
		if(isset($x[0])&&$x[0]!=='#'&&preg_match_all('#([^\s]+)#',$x,$out)&&isset($out[1])&&($c=count($out[1]))>1)
			for($i=1;$i<$c;$i++)
				$s[]="{$tab}\"{$out[1][$i]}\" : \"{$out[1][0]}\"";
	return @sort($s)?'{'.$newline.implode($s,','.$newline).$newline.'}':false;
}

// Copy the contents to ../lib/mime_types.json;
$contents = generateUpToDateMimeArray(APACHE_MIME_TYPES_URL);
$path = __DIR__.'/../lib/mime_types.json';

file_put_contents($path,$contents);