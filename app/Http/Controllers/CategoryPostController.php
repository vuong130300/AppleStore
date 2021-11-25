<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\CategoryPost;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_post(){
        $this->AuthLogin();
    	return view('admin.CategoryPost.add_category_post');
    }
    
    public function list_category_post(){
        $this->AuthLogin();

        $category_post = CategoryPost::orderBy('category_post_id','DESC')->paginate(5);
    	
    	return view('admin.CategoryPost.list_category_post')->with(compact('category_post'));


    }
    public function save_category_post(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $category_post = new CategoryPost();
    	$category_post->category_post_name = $data['category_post_name'];
        $category_post->category_post_slug = $data['category_post_slug'];
        $category_post->category_post_status = $data['category_post_status'];
        $category_post->category_post_desc = $data['category_post_desc'];
        $category_post->save();

    	Session::put('message','Thêm danh mục bài viết thành công');
    	return Redirect()->back();
    }
    
    public function edit_category_post($category_post_id){
        $this->AuthLogin();

        $category_post = CategoryPost::find($category_post_id);
        
        return view('admin.CategoryPost.edit_category_post')->with(compact('category_post'));
    }
    public function update_category_post(Request $request,$category_post_id){
        $this->AuthLogin();
        
        $data = $request->all();
        $category_post = CategoryPost::find($category_post_id);
    	$category_post->category_post_name = $data['category_post_name'];
        $category_post->category_post_slug = $data['category_post_slug'];
        $category_post->category_post_status = $data['category_post_status'];
        $category_post->category_post_desc = $data['category_post_desc'];
        $category_post->save();

    	Session::put('message','Cập nhật danh mục bài viết thành công');
    	return Redirect::to('/list-category-post');
    }
    public function delete_category_post($category_post_id){
        $this->AuthLogin();
        $category_post = CategoryPost::find($category_post_id);
        $category_post->delete();
        Session::put('message','Xóa danh mục bài viết thành công');
        return Redirect()->back();
    }

    public function unactive_category_post($category_post_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id',$category_post_id)->update(['category_post_status'=>1]);
        Session::put('message','Hiển thị danh mục ');
        return Redirect::to('list-category-post');

    }
    public function active_category_post($category_post_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_post_id',$category_post_id)->update(['category_post_status'=>0]);
        Session::put('message','Ẩn thị danh mục');
        return Redirect::to('list-category-post');
    }

    //End Function Admin Page
    public function show_category_home($category_product_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.category_product_slug',$category_product_slug)->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_product_slug',$category_product_slug)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
