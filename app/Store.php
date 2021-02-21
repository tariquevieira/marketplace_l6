<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	protected $fillable =['name','description','phone','mobile_phone','slug','logo'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class,'order_store','store_id','order_id');
    }

}
