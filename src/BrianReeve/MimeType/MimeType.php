<?php

namespace BrianReeve\MimeType;

class MimeType
{
	public static function detect($path)
	{
		$mimeTypesJson = file_get_contents(__DIR__.'/lib/mime_types.json');
		$mimeTypes = json_decode($mimeTypesJson, TRUE);
		$ext = pathinfo($path,PATHINFO_EXTENSION);
		if (isset($mimeTypes[$ext])) {
			$mimeType = $mimeTypes[$ext];
		} else {
			$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
			$mimeType = @finfo_file($finfo, $path);
			finfo_close($finfo);
		}
		if (empty($mimeType)) {
			$mimeType = 'text/plain';
		}
		return $mimeType;
	}
}