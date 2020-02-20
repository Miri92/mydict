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

class SearchController extends Controller
{
    public function index(Request $request){
        //sdd($request->all());

        //inserting searches log to DB
        Search::create([
            'key' => $request->input('search'),
        ]);

        if (!$request->filled('search')) {
            echo "search input not filled";
        }

        $search = $request->input('search');
        $azerDictRepostory = (new AzerdictRepostory)->grab($search);
        //dd($azerDictRepostory);


        $findWord = Word::where('word','like',"%{$search}%")
            ->with('Translations')
            ->orderBy('id', 'asc')
            ->get();
        //dd($findWord);

        $azerDictUrl = 'https://azerdict.com/english/'.$search;

        return view('welcome', compact('findWord','azerDictUrl'));
    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}