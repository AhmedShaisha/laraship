<?php

namespace Corals\Modules\Support\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Corals\User\Models\User;
use Corals\Modules\Support\Models\Response;
use Corals\Modules\Marketplace\Models\Order;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Corals\Modules\Support\Traits\DownloadableModel;

class CustomerSupport extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, InteractsWithMedia, DownloadableModel;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'support.models.customerSupport';

    protected static $logAttributes = [];

    protected $guarded = ['id'];
    public $mediaCollectionName = 'marketplace-ticket-files';

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function responses(){
        return $this->hasMany(Response::class, 'customer_Support_id','id');
    }
}
