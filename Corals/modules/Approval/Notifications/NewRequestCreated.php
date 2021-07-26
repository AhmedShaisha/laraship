<?php

namespace Corals\Modules\Approval\Notifications;

use Corals\Modules\Approvel\Mails\NewRequestEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;
use Corals\Modules\Marketplace\Models\Product;
use Corals\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class NewRequestCreated extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return NewRequestEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
        return new NewRequestEmail($this->data['user'], $this->data['product'], $subject, $body);
    }

    /**
     * @return mixed
     */
    public function getNotifiables()
    
    {
        $admins = User::whereHas('roles', function ( $query) {
          $query->where('id', '=', 1); 
         })->get();
     return $admins;
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
           
            'approveRequests_Requests_link' => url(config('approval.models.approveRequests.resource_url') . '/approveRequests'),
            'product_link' => url(config('marketplace.models.product.resource_url') . '/' . $this->data['product']->hashed_id)
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
           'approveRequests_Requests_link' =>'index approveRequests View Link',
            'prodcut_link' => 'prodcut view link'
        ];
    }
}
