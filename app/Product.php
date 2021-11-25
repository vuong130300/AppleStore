<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'producer_id','category_id','product_name', 'product_slug','product_desc','product_content','product_price','product_image','product_status'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';

     public function category_product(){
        return $this->belongsTo('App\CategoryProduct','category_id');
    }

    public function producer(){
        return $this->belongsTo('App\Producer','producer_id');
    }
}
