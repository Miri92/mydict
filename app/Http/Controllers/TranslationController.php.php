<?php

namespace App\Http\Controllers;


//Models
use App\User;
use App\Models\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request){
        //sdd($request->all());

        //inserting searches log to DB
        Search::create([
            'key' => $request->input('search'),
        ]);
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