<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;
use App\Models\Vat;

class Product extends Model implements HasMedia
{

    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    public $translatable = [
        'name',
        'features',
        'compatibility',
        'description',
        'meta_title',
        'meta_description',
        'meta_tags',
    ];

    protected $fillable = [
        'meta_title',
        'meta_tags',
        'meta_description',
        'search_name',
        'name',
        'slug',
        'regular_price',
        'sale_price',
        'wholesale_price',
        'royal_sale_price',
        'retailer_sale_price',
        'sku',
        'stock_qty',
        'total_review',
        'rating',
        'weight_unit',
        'dimension_unit',
        'weight',
        'height',
        'width',
        'length',
        'sort_order',
        'compatibility',
        'youtube_video_url',
        'youtube_video_id',
        'features',
        'description',
        'is_premium',
        'is_featured',
        'is_published',
        'color',
        'color_code',
        'vat_id',
    ];


    // Model Scope
    public function scopeSearch($query, $search)
    {
        return $query->whereRaw("MATCH(search_name) AGAINST(? IN BOOLEAN MODE)", [$search]);
    }



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {

            $this->addMediaConversion('thumb')
                ->width(100)
                ->height(100)
                ->format('webp')
                ->quality(95);

            $this->addMediaConversion('card')
                ->width(300)
                ->height(300)
                ->format('webp')
                ->quality(90);

        });

        $this->addMediaCollection('gallery')
            ->registerMediaConversions(function (Media $media = null) {

            $this->addMediaConversion('thumb')
                ->width(100)
                ->height(100)
                ->format('webp')
                ->quality(95);

            $this->addMediaConversion('card')
                ->width(300)
                ->height(300)
                ->format('webp')
                ->quality(90);

        });

    }


    public function thumbnailUrl($size = 'card')
    {
        if($this->hasMedia('thumbnail'))
        {
            return $this->getFirstMedia('thumbnail')->getUrl();
        }
    }

    public function regularPrice()
    {
        return $this->regular_price;
    }


    public function salePrice()
    {

        $customerType = $this->getCustomerType();


        if($customerType === 'user') return $this->calculateUserSalePrice();

        if($customerType === 'retailer') return $this->calculateRetailerSalePrice();

        if($customerType === 'royal-user') return $this->calculateRoyalUserSalePrice();

        if($customerType === 'wholesaler') return $this->calculateWholesalerSalePrice();


    }


    private function calculateUserSalePrice()
    {
        return $this->sale_price;
    }


    private function calculateRetailerSalePrice()
    {
        if($this->retailer_sale_price){
            return $this->retailer_sale_price;
        }

        return $this->sale_price;
    }


    private function calculateRoyalUserSalePrice()
    {
        if($this->royal_sale_price){
            return $this->royal_sale_price;
        }

        return $this->sale_price;
    }

    private function calculateWholesalerSalePrice()
    {
        if($this->wholesale_price){
            return $this->wholesale_price;
        }

        return $this->sale_price;
    }


    private function getCustomerType()
    {
        $customerType = 'user';

        if(auth()->check()){

            $usersTypes = ['user', 'retailer', 'royal-user', 'wholesaler'];

            $customer = auth()->user();

            $type = $customer->getRoleNames()->first();

            if(in_array($type, $usersTypes)){
                $customerType = $type;
            }else {
                $customerType = 'user';
            }

        }

        return $customerType;
    }


    private function calculateDiscountPercentage($regularPrice, $salePrice) {

        if($regularPrice) return 0;

        $discountAmount = $regularPrice - $salePrice;
        $discountPercentage = ($discountAmount / $regularPrice) * 100;
        return $discountPercentage;
    }



    public function hasDiscount()
    {

        $customerType = $this->getCustomerType();



        if($customerType === 'retailer') {

            if($this->retailer_sale_price && floatval($this->regular_price) && !$this->isEqual($this->retailer_sale_price, $this->regular_price))
            {
                return true;
            }

        }

        if($customerType === 'royal-user') {

            if($this->royal_sale_price && floatval($this->regular_price) && !$this->isEqual($this->royal_sale_price, $this->regular_price))
            {
                return true;
            }

        }

        if($customerType === 'wholesaler') {

            if($this->wholesale_price && floatval($this->regular_price) && !$this->isEqual($this->wholesale_price, $this->regular_price))
            {
                return true;
            }

        }


        // Fallback For All Users
        if($this->sale_price && floatval($this->regular_price) && !$this->isEqual($this->sale_price, $this->regular_price))
        {
            return true;
        }

        return false;
    }

    public function discountType()
    {

        $customerType = $this->getCustomerType();


        if($customerType === 'retailer') {

            if($this->regular_price && $this->retailer_sale_price)
            {
                $discountPercentage = $this->calculateDiscountPercentage($this->regular_price, $this->retailer_sale_price);
                return "{$discountPercentage} %";
            }

        }

        if($customerType === 'royal-user') {

            if($this->regular_price && $this->royal_sale_price)
            {
                $discountPercentage = $this->calculateDiscountPercentage($this->regular_price, $this->royal_sale_price);
                return "{$discountPercentage} %";
            }

        }

        if($customerType === 'wholesaler') {

            if($this->regular_price && $this->wholesale_price)
            {
                $discountPercentage = $this->calculateDiscountPercentage($this->regular_price, $this->wholesale_price);
                return "{$discountPercentage} %";
            }

        }


        // Fallback for all users.
        if($this->regular_price && $this->sale_price)
        {
            $discountPercentage = $this->calculateDiscountPercentage($this->regular_price, $this->sale_price);
            return "{$discountPercentage} %";
        }

        return 0;
    }


    private function isEqual($num1, $num2)
    {
        return floatval($num1) === floatval($num2);
    }


    public function discountAmount()
    {

        $customerType = $this->getCustomerType();


        if($customerType === 'retailer') {

            if($this->regular_price && $this->retailer_sale_price)
            {
                return $this->regular_price - $this->retailer_sale_price;
            }

        }

        if($customerType === 'royal-user') {

            if($this->regular_price && $this->royal_sale_price)
            {
                return $this->regular_price - $this->royal_sale_price;
            }

        }

        if($customerType === 'wholesaler') {

            if($this->regular_price && $this->wholesale_price)
            {
                return $this->regular_price - $this->wholesale_price;
            }

        }


        // if($customerType === 'user') {

        //     if($this->regular_price && $this->sale_price)
        //     {
        //         return $this->regular_price - $this->sale_price;
        //     }

        // }

        // Fall back for all users
        if($this->regular_price && $this->sale_price)
        {
            return $this->regular_price - $this->sale_price;
        }

        return 0;
    }


    public function vatAmount()
    {
        $vat = $this->vat;

        if(!$vat){
            return 0;
        }

        $salePrice =  $this->salePrice();

        $vatAmount = $salePrice * ($vat->vat_rate / 100);

        return  $vatAmount;
    }

    // Relationship

    public function recommendation()
    {
        return $this->belongsToMany(Product::class, 'recommendations', 'recommended_id', 'recommended_by_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function vat()
    {
        return $this->belongsTo(Vat::class);
    }

}
