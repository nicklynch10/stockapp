<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\SecInfo;
use App\Models\SecCompare;
use App\Models\StockTicker;
use Illuminate\Support\Facades\Http;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;
use Phpml\Math\Statistic\Correlation;

class Factor extends Model
{
    use HasFactory;


    public function create($index1, $index2)
    {
        $this->ticker1 = $index1;
        $this->ticker2 = $index2;
        $this->refresh();
    }

    public function doNothing()
    {
        //as promised
    }

    public function refresh()
    {

         // get updated data from indices
        $SI1 = getTicker($this->ticker1);
        $SI2 = getTicker($this->ticker2);

        // grabs price change data
        $prices1 = $SI1->getChangeData();
        $prices2 = $SI2->getChangeData();


        $mean1 = $prices1->avg();
        $max1 = $prices1->max();
        $min1 = $prices1->min();
        $std1 = $SI1->std;

        $mean2 = $prices2->avg();
        $max2 = $prices2->max();
        $min2 = $prices2->min();
        $std2 = $SI2->std;


        // consider confirming the dates match here...
        // take the difference between each
        $prices = $prices1->map(function ($price, $key) use ($prices1, $mean1, $max1, $min1, $std1, $prices2, $mean2, $max2, $min2, $std2) {
            //normalizes the data for volitility and value
            $pn1 = ($price - $mean1)/$std1;
            $pn2 = ($prices2[$key] - $mean2)/$std2;
            return $pn1 - $pn2;
        });

        //assigns and saves data
        $this->SI1()->associate($SI1);
        $this->SI2()->associate($SI2);
        $this->change_data1 = json_encode($prices1);
        $this->change_data2 = json_encode($prices2);
        $this->date_data1 = json_encode($SI1->getDateData());
        $this->date_data2 = json_encode($SI2->getDateData());

        $this->operation = "-";
        $this->change_data = json_encode($prices);
        $this->date_data = json_encode($SI1->getDateData());
        $this->amount = $prices1->count();
        $this->range = $SI1->range;
        $this->date_updated = $SI1->date_updated;

        $this->save();
    }


    public function SI1()
    {
        return $this->belongsTo(SecInfo::class, 'SI1_id');
    }

    public function SI2()
    {
        return $this->belongsTo(SecInfo::class, 'SI2_id');
    }

    public function getChangeData()
    {
        return collect(json_decode($this->change_data));
    }

    public function getDateData()
    {
        return collect(json_decode($this->date_data));
    }
}
