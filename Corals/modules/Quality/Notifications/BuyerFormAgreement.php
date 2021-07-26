<?php

namespace Corals\Modules\Quality\Notifications;

use Corals\Modules\Quality\Mails\BuyerFormAgreementEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;

class BuyerFormAgreement extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return BuyerFormAgreementEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
        return new BuyerFormAgreementEmail($this->data['order']->user,$this->data['order_item'], $subject, $body);
    }

    /**
     * @return mixed
     */
    public function getNotifiables()
    {
        $order_buyer = $this->data['order']->user;
        if ($order_buyer) {
            return [$order_buyer];
        } else {
            return [];
        }
    }

    public function getOnDemandNotificationNotifiables()
    {
        $order = $this->data['order'];
        $order_buyer = $order->user;
        $order_item =$this->data['order_item']; 
        if (!$order_buyer) {
            return [
                'mail' => $order->billing['billing_address']['email']
            ];
        }

        return [];
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        $order = $this->data['order'];
        $user = $order->user;
        $order_item =$this->data['order_item']; 
        return [
            'name' => $user ? $user->full_name : $order->billing['billing_address']['first_name'],
            'order_link' => url(config('marketplace.models.order.resource_url') . '/' . $order->hashed_id),
            'order_number' => $order->order_number,
            'order_item_link' => url(config('marketplace.models.order.resource_url')  . '/' . $order_item->hashed_id.'/BuyerFormAgreement'),
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
            'name' => 'Order user name',
            'order_number' => 'order Number',
            'order_link' => 'Order view link',
            'order_item_link' => 'Buyer Form Agreement'
        ];
    }
}
