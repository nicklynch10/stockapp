<?php

use App\Models\SecCompare;
use App\Models\SecInfo;
use App\Models\Factor;

if (!function_exists('getTicker')) {
    function getTicker($ticker)
    {
        //creates an SecInfo from a ticker
        // will not create if exists already
        $SI1 = SecInfo::where("ticker", $ticker)->first();
        if (!$SI1) {
            $SI1 = new SecInfo();
            $SI1->ticker = $ticker;
            $SI1->getIEXData();
            $SI1->save();
        }
//        elseif ($SI1 && !$SI1->info_data)
//        {
//            $SI1 = new SecInfo();
//            $SI1->ticker = $ticker;
//            $SI1->save();
//            $SI1->getIEXData();
//        }
        return $SI1;
    }
}


if (!function_exists('getFactor')) {
    function getFactor($ticker1, $ticker2, $operator)
    {
        //creates an Factor from a ticker
        // will not create if exists already

        $f = Factor::where("ticker1", $ticker1)->where("ticker2", $ticker2)->orderBy('id', 'desc')->first();
        if (!$f) {
            $f = new Factor();
            $f->create($ticker1, $ticker2);
            $f->refresh();
        }
        return $f;
    }
}



// allows you to convert the names of the securities into the real names (IEX scrambles this in the sandbox data)
//Solution link inspiration
//https://stackoverflow.com/questions/6807864/how-to-check-if-two-strings-contain-the-same-letters
//$full is a toggle for if you want the long name vs the short
if (!function_exists('convertType')) {
    function convertType($t, $full=false)
    {
        $types = collect([ // from IEX Website
            "ad" => "ADR",
            "cs" => "Common Stock",
            "cef" => "Closed End Fund",
            "et" => "ETF",
            "oef" => "Open Ended Fund",
            "ps" => "Preferred Stock",
            "rt" => "Right",
            "struct" => "Structured Product",
            "ut" => "Unit",
            "wi" => "When Issued",
            "wt" => "Warrant",
            "empty" => "Other"
        ]);

        //creates an array of the input chars and sorts them in alphabetical order
        // allows for scrambled words
        $arr2 = str_split($t);
        sort($arr2);
        $text2Sorted = implode('', $arr2);
        foreach ($types as $t1 => $b) {
            $arr1 = str_split($t1);
            sort($arr1);
            $text1Sorted = implode('', $arr1);

            if ($text1Sorted == $text2Sorted) {
                if ($full) {
                    return $t1;
                } else {
                    return $b;
                }
            }
        }

        if ($full) {
            return "Other";
        } else {
            return "empty";
        }
    }
}



// Match the tage in Analyze & compare page
if (!function_exists('sorted')) {
    function sorted($s)
    {
        $a = str_split($s);
        sort($a);
        return implode($a);
    }
}


function appLogo($default = false, $user = null)
{
    return url("/images/logo2.png");
}

function appName($default = false, $user = null)
{
    return "TaxGhost";
}

function appFavicon($default = false, $user = null)
{
    return "/images/ghost.png";
}

// background update of check-for-comps portion
//only uses existing data
if (!function_exists('quick_sec_update')) {
    function quick_sec_update($ticker)
    {
        $relation = getTicker($ticker);
        if ($relation->info_data) {
            $relation->addExistingPeers();
            $relation->addRandomPeers(100);
        }
        return $relation;
    }
}


// background update of check-for-comps portion
// runs quick_sec_update
// then does a new IEX pull (which takes longer)
if (!function_exists('long_sec_update')) {
    function long_sec_update($ticker)
    {
        $relation = getTicker($ticker);
        if ($relation->info_data) {
            if (!$relation->IEXpeer_data) {
                $relation->pullIEXPeers();
            } else {
                $relation->addRelatedPeers();
            }
        }

        if ($relation->info_data) {
            $relation->addExistingPeers();
            $relation->addRandomPeers(100);
        }

        return $relation;
    }
}

if (!function_exists('dollar_format')) {
    function acct_format($value)
    {
        if (!isset($value) || $value == 0) {
            return "N/A";
        }
        return $value < 0 ? "(".number_format(abs($value), 2).")" : number_format($value, 2);
    }
}


if (!function_exists('pct_format')) {
    function pct_format($value)
    {
        if (!isset($value) || $value == 0) {
            return "N/A";
        }
        return $value*100<0 ? "(".number_format(abs($value*100), 2)."%)" : number_format($value*100, 2)."%";
    }
}

if (!function_exists('dollar_format')) {
    function dollar_format($value)
    {
        if (!isset($value) || $value == 0) {
            return "N/A";
        }
        return '$'.number_format(($value), 2, '.', ',');
    }
}

if (!function_exists('getRelated_stock_etf')) {
    function getRelated_stock_etf($ticker)
    {
        $sto = [];
        $et = [];

        $data = SecInfo::where('ticker', $ticker)->latest()->first();
//        if (!isset($data) ||
//            (isset($data) && isset($data->peer_data)
//                && collect(json_decode($data->peer_data))->isEmpty())
//        ) {
//            $data = quick_sec_update($ticker);
//        }

        if (isset($data) && $data->peer_data != null) {
            foreach (json_decode($data->peer_data) as $p) {
                if (count($et) > 3 && count($sto) > 3) {
                    break;
                }
                $SC = SecCompare::where(['ticker1' => $ticker , 'ticker2' => $p])->latest()->first();

                if (isset($SC)) {
                    if ($SC->correlation > 0 && $ticker != $p) {
                        if (getTicker($p)->type != "ETF") {
                            if (count($sto)<4) {
                                array_push($sto, $SC->ticker2);
                            }
                        } elseif (getTicker($p)->type == "ETF") {
                            if (count($et)<4) {
                                array_push($et, $SC->ticker2);
                            }
                        }
                    }
                }
            }
        }
        $compare['stock'] = count($sto) > 0 ? $sto : [];
        $compare['etf'] = count($et) > 0 ? $et : [];

        return $compare;
    }
}

// checks if two strings are equal
// even if scrambled
if (!function_exists('str_match')) {
    function str_match($t1, $t2)
    {
        //creates two arrays of the input chars and sorts them in alphabetical order
        // allows for scrambled words
        $arr2 = str_split($t1);
        sort($arr2);
        $text2Sorted = implode('', $arr2);

        $arr1 = str_split($t2);
        sort($arr1);
        $text1Sorted = implode('', $arr1);

        if ($text1Sorted == $text2Sorted) {
            return true;
        }
        return false;
    }
}

// checks if two strings are equal
// even if scrambled
if (!function_exists('match_count')) {
    function match_count($a1, $a2)
    {
        $matches = 0;
        //returns matches
        if (!$a1 || !$a2) {
            return 0;
        }
        foreach ($a1 as $t1) {
            foreach ($a2 as $t2) {
                if (str_match($t1, $t2)) {
                    $matches++;
                }
            }
        }
        return $matches;
    }
}







$GLOBALS['ttime'] = microtime(true); // Gets microseconds
//echo "<br> 3x Time Elapsed: ".(microtime(true) - $GLOBALS['ttime'])."s";
