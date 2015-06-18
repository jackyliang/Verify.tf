<?php

require_once("ScrapeUGC.php");

$ourURL = '/Users/loop/Desktop/BBros.html';
$theirURL = '/Users/loop/Desktop/enemyTeam.html';

$scrape = new ScrapeUGC($ourURL, $theirURL);

echo "Our team name: " . $scrape->getOurTeamName();
echo "Our team URL: " . $scrape->getOurTeamURL();
var_dump($scrape->getOurTeam());

echo "Their team name: " . $scrape->getTheirTeamName();
echo "Their team URL: " . $scrape->getTheirTeamURL();
var_dump($scrape->getTheirTeam());