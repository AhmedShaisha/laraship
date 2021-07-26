<?php

namespace Corals\Modules\Support\Notifications;
use Corals\Modules\Quality\Models\CustomerSupport;
use Corals\Modules\Quality\Models\Response;
use Corals\Modules\Support\Mails\CustomerSupportEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;
use Corals\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ResponseCreated extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return ResponseEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
        return new ResponseEmail($this->data['user'], $this->data['response'], $subject, $body);
    }

    /**
     * @return mixed
     */
    public function getNotifiables()
    {
        $user = $this->data['user']->response->created_by;;
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
           
            'responses_Requests_link' => url(config('support.models.responses.resource_url') . '/responses'),
            
            
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
           'responses_Requests_link' =>'index responses View Link',

        ];
    }
}