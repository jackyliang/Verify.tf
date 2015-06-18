<?php

/**
 * Scrapes two UGC team pages (denoted as "our team" and "their team") and returns
 * the name of the team and structured lists of the verified roster of "player
 * name" and "Steam ID"
 * Jacky Liang July 18 2015
 */

class ScrapeUGC {
    // XPath to get the team abbreviation and name
    const TEAM_ABB_XPATH = '//*[@id="wrapper"]/section/div/div[1]/div[1]/div/div/h1/text()';
    const TEAM_NAME_XPATH = '//*[@id="wrapper"]/section/div/div[1]/div[1]/div/div/h1/b';

    // XPath to get the Steam Name and ID
    const NAME_AND_ID_XPATH = '//*[@id="wrapper"]//div[@class="col-md-12"]//h5/b';

    // Two URLs - our and their teams
    private $ourTeamURL;
    private $theirTeamURL;

    // Two HTML objects - our and their team's
    private $ourTeamHTML;
    private $theirTeamHTML;

    // Two associative arrays - our and their team's
    private $ourTeamPlayers = array();
    private $theirTeamPlayers = array();

    // Two team names - our and their team's
    private $ourTeamName;
    private $theirTeamName;

    public function ScrapeUGC($ourTeamURL, $theirTeamURL) {

        // Silence the DOM errors
        libxml_use_internal_errors(true);

        // Store the two URLs - ours and theirs
        $this->ourTeamURL = $ourTeamURL;
        $this->theirTeamURL = $theirTeamURL;


        // Set HTTP response header to plain text for debugging output
        header("Content-type: text/plain");

        // Generate our team's HTML file
        $this->ourTeamHTML = new DomDocument;
        $this->ourTeamHTML->loadHTMLFile($this->ourTeamURL);

        // Generate their team's HTML file
        $this->theirTeamHTML = new DomDocument;
        $this->theirTeamHTML->loadHTMLFile($this->theirTeamURL);

        $this->ourTeamPlayers = $this->scrapeUGCTeam($this->ourTeamHTML);
        $this->theirTeamPlayers = $this->scrapeUGCTeam($this->theirTeamHTML);

        $this->ourTeamName = $this->scrapeUGCTeamName($this->ourTeamHTML);
        $this->theirTeamName = $this->scrapeUGCTeamName($this->theirTeamHTML);
    }

    /**
     * Gets our team's URL
     * @return string Our Team's URL
     */
    public function getOurTeamURL(){
        return $this->ourTeamURL;
    }

    /**
     * Get their team's URL
     * @return string Their Team's URL
     */
    public function getTheirTeamURL(){
        return $this->theirTeamURL;
    }

    /**
     * When supplied a valid UGC team URL, return the team name
     * @param $url     UGC Team URL
     * @return string  Team name in the form of 'Team Abbreviation' - 'Team Name'
     */
    public function scrapeUGCTeamName($url){
        $xpath = new DomXPath($url);

        $teamAbbNode = $xpath->query(ScrapeUGC::TEAM_ABB_XPATH);
        $teamNameNode = $xpath->query(ScrapeUGC::TEAM_NAME_XPATH);

        $teamAbb = '';
        $teamName = '';

        // Save the team's abbreviation
        foreach($teamAbbNode as $node) {
            $teamAbb = trim($node->nodeValue);
            break;
        }

        // Save the team's name
        foreach($teamNameNode as $node) {
            $teamName = trim($node->nodeValue);
            break;
        }

        return $teamAbb . ' - ' . $teamName;
    }

    /**
     * When supplied a valid UGC team URL, return an associative array
     * of the UGC team of Steam Name and Steam ID
     * @param $url    UGC Team URL
     * @return array  Associative array of Steam Name -> Steam ID
     */
    public function scrapeUGCTeam($url){

        $xpath = new DomXPath($url);

        // XPath to get the Steam names and Steam IDs


        // Get the Steam names and Steam IDs using the XPath
        $steamNameAndIDs = $xpath->query(ScrapeUGC::NAME_AND_ID_XPATH);

        // Temporary lists to store the Steam Names and Steam IDs
        $steamNameList = array();
        $steamIDList = array();

        foreach ($steamNameAndIDs as $id => $node) {
            $steamName = "";
            $steamID = "";

            // Store Steam name first (which is the even-numbered item)
            // in the scraped list. Then store the Steam ID (which is
            // the odd-numbered item).
            if($id % 2 == 0) {
                $steamName = $node->nodeValue;
            } else if ($id % 2 == 1) {
                $steamID = $node->nodeValue;
            }

            if(!empty($steamName)) {
                // Add each Steam name onto our team's list
                array_push($steamNameList, $steamName);
            } else if(!empty($steamID)){
                // Add each Steam ID onto our team's list
                array_push($steamIDList, $steamID);
            }
        }

        // Combine Steam ID and Steam Name to team's associative
        // list
        $team = array_combine(
            $steamNameList,
            $steamIDList
        );

        return $team;
    }

    /**
     * Returns an associative array of our team
     * where the key is the Steam name and the
     * value is the Steam ID
     * @return array Associative array of our team
     */
    public function getOurTeam(){
        return $this->ourTeamPlayers;
    }

    /**
     * Returns an associative array of their team
     * where the key is the Steam name and the
     * value is the Steam ID
     * @return array
     */
    public function getTheirTeam(){
        return $this->theirTeamPlayers;
    }

    /**
     * Get our team name
     * @return string Our team name
     */
    public function getOurTeamName(){
        return $this->ourTeamName;
    }

    /**
     * Get their team name
     * @return string Their team name
     */
    public function getTheirTeamName(){
        return $this->theirTeamName;
    }
}