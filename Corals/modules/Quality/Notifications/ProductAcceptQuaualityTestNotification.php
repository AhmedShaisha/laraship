<?php

namespace Corals\Modules\Quality\Notifications;

//use Corals\Modules\Quality\Mails\QualityTestCreatedEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;


class ProductAcceptQuaualityTestNotification extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return QualityTestCreatedEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
        //return new QualityTestCreatedEmail($this->data['user'], $this->data['order'], $subject, $body);
    }

    /**
     * @return mixed
     */
    public function getNotifiables()
    {
        $storeOwner = $this->data['order']->store->user;
        return [$storeOwner];
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
           
            'product_link' => url(config('marketplace.models.product.resource_url') ),
            
    
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
            'product_link' => 'product view link',
          
        ];
    }
}
