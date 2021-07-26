<?php

namespace Corals\Modules\Quality\Mails;

use Corals\Modules\Quality\Quality\QualityTest;
use Corals\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Corals\Modules\Marketplace\Models\Order;

class QualityTestCreatedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $body, $subject, $order;

    /**
     * NewRequestEmail constructor.
     * @param User $user
     * @param $order
     * @param null $subject
     * @param null $body
     */
    public function __construct(User $user, Order $order, $subject = null, $body = null)
    {
        $this->user = $user;
        $this->order = $order;
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
        return $this->subject($this->subject)->view('Quality::mails.qualityTest_detalis');
    }
}
