<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function orderdetails(){
        return $this->hasMany(orderdetail::class);
    }
}
