<?php

/**
 * Stripe Abstract Request.
 */

namespace Corals\Modules\Payment\Paytabs\Message;

use Money\Currency;
use Money\Money;
use Money\Number;
use Money\Parser\DecimalMoneyParser;
use Corals\Modules\Payment\Common\Exception\InvalidRequestException;

/**
 * Stripe Abstract Request.
 *
 * This is the parent class for all Stripe requests.
 *
 * Test modes:
 *
 * Stripe accounts have test-mode API keys as well as live-mode
 * API keys. These keys can be active at the same time. Data
 * created with test-mode credentials will never hit the credit
 * card networks and will never cost anyone money.
 *
 * Unlike some gateways, there is no test mode endpoint separate
 * to the live mode endpoint, the Stripe API endpoint is the same
 * for test and for live.
 *
 * Setting the testMode flag on this gateway has no effect.  To
 * use test mode just use your test mode API key.
 *
 * You can use any of the cards listed at https://stripe.com/docs/testing
 * for testing.
 *
 * @see \Corals\Modules\Payment\Stripe\Gateway
 * @link https://stripe.com/docs/api
 */
abstract class AbstractRequest extends \Corals\Modules\Payment\Common\Message\AbstractRequest
{
    /**
     * Live or Test Endpoint URL.
     *
     * @var string URL
     */
    protected $endpoint = 'https://secure.paytabs.sa/payment/request';

    /**
     * Get the gateway API Key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the gateway API Key.
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }






   


    abstract public function getEndpoint();

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @return array
     */
   /* public function getHeaders()
    {
        $headers = array();
        $headers['authorization'] = env('PAYTABS_SERVER_KEY');
        $headers['Content-type'] = env('application/json');


        return $headers;
    }*/

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $headers = array(   'authorization' => env('PAYTABS_SERVER_KEY'),
        'Content-type' => 'application/json');

        $body = json_encode($data);
        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);

        return $this->createResponse($httpResponse->getBody()->getContents(), $httpResponse->getHeaders());
    }


    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }



   
   
}
