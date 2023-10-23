<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Menu;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    public $translatable = [
        'name',
        'description',
        'meta_title',
        'meta_description',
        'meta_tags',
    ];

    protected $fillable = [
        'name',
        'search_name',
        'slug',
        'order',
        'description',
        'is_published',
        'order_id',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_tags',
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                    
                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100)
                    ->format('webp')
                    ->quality(90);

                $this->addMediaConversion('card')
                    ->width(240)
                    ->height(240)
                    ->format('webp')
                    ->quality(90);
                    
            });
    }

    public function getIconAttribute()
    {
        if($this->hasMedia('icon'))
        {
            return $this->getFirstMedia('icon')->getUrl('card');
        }
    }

    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children')->orderBy('order');
    }


    public function hasChildren()
    {
        return count($this->children) ?? false;
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function getParentsAttribute()
    {
        $parents = collect();
        $category = $this;
        while ($category->parent) {
            $parents->prepend($category->parent);
            $category = $category->parent;
        }
        return $parents;
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

    public function scopeOrderAsc($query)
    {
        return $query->orderBy('order');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
