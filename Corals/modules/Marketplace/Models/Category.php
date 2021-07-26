<?php

namespace Corals\Modules\Marketplace\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Traits\GatewayStatusTrait;
use Corals\Foundation\Traits\Node\SimpleNode;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Category extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, InteractsWithMedia, SimpleNode, GatewayStatusTrait;

    protected $table = 'marketplace_categories';

    protected $casts = [
        'is_featured' => 'boolean',
        'properties' => 'json'
    ];

    public $mediaCollectionName = 'marketplace-category-thumbnail';
    public $galleryMediaCollection = 'marketplace-category-gallery'; //ourchange
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'marketplace.models.category';

    protected static $logAttributes = ['name', 'slug'];

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'marketplace_category_product');
    }

    public function scopeActive($query)
    {
        return $query->where('marketplace_categories.status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('marketplace_categories.is_featured', true);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }

    public function categoryAttributes()
    {
        return $this->belongsToMany(Attribute::class, 'marketplace_category_attributes', 'category_id');
    }


    public function brands()
    {
        return $this->hasManyThrough(Brand::class, Product::class);
    }

        //our_change
        public function scopeBase($query)
        {
            return $query->where('marketplace_categories.parent_id',  null )->orWhere('marketplace_categories.parent_id',  0 );
        }
     
        public function scopeMain($query)
        {
            return $query->whereIn('marketplace_categories.name',[ 'Men','Women','Kids']);
        }
        //end our_change

}
