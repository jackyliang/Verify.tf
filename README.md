# Verify.tf

Verify.tf is a Team Fortress 2 UGC roster verification library. 

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
    #    341 "anitrez"           [U:1:5983787]       33:00       60    0 active
    #    356 "Jiggaboo Jones"    [U:1:156404176]     18:02       82    0 active
    #    361 "Peyches00"         [U:1:42837235]      15:33       93    0 active
    #    366 "[TF2]-Th3M4sT3r360" [U:1:175129186]    06:10      176    0 active
    #    363 "Muffin Man1"       [U:1:202548789]     12:00      111    0 active
    #    370 "OpTic loop"        [U:1:62145982]      00:39       63    0 active
    #    335 "Rizmith"           [U:1:153661365]     42:10       65    0 active
    #    296 "2_spoopy_4_me"     [U:1:108447666]      1:28:56    88    0 active
    #    349 "-=P-P-S=- LilHope360" [U:1:199552488]  25:12       69    0 active
    #    350 "Goblos"            [U:1:143317093]     23:40       73    0 active
    #    343 "ZERO_"             [U:1:142297069]     31:15       82    0 active
    #    320 "epicdragon2104 #SOLDIERBIRD" [U:1:114272379]  1:03:51  103    0 active
    #    345 "Desher™"         [U:1:101105524]     31:01      146    0 active
    #    362 "-[FF]- cοѕмιc cοʏοтᴇ" [U:1:87352978] 13:00  149    0 active
    #    365 "Nausicaä #BanDan2k15" [U:1:113915225] 07:34       79    0 active
    #    369 "∆ndres"          [U:1:195772238]     01:59       61    0 active
    #    346 "Edward"            [U:1:86177479]      30:49       76    0 active
    #    359 "Porky Minch"       [U:1:95659268]      17:39       81    0 active
    #    333 "GoldenGod33"       [U:1:156211027]     44:22       80    0 active
    #    294 "wille.israelsson"  [U:1:190667886]      1:30:23   192    0 active
    #    367 "dan"               [U:1:80292746]      05:51       78    0 active
    ';

    $verify = new Verify($ourURL, $theirURL, $status);
    
### Get some information about your team 
    
Get your team's roster name:

    $verify->getOurRosterName();
    
Get your team's roster size within this server:

    $verify->getOurRosterSize();
    
Get your team's UGC URL:
 
    $verify->getOurRosterURL();
    
Get your team's roster in this server (Steam Name => Steam ID 3):

    $verify->getOurRoster();
     
Get your team's roster in this server (Steam Name => Steam Community Profile):

    $verify->getOurTeamProfile();
    
### Get some information about the opposing team 
    
Get the opposing team's roster name:

    $verify->getTheirRosterName();
    
Get the opposing team's roster size within this server:

    $verify->getTheirRosterSize();
    
Get the team's UGC URL:
 
    $verify->getTheirRosterURL();
    
Get the opposing team's roster within this server (Steam Name => Steam ID 3):

    $verify->getTheirRoster();
    
Get the opposing team's roster within this server (Steam Name => Steam Community Profile):

    $verify->getTheirTeamProfile();
    
### Get some information about the unrostered players  
    
Get unrostered players within this server (Steam Name => Steam ID 3):

    $verify->getUnrostered();
    
Get unrostered players in this server (Steam Name => Steam Community Profile):

    $verify->getUnrosteredProfile(); 
    
Get the number of unrostered players within this server:

    $verify->getUnrosteredSize(); 
    

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

*tl;dr do anything you want with my code as long as you provide attribution 
back to me and don’t hold me liable for explosions.*
