<?php

namespace Corals\Modules\Support\Notifications;
use Corals\Modules\Quality\Models\CustomerSupport;
use Corals\Modules\Support\Mails\CustomerSupportEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;
use Corals\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CustomerSupportCreated extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return CustomerSupportEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
        return new CustomerSupportEmail($this->data['user'], $this->data['customerSupport'], $subject, $body);
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
           
            'customerSupports_Requests_link' => url(config('support.models.customerSupports.resource_url') . '/customerSupports'),
            
            
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
          
           'customerSupports_Requests_link' =>'index customerSupports View Link',

        ];
    }
}