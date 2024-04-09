<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'category',
        'unit_price',
        'created_at',
        'updated_at',
        'status',
        'product_image',
    ];

    protected $hidden = [
        'product_id',
    ]; 


    public static function getCartNumbersItems(){
        $cartProducts = Session::get('cartProducts');
        if ($cartProducts) {
            return count($cartProducts);        
        } else { 
            return 0;
        }
    }

}
