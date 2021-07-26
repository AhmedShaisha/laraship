<?php

namespace Corals\Modules\Quality\Notifications;

use Corals\Modules\Quality\Mails\QualityTestCreatedEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;


class ResponsibleQualityTestNotification extends CoralsBaseNotification
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
        $responsible = $this->data['user'];
        
        return $responsible;
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
           
            'qualityTest_link' => url(config('Quality.models.qualityTests.resource_url') . '/qualityTests'),
            'responsible_name' => $this->data['user']->name
    
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
           'qualityTest_link' =>'index qualityTests View Link',
           'responsible_name' =>' responsible name'
           

        ];
    }
}
