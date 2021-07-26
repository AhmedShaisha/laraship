<?php

namespace Corals\Modules\Support\Mails;

use Corals\Modules\Support\Models\CustomerSupport;
use Corals\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class CustomerSupportEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $body, $subject, $order;

    /**
     * NewRequestEmail constructor.
     * @param User $user
     * @param $product
     * @param null $subject
     * @param null $body
     */
    public function __construct(User $user, $subject = null, $body = null)
    {
        $this->user = $user;
       
        $this->body = $body;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('Support::mails.request_detalis');
    }
}
