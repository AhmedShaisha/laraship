<?php

namespace Corals\Modules\Support\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Corals\User\Models\User;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Marketplace\Models\Order;

class Response extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'support.models.response';

    protected static $logAttributes = [];

    protected $guarded = ['id'];
    protected $fillable = [ 'response','customer_Support_id','order_id'];
    protected $table = 'customer_support_responses';
   
    public function customerSupport(){
        return $this->belongsTo(CustomerSupport::class, 'customer_Support_id');
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    
    public function auther(){
        if($this->user)
        return $this->user->name;
        else 
        return 'guset';
    }
}
