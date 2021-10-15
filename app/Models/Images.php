<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table ='product_images';

    public function product()
    {
    	return $this->belongsTo(Product::class,'pi_product_id');
    }
}
