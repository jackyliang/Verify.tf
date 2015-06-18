<?php

/**
 * Tests for the ScrapeUGC.php file
 */

require_once("ScrapeUGC.php");

// URLs to scrape
$ourURL = '/Users/loop/Desktop/BBros.html';
$theirURL = '/Users/loop/Desktop/enemyTeam.html';

$scrape = new ScrapeUGC($ourURL, $theirURL);

// Print info about our team
echo "Our team name: " . $scrape->getOurTeamName();
echo "Our team URL: " . $scrape->getOurTeamURL();
print_r($scrape->getOurTeam());

// Print info about their team
echo "Their team name: " . $scrape->getTheirTeamName();
echo "Their team URL: " . $scrape->getTheirTeamURL();
print_r($scrape->getTheirTeam());