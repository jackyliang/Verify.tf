<?php

require_once("Verify.php");

$ourURL = '/Users/loop/Desktop/BBros.html';
$theirURL = '/Users/loop/Desktop/enemyTeam.html';

$verify = new Verify($ourURL, $theirURL);
// echo $verify->getTest();