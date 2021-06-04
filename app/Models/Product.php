<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function productVariants(){

        return $this->hasMany('App\Models\ProductVariant');
    }
    public function productVariantPrices(){

        return $this->hasMany('App\Models\ProductVariantPrice');
    }

    public function productImages(){

        return $this->hasMany('App\Models\ProductImage');
    }



}
