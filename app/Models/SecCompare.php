<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecCompare extends Model
{
    use HasFactory;


    public function SI1()
    {
        return $this->belongsTo(SecInfo::class, 'SI1_id');
    }

    public function SI2()
    {
        return $this->belongsTo(SecInfo::class, 'SI2_id');
    }

    public function calc_weight()
    {
        $this->compare_tags();
        $this->compare_sectors();
        $this->compare_industries();
        $this->compare_SicCode();
        $this->compare_country();

        $w = 0;
        $w = $w + $this->matching_tags*10;
        $w = $w + $this->matching_sector*10;
        $w = $w + $this->matching_industry*10;
        $w = $w + $this->matching_primarySicCode*10;

        $this->total_weights = intval(round(($w+1)/2));
    }

    public function calc_stats_score()
    {
        $this->compare_PE();
        $this->compare_marketcap();
        $this->compare_beta();

        $w = 0;
        $w = $w + $this->matching_PE;
        $w = $w + $this->matching_marketcap;
        $w = $w + $this->matching_beta;

        $this->stats_score = intval(round(($w+1)));
    }

    public function compare_stats()
    {
        //ajay include logic here
        // $this->SI1 or $this->SI2 will give you access to the SecInfo models containing stats
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        // continue code here


        $this->compare_factors();


        $this->calc_weight();
        $this->calc_stats_score();

        $this->TG_score = intval(round($this->correlation*100));
        if ($SI1->type != "ETF" && $SI2->type != "ETF") {
            $this->TG_score =  $this->TG_score + $this->total_weights;
            $this->TG_score =  $this->TG_score + $this->stats_score;
        }

        $this->TG_score =  $this->TG_score + intval(round($this->quant_score)) + 1;
        $this->save();

        return $this;
    }

    public function compare_tags()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        $SI1_tags = json_decode($SI1->company_tags);
        $SI2_tags = json_decode($SI2->company_tags);
        $this->matching_tags = match_count($SI1_tags, $SI2_tags);
        $this->save();
        return $this->matching_tags;
    }

    public function compare_sectors()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        $SI1_arr1 = json_decode($SI1->sector);
        $SI2_arr2 = json_decode($SI2->sector);
        $this->matching_sector = match_count($SI1_arr1, $SI2_arr2);
        $this->save();
        return $this->matching_sector;
    }

    public function compare_industries()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        $SI1_arr1 = json_decode($SI1->industry);
        $SI2_arr2 = json_decode($SI2->industry);
        $this->matching_industry = match_count($SI1_arr1, $SI2_arr2);
        $this->save();
        return $this->matching_industry;
    }

    public function compare_SicCode()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        if (!json_decode($SI1->company_data) || !json_decode($SI2->company_data)) {
            return 0;
        }
        $SI1_arr1 = collect(strval(json_decode($SI1->company_data)->primarySicCode));
        $SI2_arr2 = collect(strval(json_decode($SI2->company_data)->primarySicCode));
        $this->matching_primarySicCode = match_count($SI1_arr1, $SI2_arr2);
        $this->save();
        return $this->matching_primarySicCode;
    }

    public function compare_country()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        if (!json_decode($SI1->company_data) || !json_decode($SI2->company_data)) {
            return 0;
        }
        $SI1_arr1 = collect(strval(json_decode($SI1->company_data)->country));
        $SI2_arr2 = collect(strval(json_decode($SI2->company_data)->country));
        $this->matching_country = match_count($SI1_arr1, $SI2_arr2);
        $this->save();
        return $this->matching_country;
    }


    public function compare_PE()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        $SI1_crit = $SI1->peRatio;
        $SI2_crit = $SI2->peRatio;

        $band = 100;
        $runs = 0;

        if (!$SI1_crit || !$SI2_crit) {
            $runs = 0;
        } elseif ($SI1_crit == $SI2_crit) {
            $runs = $band;
        } else {
            while (abs($SI1_crit - $SI2_crit)<$band) {
                $runs++;
                $band = $band/2;
                if ($runs > 1000) {
                    $band = 0;
                }
            }
        }
        $this->matching_PE = $runs;
        $this->save();
        return $this->matching_PE;
    }


    public function compare_marketcap()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        $SI1_crit = $SI1->marketcap/1000;
        $SI2_crit = $SI2->marketcap/1000;

        $band = 10000000;
        $runs = 0;

        if (!$SI1_crit || !$SI2_crit) {
            $runs = 0;
        } elseif ($SI1_crit == $SI2_crit) {
            $runs = $band;
        } else {
            while (abs($SI1_crit - $SI2_crit)<$band) {
                $runs++;
                $band = $band/1.5;
                if ($runs > 1000) {
                    $band = 0;
                }
            }
        }
        $this->matching_marketcap = $runs;
        $this->save();
        return $this->matching_marketcap;
    }

    public function compare_beta()
    {
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        $SI1_crit = $SI1->beta;
        $SI2_crit = $SI2->beta;

        $band = 5;
        $runs = 0;

        if (!$SI1_crit || !$SI2_crit) {
            $runs = 0;
        } elseif ($SI1_crit == $SI2_crit) {
            $runs = $band;
        } else {
            while (abs($SI1_crit - $SI2_crit)<$band) {
                $runs++;
                $band = $band/2;
                if ($runs > 1000) {
                    $band = 0;
                }
            }
        }
        $this->matching_beta = $runs;
        $this->save();
        return $this->matching_beta;
    }

    public function compare_factors()
    {
        $stock1 = $this->SI1;
        $stock2 = $this->SI2;

        $factors = Factor::all();
        $n = 0;
        $d = 0;

        foreach ($factors as $f) {
            $FC1 = $stock1->compareToFactor($f);
            $FC2 = $stock2->compareToFactor($f);
            if ($FC1->correlation && $FC2->correlation) {
                $d = $d + pow($FC1->correlation - $FC2->correlation, 2);
                $n = $n + 1;
            }
            if ($n == 0 || $d == 0) {
                $MSE = 0;
            } else {
                $MSE = 1/($d/$n);
            }

            $this->quant_score = 2*intval(round($MSE));
            $this->save();
        }
    }
}
