<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    public function orders(){
        return $this->belongsTo(order::class);
    }

    public function products(){
        return $this->belongsTo(product::class, 'product_id');
    }

}
