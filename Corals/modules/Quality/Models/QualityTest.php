<?php

namespace Corals\Modules\Quality\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Corals\Modules\Marketplace\Models\Order;
use Corals\Modules\Marketplace\Models\Product;
use Corals\Modules\Marketplace\Models\OrderItem;
use Corals\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Corals\Foundation\Traits\ModelUniqueCode;


class QualityTest extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, InteractsWithMedia, ModelUniqueCode;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'quality.models.qualityTest';

    protected static $logAttributes = [];

    protected $guarded = ['id'];
    protected $casts = [
        'shipping' => 'array',
        'response' => 'array',
        'properties' => 'json'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function item()
    {
        return $this->belongsTo(OrderItem::class,'order_item_id','id');
    }
}
