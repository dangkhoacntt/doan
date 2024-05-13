<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='vp_products';
    protected $primaryKey ='prod_id';
    protected $fillable = [
        'prod_name',
        'prod_slug',
        'prod_price',
        'prod_img',
        'prod_warranty',
        'prod_accessories',
        'prod_condition',
        'prod_promotion',
        'prod_status',
        'prod_description',
        'prod_featured',
        'prod_cate',
        'prod_quantity', 
    ];
}