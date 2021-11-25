<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
session_start();

class CustomerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_customer(){
        $this->AuthLogin();
    	return view('admin.Customer.add_customer');
    }
    
    public function list_customer(){
        $this->AuthLogin();

        $all_customer = Customer::orderBy('customer_id','DESC')->paginate(5);
    	
    	return view('admin.Customer.list_customer')->with(compact('all_customer'));


    }
    public function save_customer(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $customer = new Customer();
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->save();

    	Session::put('message','Thêm khách hàng thành công');
    	return Redirect()->back();
    }
    
    public function edit_customer($customer_id){
        $this->AuthLogin();

        $all_customer = Customer::find($customer_id);
        
        return view('admin.Customer.edit_customer')->with(compact('all_customer'));
    }
    public function update_customer(Request $request,$customer_id){
        $this->AuthLogin();
        
        $data = $request->all();
        $customer = Customer::find($customer_id);
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        if($customer->customer_password==$data['customer_password']){
            $customer->customer_password = $data['customer_password'];
        }else{
            $customer->customer_password = md5($data['customer_password']);
        }
       
        $customer->save();

    	Session::put('message','Cập nhật thông tin khách hàng thành công');
    	return Redirect::to('/list-customer');
    }
    public function delete_customer($customer_id){
        $this->AuthLogin();
        $customer = Customer::find($customer_id);
        $customer->delete();
        Session::put('message','Xóa khách hàng thành công');
        return Redirect()->back();
    }

    
}
