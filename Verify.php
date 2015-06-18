<?php
/**
 * Verify uses ParseStatus and ScrapeUGC to determine whether players are in the
 * current server are rostered or not
 * Jacky Liang June 18 2015
 */
require_once("ParseStatus.php");
require_once("ScrapeUGC.php");

class Verify {
    private $ourTeamRoster = array();
    private $theirTeamRoster = array();
    private $unrostered = array();

    public function Verify(
        $ourTeamURL,
        $theirTeamURL,
        $status
    ){
        $scrape = new ScrapeUGC($ourTeamURL, $theirTeamURL);
        $status = new ParseStatus($status);

    }

    public function getOurRoster() {

    }

    public function getTheirRoster() {

    }

    public function getUnrostered() {

    }

}