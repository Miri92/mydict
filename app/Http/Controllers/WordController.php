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

class WordController extends Controller
{
    public function index(Request $request){
        //sdd($request->all());

        //inserting searches log to DB
//        Search::create([
//            'key' => $request->input('search'),
//        ]);

        $words = Word::latest()
            ->paginate(100);

        return view('words.index', compact('words'));

    }

    public function create(Request $request){


        return view('words.create');

    }
    public function store(Request $request){
        //sdd($request->all());

        //inserting searches log to DB
//        Search::create([
//            'key' => $request->input('search'),
//        ]);

        $words = Word::create([
            'word' => $request->input('word'),
            'grammar_type' => $request->input('grammar_type')
        ]);

        if ($words){
            $data['status'] = true;
            $data['message'] = 'success';
            return redirect()->route('words.index')->with($data);
        } else {
            $data['status'] = false;
            $data['message'] = 'fail';
            return redirect()->route('words.create')->with($data);
        }



    }

    public function grab(Request $request){

        if ($request->filled('search')){
            $grabWord = $request->input('search');
            $azerDictRepostory = (new AzerdictRepostory)->grab($grabWord);
            //dd($azerDictRepostory);
        } else {
            echo "search input not filled";
        }

    }


}