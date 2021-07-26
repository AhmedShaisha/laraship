<?php

namespace Corals\Modules\Quality\Notifications;

use Corals\Modules\Quality\Mails\QualityTestCreatedEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;


class ShippingAddressQualityTestNotification extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return QualityTestCreatedEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
       // return new QualityTestCreatedEmail($this->data['order']->store->user, $this->data['order'], $subject, $body);
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
           
            'order_link' => url(config('marketplace.models.order.resource_url') . '/' . $this->data['order']->hashed_id),
            'product_link' => url(config('marketplace.models.product.resource_url') . '/' . $this->data['qualityTest']->product->hashed_id),
            'storeOwner'=>$this->data['order']->store->user->name,
           // 'shipping_address' =>\Settings::get('marketplace_shipping_shipping_address'),
           'shipping_address' =>$this->data['qualityTest']->shipping['address'],
           
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
            'order_link' => 'order view link',
            'storeOwner'=> 'name of the store Owner',
            'shipping_address' => 'Shipping Address',
            'product_link' => 'product view link',
           

        ];
    }
}
