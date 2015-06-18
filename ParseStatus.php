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
    const STEAMID3_REGEX = '/U:1:[0-9]+/';

    // Steam Name regex
    const STEAMNAME_REGEX = '/\"(.*?)\"/';

    private $players = array();

    public function ParseStatus($status) {
        $steamIDList = array();
        $steamNameList = array();

        $rows = explode(PHP_EOL, $status);

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
//        print_r($steamIDList);
//        print_r($steamNameList);

        $this->players = array_combine($steamNameList, $steamIDList);
        print_r($this->players);
    }
}