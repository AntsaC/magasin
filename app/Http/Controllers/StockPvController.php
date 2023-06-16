<?php

namespace App\Http\Controllers;

use App\Models\StockPv;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class StockPvController extends Controller
{

    public function index()
    {
        return view("stockPv.index", [
            "stockPvs" => StockPv::by_pv(Auth::user()->sale_point_id)
        ]);
    }

}
