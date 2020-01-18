<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ProductRating;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo 'this is ProductController';
        // $products = DB::table('products')->get();
        // dd($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo $id;
        $products = DB::table('products')->get();
        $data = DB::table('products')->where('product_row_id', $id)->first();
        $product_ratings = ProductRating:: where('product_id', $id)->get();
        //dd($data);
        return view('product_detail', compact('data','product_ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submitRating(Request $request){
        $rating_data = $request->all();
        //echo '<pre>'.print_r($rating_data, true).'</pre>'; exit;
        $productRating_model = new ProductRating();
        $pid = $request->product_id;
        $productRating_model->user_id = 0;
        $productRating_model->product_id = $request->product_id;
        $productRating_model->name = $request->author;
        $productRating_model->email = $request->email;  
        $productRating_model->rating = $request->rating;
        $productRating_model->reviews = $request->comment;
        
        if($productRating_model->save() == true){
            $insertedId = $productRating_model->id;
            return view('show_review_ajax', ['product_ratings'=> $rating_data, 'insertedId'=>$insertedId]);
        }
    }
}


