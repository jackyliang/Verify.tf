<?php

class Verify {
    // Class variables
    private $ourTeamURL;
    private $theirTeamURL;

    private $ourTeamHTML;
    private $theirTeamHTML;

    private $ourTeamPlayers = array();
    private $theirTeamPlayers;

    private $test;

    public function Verify($ourTeamURL, $theirTeamURL) {

        libxml_use_internal_errors(true);

        $this->ourTeamURL = $ourTeamURL;
        $this->theirTeamURL = $theirTeamURL;

        $this->ourTeamHTML = new DomDocument;
        $this->ourTeamHTML->loadHTMLFile($this->ourTeamURL);

//        $this->theirTeamHTML = new DomDocument;
//        $this->theirTeamHTML->loadHTMLFile($this->theirTeamURL);

        $xpath = new DomXPath($this->ourTeamHTML);

        /* Set HTTP response header to plain text for debugging output */
        header("Content-type: text/plain");

        $steamName = $xpath->query('//*[@id="wrapper"]//div[@class="col-md-12"]//h5/b');

        $steamNameList = array();
        $steamIDList = array();

        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */
        foreach ($steamName as $id => $node) {
            $steamName = "";
            $steamID = "";

            if($id % 2 == 0 && $node->nodeValue !== '') {
                $steamName = $node->nodeValue;
            } else if ($id % 2 == 1 && $node->nodeValue !== '') {
                $steamID = $node->nodeValue;
            }

            array_push($steamNameList, $steamName);

            array_push($steamIDList, $steamID);
        }

        // var_dump($steamNameList);
        // var_dump($steamIDList);

        $this->ourTeamPlayers = array_combine(
            $steamNameList,
            $steamIDList
        );

        var_dump($this->ourTeamPlayers);

        // Scrape their team site
        // Store Name -> Steam ID
    }

    public function getTest() {
        return $this->test;
    }

}