<?php

namespace Corals\Modules\Approval\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Corals\Modules\Marketplace\Models\Product;
use Corals\User\Models\User;


class ApproveRequest extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'approval.models.approveRequest';

    protected static $logAttributes = [];

    protected $guarded = ['id'];

    //add relitionship product
    public function product(){
        return $this->belongsTo(Product::class);
    }
 
}
