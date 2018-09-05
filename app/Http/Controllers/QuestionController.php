<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Request $request){
    	// echo "this is question page";
    	// return response()->json("this is question page");
    	//get ?search=search as request if exists, else empty string ("")
    	$search = $request->query()?$request->query()['search']:"";

    	return DB::table('question')
    		->where('title', 'like', $search.'%')
    		->orWhere('description', 'like', $search.'%')
    		->get();
    }

    public function show($id){
    	// echo "get question with id = ".$id;
    	// return response()->json("get question with id = ".$id);
    	$question = DB::table('question')
    		->where('id', $id)
    		->first();
    	return response()->json($question);
    }

    public function store(Request $request){
    	$doc = $request->all(); //assign data dari react
    	DB::table('question')->insert($doc); //query builder to insert
    }

    public function update(Request $request, $id){
    	$doc = $request->all();
    	DB::table('question')
    		->where('id', $id)
    		->update($doc);
    	return response()->json("success");
    	// return response()->json([
    	// 	"input"=>$request->all(),
    	// 	"result"=>"update question with id = ".$id." and object from PUT data"
    	// ]);
    }

    public function destroy($id){
    	return response()->json("delete question with id = ".$id);
    }
}
