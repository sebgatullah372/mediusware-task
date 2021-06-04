<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function productVariants(){
        return $this->hasMany('App\Models\ProductVariant');
    }

}
