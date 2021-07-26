<?php

namespace Corals\Modules\Support\Observers;

use Corals\Modules\Support\Models\CustomerSupport;
use Corals\User\Models\User;

class CustomerSupportObserver
{

    /**
     * @param CustomerSupport $customerSupport
     */
    public function created(CustomerSupport $customerSupport)
    {
        $user=\Support::getusersList();
                if (!$user->isEmpty()) {
                   $user = $user->pluck('id')->random(1)->first();
                   
                } else {
                    $user=null;
                }
               
                event('notifications.support.customerSupport_created',['customerSupport' => $customerSupport]);
    }
}