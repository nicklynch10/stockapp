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
        $w = 0;
        $w = $w + $this->matching_tags*10;
        $w = $w + $this->matching_sector*10;
        $w = $w + $this->matching_industry*10;
        $w = $w + $this->matching_primarySicCode*10;
        $w = $w + $this->matching_PE;
        $w = $w + $this->matching_marketcap;
        $w = $w + $this->matching_beta;
        $this->total_weights = $w;
    }

    public function compare_stats()
    {
        //ajay include logic here
        // $this->SI1 or $this->SI2 will give you access to the SecInfo models containing stats
        $SI1 = $this->SI1;
        $SI2 = $this->SI2;
        // continue code here
        $this->compare_tags();
        $this->compare_sectors();
        $this->compare_industries();
        $this->compare_SicCode();
        $this->compare_country();
        $this->compare_PE();
        $this->compare_marketcap();
        $this->compare_beta();


        $this->calc_weight();
        $this->save(); //saves to DB before returning
        //dd($this);

        $this->TG_score = intval(round($this->correlation*100) + $this->total_weights + 1);

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
}
