<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Shipper extends Model
{
    use HasFactory;


    protected $fillable = [
        'shipper',
        'notes',
        'delivery_cost',
        'slug',
        'is_published',
    ];
}
