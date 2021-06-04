<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    public function variants()
    {

        return $this->belongsTo('App\Models\Variant', 'variant_id');
    }

    public function product()
    {

        return $this->belongsTo('App\Models\Product');
    }

    public function variantOne()
    {
        return $this->hasMany('App\Models\ProductVariantPrice', 'product_variant_one', 'id');
    }

    public function variantTwo()
    {
        return $this->hasMany('App\Models\ProductVariantPrice', 'product_variant_two', 'id');
    }

    public function variantThree()
    {
        return $this->hasMany('App\Models\ProductVariantPrice', 'product_variant_three', 'id');
    }


}
