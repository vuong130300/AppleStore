<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Post;
use App\CategoryPost;
use App\CategoryProduct;
session_start();

class CategoryProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        $category = CategoryProduct::where('category_parent',0)->orderBy('category_id','DESC')->get();
    	return view('admin.CategoryProduct.add_category_product')->with(compact('category'));
    }
    public function all_category_product(){
        $this->AuthLogin();
        $category_product =  CategoryProduct::where('category_parent',0)->orderBy('category_id','DESC')->get();
        $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();
    	$all_category_product = DB::table('tbl_category_product')->orderBy('category_parent','DESC')->get();
    	$manager_category_product  = view('admin.CategoryProduct.all_category_product')->with('all_category_product',$all_category_product)->with('category_product',$category_product);
        
    	return view('admin_layout')->with('admin.CategoryProduct.all_category_product', $manager_category_product)->with('category_post',$category_post);


    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
        $data['category_product_slug'] = $request->category_product_slug;
        $data['category_parent'] = $request->category_parent;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;

    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Hiển thị danh mục ');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Ẩn thị danh mục');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $category = CategoryProduct::orderBy('category_id','DESC')->get();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();

        $manager_category_product  = view('admin.CategoryProduct.edit_category_product')->with('edit_category_product',$edit_category_product)->with('category',$category);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_product_slug'] = $request->category_product_slug;
        $data['category_parent'] = $request->category_parent;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home($category_product_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','asc')->get(); 
        
        $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.category_product_slug',$category_product_slug)->orderby('product_id','desc')->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_product_slug',$category_product_slug)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('category_post',$category_post);
    }

}
