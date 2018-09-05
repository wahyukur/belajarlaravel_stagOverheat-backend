<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function index(Request $request, $questionId){
    	return DB::table('answer')
    		->where('questionId', $questionId)
    		->get();
    }

    public function store(Request $request, $questionId){
    	$doc = $request->all(); //assign data dari react
        $doc['questionId'] = (int)$questionId; // cast string param to integer
    	DB::table('answer')->insert($doc); //query builder to insert
        return response()->json("success");
    }
}
