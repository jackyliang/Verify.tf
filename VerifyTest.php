<?php

require_once("Verify.php");

$ourURL = '/Users/loop/Desktop/BBros.html';
$theirURL = '/Users/loop/Desktop/enemyTeam.html';

$verify = new Verify($ourURL, $theirURL);

echo "Our team name: " . $verify->getOurTeamName();
var_dump($verify->getOurTeam());

echo "Their team name: " . $verify->getTheirTeamName();
var_dump($verify->getTheirTeam());