<?php

namespace Corals\Modules\Quality\Notifications;

//use Corals\Modules\Quality\Mails\QualityTestCreatedEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;


class BuyerResponseNotification extends CoralsBaseNotification
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
        $user = $this->data['qualityTest']->order->store->user;
        
        return $user;
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
           
            'product_link' => url(config('marketplace.models.product.resource_url'). '/' . $this->data['qualityTest']->product->hashed_id ),
            'buyer_response' => $this->data['qualityTest']->response['buyer']
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
            'product_link' => 'product view link',
            'buyer_response' =>'buyer response on the offer'

        ];
    }
}
