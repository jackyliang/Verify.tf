<?php
/**
 * Verify uses ParseStatus and ScrapeUGC to determine whether players are in the
 * current server are rostered or not
 * Jacky Liang June 18 2015
 */
require_once("ParseStatus.php");
require_once("ScrapeUGC.php");
require_once("SteamID.php");

class Verify {
    // Steam profile URL
    const STEAM_PROFILE = 'http://steamcommunity.com/profiles/';

    // Each server contains three different types of players - players from
    // our team, players from their team, and unrostered players. These private
    // vars stores these players
    private $ourTeamRoster = array();
    private $theirTeamRoster = array();
    private $unrostered = array();

    // Our team and their team names
    private $ourTeamName;
    private $theirTeamName;

    // Our team and their team URLs
    private $ourTeamURL;
    private $theirTeamURL;

    // Mapping name to Steam URL
    private $ourTeamProfile;
    private $theirTeamProfile;
    private $unrosteredProfile;

    /**
     * Determine the roster status of all players within the current server
     * @param $ourTeamURL   UGC URL of your team
     * @param $theirTeamURL UGC URL of the opposing team
     * @param $statusOutput The server output when you type in `status`
     */
    public function Verify(
        $ourTeamURL,
        $theirTeamURL,
        $statusOutput
    ){
        $scrape = new ScrapeUGC($ourTeamURL, $theirTeamURL);
        $status = new ParseStatus($statusOutput);

        $serverPlayers = $status->getTeam();

        $ourTeamPlayers = $scrape->getOurTeam();
        $theirTeamPlayers = $scrape->getTheirTeam();

        // Store our and their team's names into these class vars
        $this->ourTeamName = $scrape->getOurTeamName();
        $this->theirTeamName = $scrape->getTheirTeamName();

        // Store our and their team's URLs into these class var
        $this->ourTeamURL = $scrape->getOurTeamURL();
        $this->theirTeamURL = $scrape->getTheirTeamURL();

        // Loop through the current server's player list and compare each Steam
        // ID from the status output to the teams. We're basically taking the
        // Steam IDs from the status output and comparing each value to
        // our and their team's roster list. This generates the our team and their
        // team roster list. If there are no matches, it indicates the individual
        // is unrostered.
        foreach($serverPlayers as $name => $steamID) {
            if(in_array($steamID, $ourTeamPlayers)) {
                // Add to our team's roster list + profiles
                $this->ourTeamRoster[$name] = $steamID;
                $this->ourTeamProfile[$name] = SteamID::parse($steamID)->profileURL();
            } else if (in_array($steamID, $theirTeamPlayers)) {
                // Add to their team's roster list + profiles
                $this->theirTeamRoster[$name] = $steamID;
                $this->theirTeamProfile[$name] = SteamID::parse($steamID)->profileURL();
            } else {
                // Add to unrostered + profiles
                $this->unrostered[$name] = $steamID;
                $this->unrosteredProfile[$name] = SteamID::parse($steamID)->profileURL();
            }
        }
    }

    /**
     * Get our roster's name
     * @return string Our roster name
     */
    public function getOurRosterName(){
        return $this->ourTeamName;
    }

    /**
     * Get their roster's name
     * @return string Their roster name
     */
    public function getTheirRosterName(){
        return $this->theirTeamName;
    }

    /**
     * Get the size of our roster within the server
     * @return int The size of our roster within the server
     */
    public function getOurRosterSize(){
        return count($this->ourTeamRoster);
    }

    /**
     * Get the size of their roster within the server
     * @return int The size of their roster within the server
     */
    public function getTheirRosterSize(){
        return count($this->theirTeamRoster);
    }

    /**
     * Get the number of unrostered people within the server
     * @return int The number of unrostered people within the server
     */
    public function getUnrosteredSize(){
        return count($this->getUnrostered());
    }

    /**
     * Get the URL of our roster
     * @return string The UGC URL of our roster
     */
    public function getOurRosterURL() {
        return $this->ourTeamURL;
    }

    /**
     * Get the URL of their roster
     * @return string The UGC URL of their roster
     */
    public function getTheirRosterURL() {
        return $this->theirTeamURL;
    }

    /**
     * Get all of our team's players within the server
     * @return array Our team's players within the server
     */
    public function getOurRoster() {
        return $this->ourTeamRoster;
    }

    /**
     * Get all of their team's players within the server
     * @return array Their team's players within the server
     */
    public function getTheirRoster() {
        return $this->theirTeamRoster;
    }

    /**
     * Get all unrostered players within the server
     * @return array All unrostered players within the server
     */
    public function getUnrostered() {
        return $this->unrostered;
    }

    /**
     * Get all of our team's profile URLs
     * @return mixed
     */
    public function getOurTeamProfile() {
        return $this->ourTeamProfile;
    }

    /**
     * Get all of their team's profile URLs
     * @return mixed
     */
    public function getTheirTeamProfile() {
        return $this->theirTeamProfile;
    }

    /**
     * Get all unrostered player's profile URLs
     * @return mixed
     */
    public function getUnrosteredProfile() {
        return $this->unrosteredProfile;
    }
}