<?php

namespace Corals\Modules\Marketplace\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Traits\ModelPropertiesTrait;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
//our_change
use Corals\Modules\Quality\Models\QualityTest;
//end
class OrderItem extends BaseModel
{
    use PresentableTrait, LogsActivity, ModelPropertiesTrait;

    protected $table = 'marketplace_order_items';
    /**
     *  Model configuration.
     * @var string
     */

    protected $casts = [
        'item_options' => 'array',
        'properties' => 'json',

    ];

    public $config = 'marketplace.models.order_item';

    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function sku()
    {
        return $this->belongsTo(SKU::class, 'sku_code', 'code');
    }


    // our_change add relationship for QualityTest model
    public function QualityTest()
   {
       return $this->hasOne(QualityTest::class);
   }
    // end our_change
}
