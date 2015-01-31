<?php

require_once __DIR__.'/../vendor/autoload.php';

use BrianReeve\MimeType\MimeType;

$tests = array(
	'test.jpg',
	'test.jpeg',
	'test.mp4',
	'test.mp3',
	'test',
	'test.unknown'
);

foreach ($tests as $path) {
	echo "{$path}:\t".MimeType::detect($path)."\n";
}