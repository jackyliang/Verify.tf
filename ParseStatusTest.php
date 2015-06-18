<?php

require_once("ParseStatus.php");

/**
 * Tests for the ParseStatus.php file
 */

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

$status_1 = '354 "tjsharky"          [U:1:195209528]     18:31       64';

$parser = new ParseStatus($status);