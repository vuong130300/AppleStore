<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Producer;
session_start();

class ProducerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_producer(){
        $this->AuthLogin();
    	return view('admin.Producer.add_producer');
    }
    
    public function list_producer(){
        $this->AuthLogin();

        $all_producer = Producer::orderBy('producer_id','DESC')->paginate(5);
    	
    	return view('admin.Producer.list_producer')->with(compact('all_producer'));


    }
    
    public function save_producer(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $producer = new Producer();
    	$producer->producer_name = $data['producer_name'];
        $producer->producer_status = $data['producer_status'];
        $producer->save();

    	Session::put('message','Thêm nhà cung cấp thành công');
    	return Redirect()->back();
    }
    
    public function edit_producer($producer_id){
        $this->AuthLogin();

        $all_producer = Producer::find($producer_id);
        
        return view('admin.Producer.edit_producer')->with(compact('all_producer'));
    }

    public function update_producer(Request $request,$producer_id){
        $this->AuthLogin();
        
        $data = $request->all();
        $producer = producer::find($producer_id);
    	$producer->producer_name = $data['producer_name'];
        $producer->producer_status = $data['producer_status'];
        $producer->save();

    	Session::put('message','Cập nhật nhà cung cấp thành công');
    	return Redirect::to('/list-producer');
    }

    public function delete_producer($producer_id){
        $this->AuthLogin();
        $producer = Producer::find($producer_id);
        $producer->delete();
        Session::put('message','Xóa nhà cung cấp thành công');
        return Redirect()->back();
    }

    public function unactive_producer($producer_id){
        $this->AuthLogin();
        DB::table('tbl_producer')->where('producer_id',$producer_id)->update(['producer_status'=>1]);
        Session::put('message','Hiển thị nhà cung cấp ');
        return Redirect::to('list-producer');

    }

    public function active_producer($producer_id){
        $this->AuthLogin();
        DB::table('tbl_producer')->where('producer_id',$producer_id)->update(['producer_status'=>0]);
        Session::put('message','Ẩn nhà cung cấp');
        return Redirect::to('list-producer');
    }

}
