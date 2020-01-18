<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
    	 $products = DB::table('products')->get();
    	 // dd($products);
    	// $data = array('name'=>'saiful',
    	// 			  'email'=>'saiful@hotmail.com',
    	// 			  'message'=>'hello');

    	return view('home', compact('products'));
    }
}
