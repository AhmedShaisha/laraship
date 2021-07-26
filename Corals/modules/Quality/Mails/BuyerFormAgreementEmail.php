<?php

namespace Corals\Modules\Quality\Mails;

use Corals\Modules\Quality\Models\QualityTest;
use Corals\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Corals\Modules\Marketplace\Models\Order;
use Corals\Modules\Marketplace\Models\OrderItem;


class BuyerFormAgreementEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $body, $subject, $order_item;

    /**
     * NewRequestEmail constructor.
     * @param User $user
     * @param $order
     * @param null $subject
     * @param null $body
     */
    public function __construct(User $user, OrderItem $order_item, $subject = null, $body = null)
    {
        $this->user = $user;
        $this->order_item = $order_item;
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
    return $this->subject($this->subject)->view('Quality::qualityTests.BuyerFormAgreement');
      
    }
}
