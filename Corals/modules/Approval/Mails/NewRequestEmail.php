<?php

namespace Corals\Modules\Approval\Mails;

use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Corals\Modules\Marketplace\Models\Product;

class NewRequestEmail extends Mailable implements ShouldQueue
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
    public function __construct(User $user, Product $product, $subject = null, $body = null)
    {
        $this->user = $user;
        $this->product = $product;
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
        return $this->subject($this->subject)->view('Approval::mails.request_detalis');
    }
}
