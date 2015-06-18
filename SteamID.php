<?php

/**
 * A simple class to allow basic steamid conversion and manipulation
 * It works OKAY. I guess.
 *
 * Source - https://github.com/nikkiii/steamconverter
 *
 */

define('STEAMID64_ADDITIVE', '76561197960265728');
define('STEAM_PROFILE','http://steamcommunity.com/profiles/');

class SteamID {

	public $accountId;

	public function __construct($accountId) {
		$this->accountId = $accountId;
	}

	public function accountId() {
		return $this->accountId;
	}

	public function steamId2() {
		if (substr($this->accountId, -1) % 2 == 0)
			$server = 0;
		else
			$server = 1;

		$auth = bcdiv($this->accountId, 2, 0);

		return 'STEAM_0:' . $server . ':' . $auth;
	}

	public function steamId3() {
		return '[U:1:' . $this->accountId . ']';
	}

	public function communityId() {
		return bcadd($this->accountId, STEAMID64_ADDITIVE, 0);
	}

    /**
     * Returns a Steam URL given a valid community ID
     * @return string A Community Profile URL
     */
    public function profileURL() {
        return STEAM_PROFILE . bcadd($this->accountId, STEAMID64_ADDITIVE, 0);
    }

	public static function parse($inputRaw) {
        // NOTE: Nasty workaround of lack of square braces around Steam ID 3
        // returning invalid Steam profile URLs. Added June 18 2015 by Jacky.
        $input = '[' . $inputRaw . ']';

		if (preg_match('/(\d):(\d+)$/', $input, $match)) { // Matches both HLX (#:####) and Steam2 (STEAM_#:#:####) format
			return new SteamID(($match[2] * 2) + $match[1]);
		} else if (preg_match('/^\[?U:1:(\d+)\]?$/', $input, $match)) { // Matches Steam3 format
			return new SteamID($match[1]);
		} else if (preg_match('/^(7656\d+)$/', $input)) { // Matches community id
			$auth = bcsub($input, STEAMID64_ADDITIVE, 0);

			if (bccomp($auth, '0') != 1) {
				return;
			}

			return new SteamID($auth);
		} else if (is_numeric($input)) { // Matches account id.
			return new SteamID($input);
		}
	}
}