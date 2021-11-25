<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\CategoryPost;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        
         $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(8)->get(); 

    	return view('pages.home')->with('category',$cate_product)->with('all_product',$all_product)->with('category_post',$category_post);
    }

    public function product(){

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get(); 
        
         $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->get(); 

         $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();

    	return view('pages.product.product')->with('category',$cate_product)->with('all_product',$all_product)->with('category_post',$category_post);
    }

    public function search(Request $request){

        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 

        $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();


        return view('pages.product.search')->with('category',$cate_product)->with('search_product',$search_product)->with('keywords',$keywords)->with('category_post',$category_post);

    }
    
}
