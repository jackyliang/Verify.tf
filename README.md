# Verify.tf

## Short Introduction

Verify.tf is a Team Fortress 2 UGC roster verification library written in PHP. All you need
 is your UGC roster URL, the opposing team's roster URL, and your console `status` output,
 for it to tell you who is rostered and who is not. 
 
## Long Introduction

Verify.tf is a Team Fortress 2 UGC roster verification tool hosted on my personal projects site loop.tf. 

This tool targets competitive Team Fortress 2 players, where prior to each match, there are uncertainties as to the players whom you play against are really the individuals they claim they are. The old fashioned way of verifying whether the opposing team's roster is to exhaustively and manually checking each player's name against the team's UGC profile page. This allows room for error and is a waste of time.

This, of course, is not how programmers should do things. 

This simple tools allows anyone to conveniently verify every individual on the server as long as you have both team's UGC profile URL and the Valve server status outputs. 

This library saves 90% of your time prior to the match for 100% roster verification accuracy. *(Warning: these statistics may be complete bullshit)*

## Installation

    git clone https://github.com/jackyliang/Verify.tf.git

## Usage

### Import it

Import `Verify.tf` to your project using:
    
    require_once("Verify.php");
    
### Initialize it 
    
Create a new Verify instance where `$ourURL` is your team's UGC URL, `$theirURL`
is the opposing team's UGC URL, and `$status` is the output you get when you type
in `status` in the console in-game:

    $ourURL = 'http://www.ugcleague.com/team_page.cfm?clan_id=8838';
    $theirURL = 'http://www.ugcleague.com/team_page.cfm?clan_id=8837';
    
    $status = '
    # userid name                uniqueid            connected ping loss state
    #    354 "tjsharky"          [U:1:195209528]     18:31       64    0 active
    #    368 "sike!"             [U:1:128235184]     03:21       76    0 active
    ..
    ..
    #    363 "Muffin Man1"       [U:1:202548789]     12:00      111    0 active
    #    370 "OpTic loop"        [U:1:62145982]      00:39       63    0 active
    ';

    $verify = new Verify($ourURL, $theirURL, $status);
    
### Find out who's unrostered 
    
Get unrostered players within this server (`Steam Name` => `Steam ID 3`):

    $verify->getUnrostered();
    
Get unrostered players in this server (`Steam Name` => `Steam Community Profile`):

    $verify->getUnrosteredProfile(); 
    
Get the number of unrostered players within this server:

    $verify->getUnrosteredSize(); 
    
### Find out more about who's rostered on your team 
    
Get your team's roster name:

    $verify->getOurRosterName();
    
Get your team's roster size within this server:

    $verify->getOurRosterSize();
    
Get your team's UGC URL:
 
    $verify->getOurRosterURL();
    
Get your team's roster in this server (`Steam Name` => `Steam ID 3`):

    $verify->getOurRoster();
     
Get your team's roster in this server (`Steam Name` => `Steam Community Profile`):

    $verify->getOurTeamProfile();
    
### Find out more about who's rostered on the opposing team
    
Get the opposing team's roster name:

    $verify->getTheirRosterName();
    
Get the opposing team's roster size within this server:

    $verify->getTheirRosterSize();
    
Get the team's UGC URL:
 
    $verify->getTheirRosterURL();
    
Get the opposing team's roster within this server (`Steam Name` => `Steam ID 3`):

    $verify->getTheirRoster();
    
Get the opposing team's roster within this server (`Steam Name` => `Steam Community Profile`):

    $verify->getTheirTeamProfile();

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D
6. Contribute [new ideas](https://github.com/jackyliang/Verify.tf/issues/new)
7. Report [bugs](https://github.com/jackyliang/Verify.tf/issues/new)

## Credits

Thank you [Nikki](https://github.com/nikkiii/s) for the Steam ID conversion library
and [HorseMD](https://github.com/HorseMD/) for the Steam ID 3 regex

## License

    The MIT License (MIT)

    Copyright (c) 2015 Jacky Liang

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.

***tl;dr*** *do anything you want with my code as long as you provide attribution 
back to me and don’t hold me liable for explosions.*
