<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {                                        
        $this->middleware('admin-auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['products_list'] = DB::table('products')->get(); 
        //dd($data['products_list']);
        return view('admin.product.product_list', [ 'data'=>$data ] );

    }
}
