<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function categories(){
        return $this->belongsTo(category::class);
    }

    public function orderdetails(){
        return $this->hasMany(orderdetail::class);
    }

}
