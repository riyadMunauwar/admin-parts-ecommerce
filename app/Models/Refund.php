<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class Refund extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;



    public function customer()
    {
        return $this->belongsTo(User::class);
    }



    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
