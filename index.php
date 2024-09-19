<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
require __DIR__ . '/vendor/autoload.php';


use App\Utils\NewsManager;

echo ("############ [start] NEWS LIST ############\n\n");
$newsManager = new NewsManager;

$newsLists = $newsManager->listNews();


foreach ($newsLists as $news) {
	echo ("############ NEWS " . $news->getTitle() . " ############\n");
	echo ($news->getBody() . "\n");

	foreach($news->comments as $comment) {
		echo ("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
	}
}

echo ("############ [end] NEWS LIST ############\n\n");