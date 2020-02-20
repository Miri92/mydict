<?php

namespace App\Http\Controllers;


//Models
use App\User;
use App\Models\Search;
use App\Models\Word;
use App\Models\Translation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AzerdictRepostory;

class HomeController extends Controller
{
    public function index(Request $request){
        $searches = Search::all()
            //->orderBy('key', 'desc')
            ->groupBy('key')
            ->sortByDesc(function ($product,$key) {
                //dd($key);
                return $product->count();
            });


        return view('welcome', compact('searches'));
    }

}