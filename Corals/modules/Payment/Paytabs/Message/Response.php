<?php

/**
 * Stripe Response.
 */

namespace Corals\Modules\Payment\Paytabs\Message;

use Corals\Modules\Payment\Common\Message\AbstractResponse;
use Corals\Modules\Payment\Common\Message\RequestInterface;

/**
 * Stripe Response.
 *
 * This is the response class for all Stripe requests.
 *
 * @see \Corals\Modules\Payment\Stripe\Gateway
 */
class Response extends AbstractResponse
{
    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->headers = $headers;
    }

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->data['code'];
    }


    /**
     * Get the transaction reference.
     *
     * @return string|null
     */
    public function getTransactionReference()
     {
       return $this->data['tran_ref'];
     }


 




}
