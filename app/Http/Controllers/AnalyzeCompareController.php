<?php

namespace App\Http\Controllers;

use App\Models\SecInfo;
use Illuminate\Http\Request;

class AnalyzeCompareController extends Controller
{
    public function factors()
    {
        return view('correlations.analyze-compare');
    }
}
