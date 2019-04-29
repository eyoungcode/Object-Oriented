<?php

require_once(dirname(__DIR__) . "/classes/autoload.php");

use eyoung21\ObjectOriented\Author;


try{
	$authorId = new Author("1f37a3c0-1be4-4d81-8ca1-a35081fc0bac", "http://yahoo.com", "1f37a3c01be44d818ca1a35081fc0bac", "youngblkraven@yahoo.com", '$argon2i$v=19$m=1024,t=384,p=2$T1B6Ymdqa3FJdmZqaDdqYg$hhyC1jf2WjbgfD8Jp6GZE9Tg3IpsYpXKm2VWYOJq8LA', 'erik');
} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
	echo $exception->getMessage() . "trace" . $exception->getTraceAsString();
}
var_dump($authorId);