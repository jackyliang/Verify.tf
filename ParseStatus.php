<?php

/**
 * Parses the Valve server `status` console output to a structure "Steam Name"
 * and "Steam ID" list
 * Jacky Liang June 18 2015
 *
 * References
 */
class ParseStatus {

    // Steam ID 3 regex.
    // Source: https://github.com/HorseMD/steamid-converter/blob/master/js/converter.js
    // Matches all Steam ID 3s of any given input string
    const STEAMID3_REGEX = '/U:1:[0-9]+/';

    // Steam Name regex
    // Matches all names within quotes of an input string i.e.
    // foo bar "loop" U:1:1234QWRT
    const STEAMNAME_REGEX = '/\"(.*?)\"/';

    // Associative list of Steam Name => Steam ID
    private $players = array();

    /**
     * Parses Valve server `status` console output and stores the data into a
     * manageable associative list
     * @param $status Valve server `status` console output
     */
    public function ParseStatus($status) {
        $steamIDList = array();
        $steamNameList = array();

        // Explode the multi-line status input string into a string array
        $rows = explode(PHP_EOL, $status);

        // Parse each Steam Name and Steam ID from the status output
        foreach($rows as $row) {
            // Match Steam name
            if(preg_match(ParseStatus::STEAMNAME_REGEX, $row, $steamName)) {
                array_push($steamNameList, $steamName[1]);
            }

            // Match Steam ID 3
            if(preg_match(ParseStatus::STEAMID3_REGEX, $row, $steamID)) {
                array_push($steamIDList, $steamID[0]);
            }
        }

        $this->players = array_combine($steamNameList, $steamIDList);
    }

    /**
     * Returns an associative array of a team
     * where the key is the Steam name and the
     * value is the Steam ID
     * @return array Associative array of Steam Name => Steam ID
     */
    public function getTeam(){
        return $this->players;
    }
}