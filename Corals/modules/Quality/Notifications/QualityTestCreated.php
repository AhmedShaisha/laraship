<?php

namespace Corals\Modules\Quality\Notifications;

use Corals\Modules\Quality\Mails\QualityTestCreatedEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;
use Corals\User\Models\User;

use Corals\Modules\Marketplace\Models\Order;

class QualityTestCreated extends CoralsBaseNotification
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
        $admins = User::whereHas('roles', function ( $query) {
          $query->where('id', '=', 1); 
         })->get();
       return $admins;
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
           
            'qualityTest_link' => url(config('Quality.models.qualityTests.resource_url') . '/qualityTests'),
            'order_link' => url(config('marketplace.models.order.resource_url') . '/' . $this->data['order']->hashed_id)
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
           'qualityTest_link' =>'index qualityTests View Link',
            'order_link' => 'order view link'
        ];
    }
}
