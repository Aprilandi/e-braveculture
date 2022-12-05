<?php

namespace App\Models;

use App\Models\Products;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    protected $table = 'product_reviews';

    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_review', 'id_product', 'id_user', 'review', 'score',
    ];

    // public function Products(){
    //     return $this->belongsTo(Products::class, 'id_product', 'id_product');
    // }

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
