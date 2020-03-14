<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


use App\Models\Category;
use App\Models\Common;
use Illuminate\Support\Facades\Input;

use Session;
use DB;
use Validator;

use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin-auth');
    }
	public function index()
  {                             
    $common_model = new Common();  
    $data['all_records'] = $common_model->allCategories();
    //dd($data['all_records']);    
    return view('admin.category.category_list', ['data'=>$data]);
  }
	
	function create()
	{
     $common_model = new Common();       
	   $data['all_records'] = $common_model->allCategories();
     //$data['all_records'] = Category::all();
	   return view('admin.category.create', ['data'=>$data]);
	}

  public function store(Request $request){
      $validator = Validator::make($request->all(), [
          'category_name' => 'required',
          'parent_id' => 'required',
      ]);

      if ($validator->fails()) {
          return redirect('/admin/category/create')->withErrors($validator)->withInput();
      }
      $category_model = new Category();
      $category_model->category_name = $request->category_name;  
      $category_model->parent_id = $request->parent_id;
      $category_model->category_short_description = $request->category_short_description;

      //get level,  level = parent level + 1.
      $category_model->level = 0;
      if($category_model->parent_id) {
        $parent_cat_info =   DB::table('categories')->where('category_row_id', $category_model->parent_id)->first(); 
        $category_model->level = $parent_cat_info->level + 1;
      }
              
      $category_model->save();

      if($category_model->parent_id) {
         if($parent_cat_info->has_child != 1) { 
             DB::table('categories')
              ->where('category_row_id', $request->parent_id)
              ->update([
                'has_child'=> 1
              ]);
         }
      } 
    
    Session::flash('message', 'Category Created Successfully!');
    Session::flash('alert-class', 'alert-success');

    $maildata = [
      'category_name' => $request->category_name,
      'message' => 'Category created successfully!',
    ]; 

    Mail::to('newuser@example.com')->send(new MailtrapExample($maildata));

    return Redirect::to('/admin/categories');

  }


	public function edit($id)
    {
        $common_model = new Common();       
        $data['all_records'] = $common_model->allCategories();     
        $data['single_info'] = DB::table('categories')->where('category_row_id', $id)->first();
        //dd($data['single_info']);
        return view('admin.category.edit', ['data'=>$data]);
	
	}
	public function update(Request $request)
    {
         // validation
        $this->validate($request, [
            'category_name' => 'required',
            'parent_id' => 'required',
        ]);
       
       
        $category_model = new Category();

        
        // check whether is it for edit
        if( !$request->category_row_id) {          
            return false;           
        }
      
        // receive all post values. 
        $category_model = $category_model->find($request->category_row_id); // edit operation.
        $category_model->category_name = $request->category_name;  
        $category_model->parent_id = $request->parent_id;
        $category_model->category_short_description = $request->category_short_description; 
        
        // parent changed ? 
        $parent_id_changed = 0;
        $prev_parent_id = DB::table('categories')->where('category_row_id', $request->category_row_id)->first()->parent_id;
        if($request->parent_id != $prev_parent_id) {
        $parent_id_changed = 1;
        }
        
       
        // get level,  level = parent level + 1.
        $category_model->level = 0;
        if($category_model->parent_id)
        {
          $parent_cat_info =   DB::table('categories')->where('category_row_id',$category_model->parent_id)->first(); 
          $category_model->level = $parent_cat_info->level + 1;
        }                
                
                
        $category_model->save();
        
         
        // update has_child status of present parent         
        if($category_model->parent_id)
        {
           if($parent_cat_info->has_child != 1)
           { 
               DB::table('categories')
                ->where('category_row_id', $request->parent_id)
                ->update([
                  'has_child'=> 1
                ]);
           }
        } 
        
        // update  has_child status of previous parent 
        if($parent_id_changed)
        {            
           
           if( !DB::table('categories')->where('parent_id', $prev_parent_id)->count())
           {
           
           DB::table('categories')
                ->where('category_row_id', $prev_parent_id)
                ->update([
                  'has_child'=> 0
                ]);
           }      
        } 
      
      Session::flash('success-message', 'Successfully Performed !');        
      return Redirect::to('/admin/categories');
	
	}
    
    public function deleteRecord($id)
    {
       if( !$id ) { 
        return false;
       }
       
       // main category Cannnot be deleted if it has child
       $has_child = DB::table('categories')->where('category_row_id', $id)->where('has_child', 1)->first();
       if($has_child) {           
        return false;
       }                             
       
       $parent_id = DB::table('categories')->where('category_row_id', $id)->first()->parent_id;                                                
       DB::table('categories')->where('category_row_id', $id)->delete(); 
       
       // has child of status of parent id.
        
       if($parent_id) {
        if( !DB::table('categories')->where('parent_id', $parent_id)->count()) {
           DB::table('categories')
                ->where('category_row_id', $parent_id)
                ->update([
                  'has_child'=> 0
                ]);
           }      
       }  
       
       
       Session::flash('success-message', 'Successfully Performed !');        
       return Redirect::to('/admin/categories');
    }
    
    
}
