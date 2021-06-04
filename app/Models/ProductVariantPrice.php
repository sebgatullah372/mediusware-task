<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
    public function product(){

        return $this->belongsTo('App\Models\Product');
    }

    public function productVariant(){

        return $this->belongsTo('App\Models\ProductVariant');
    }


}
