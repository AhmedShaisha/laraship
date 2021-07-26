<?php

namespace Corals\Modules\Quality\Notifications;

use Corals\Modules\Quality\Mails\QualityTestCreatedEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;
use Corals\User\Models\User;


class SellerResponseNotification extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return QualityTestCreatedEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
       // return new QualityTestCreatedEmail($this->data['user'], $this->data['qualityTest'], $subject, $body);
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
           
            'product_link' => url(config('marketplace.models.product.resource_url'). '/' . $this->data['qualityTest']->product->hashed_id ),
            'seller_response' => $this->data['qualityTest']->response['seller']
    
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
           
            'product_link' => 'product view link',
            'seller_response' =>'seller response on the offer'

        ];
    }
}
