<?php

namespace App\Http\Controllers;

use App\Models\SecInfo;
use Illuminate\Http\Request;

class FactordetailController extends Controller
{
    public function view(Request $request)
    {
        $data['ticker'] = $request['searchTicker'];
        return view('correlations.factors-detail', $data);
    }
    public function factors()
    {
        return view('correlations.analyze-compare');
    }


    public function view2(Request $request)
    {
        $data['ticker'] = $request['searchTicker'];
        return view('correlations.analyze2', $data);
    }
}
