<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Post;
use App\CategoryPost;
use App\Product;
use App\Producer;
use App\CategoryProduct;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();
        $cate_product = CategoryProduct::orderBy('category_id','DESC')->get();
        $all_producer = Producer::orderBy('producer_id','DESC')->get(); 

    	return view('admin.Product.add_product')->with(compact('cate_product'))->with(compact('all_producer'))->with(compact('category_post'));
    }
    public function all_product(){
        $this->AuthLogin();

        $all_product = Product::with('category_product')->with('producer')->orderBy('product_id','DESC')->paginate(8);
        return view('admin.Product.all_product')->with(compact('all_product',$all_product));

    	
    }
    public function save_product(Request $request){
         $this->AuthLogin();
    	$data = $request->all();
        $product = new Product();
        
    	$product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug']; 
        $product->product_quantity = $data['product_quantity'];
    	$product->product_price = $data['product_price'];
    	$product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_status = $data['product_status'];
        $product->producer_id = $data['producer_id'];
        $product->category_id = $data['category_id'];
        $get_image = $request->file('product_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $product->product_image=$new_image;
            $product->save();
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect()->back();
        }else{
            Session::put('error','Vui lòng thêm hình ảnh');
            return Redirect()->back();
        }
    }
    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Hiển thị sản phẩm');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn sản phẩm');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();

        $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();
        $cate_product = CategoryProduct::orderBy('category_id','DESC')->get();
        $all_producer = Producer::orderBy('producer_id','DESC')->get(); 
        $all_product = Product::find($product_id);

        return view('admin.Product.edit_product')->with(compact('cate_product'))->with(compact('all_producer'))->with(compact('category_post'))->with(compact('all_product'));
    }
    public function update_product(Request $request,$product_id){
         $this->AuthLogin();

        $data = $request->all();
        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug']; 
        $product->product_quantity = $data['product_quantity'];
    	$product->product_price = $data['product_price'];
    	$product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_status = $data['product_status'];
        $product->producer_id = $data['producer_id'];
        $product->category_id = $data['category_id'];
        $product_image = $product->product_image;
        $get_image = $request->file('product_image');    
        
        if($get_image){
            $post_image_old = $product->product_image;
            $path = 'public/uploads/product/'.$product_image;
            unlink($path);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $product->product_image=$new_image;
        }
        $product->save();
         Session::put('message','Cập nhật sản phẩm thành công');
         return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_slug){
        $category_post = CategoryPost::orderBy('category_post_id','DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','ASC')->get(); 

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_product.product_slug',$product_slug)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }
       

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_slug',[$product_slug])->orderby('product_id','desc')->limit(8)->get();


        return view('pages.product.show_details')->with('category',$cate_product)->with('relate',$related_product)->with('product_details',$details_product)->with('category_post',$category_post);

    }
}