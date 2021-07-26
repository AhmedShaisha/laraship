<?php

/**
 * Paytabs Gateway.
 */

namespace Corals\Modules\Payment\Paytabs;

use Corals\Modules\Ecommerce\Models\SKU;
use Corals\Modules\Payment\Common\AbstractGateway;
use Corals\Modules\Payment\Common\Models\WebhookCall;
//use Corals\Modules\Payment\Stripe\Exception\StripeWebhookFailed;
//use Corals\Modules\Payment\Stripe\Message\CreateTokenRequest;
//use Corals\Modules\Subscriptions\Classes\Subscription as SubscriptionClass;
//use Corals\Modules\Subscriptions\Models\Plan;
//use Corals\Modules\Subscriptions\Models\Subscription;
use Corals\User\Models\User;
use Exception;
use Illuminate\Http\Request;
//use Stripe\Webhook;

/**
 * Paytabs Gateway.
 *
 * Example:
 *
 * <code>
 *   // Create a gateway for the Stripe Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Payment::create('Stripe');
 *
 *   // Initialise the gateway
 *   $gateway->initialize(array(
 *       'apiKey' => 'MyApiKey',
 *   ));
 *
 *   // Create a credit card object
 *   // This card can be used for testing.
 *   $card = new CreditCard(array(
 *               'firstName'    => 'Example',
 *               'lastName'     => 'Customer',
 *               'number'       => '4242424242424242',
 *               'expiryMonth'  => '01',
 *               'expiryYear'   => '2020',
 *               'cvv'          => '123',
 *               'email'                 => 'customer@example.com',
 *               'billingAddress1'       => '1 Scrubby Creek Road',
 *               'billingCountry'        => 'AU',
 *               'billingCity'           => 'Scrubby Creek',
 *               'billingPostcode'       => '4999',
 *               'billingState'          => 'QLD',
 *   ));
 *
 *   // Do a purchase transaction on the gateway
 *   $transaction = $gateway->purchase(array(
 *       'amount'                   => '10.00',
 *       'currency'                 => 'USD',
 *       'card'                     => $card,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Purchase transaction was successful!\n";
 *       $sale_id = $response->getTransactionReference();
 *       echo "Transaction reference = " . $sale_id . "\n";
 *
 *       $balance_transaction_id = $response->getBalanceTransactionReference();
 *       echo "Balance Transaction reference = " . $balance_transaction_id . "\n";
 *   }
 * </code>
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
 * Authentication:
 *
 * Authentication is by means of a single secret API key set as
 * the apiKey parameter when creating the gateway object.
 *
 * @see \Corals\Modules\Payment\Common\AbstractGateway
 * @see \Corals\Modules\Payment\Stripe\Message\AbstractRequest
 *
 * @link https://stripe.com/docs/api
 *
 * @method \Corals\Modules\Payment\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Corals\Modules\Payment\Common\Message\RequestInterface completePurchase(array $options = array())
 */
class Gateway extends AbstractGateway
{
    const BILLING_PLAN_FREQUENCY_DAY = 'day';
    const BILLING_PLAN_FREQUENCY_WEEK = 'week';
    const BILLING_PLAN_FREQUENCY_MONTH = 'month';
    const BILLING_PLAN_FREQUENCY_YEAR = 'year';


    public function getName()
    {
        return 'Paytabs';
    }

    /**
     * Get the gateway parameters.
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'serverKey' => '',
        );
    }

    /**
     * Get the gateway API Key.
     *
     * Authentication is by means of a single secret API key set as
     * the apiKey parameter when creating the gateway object.
     *
     * @return string
     */
    public function getServerKey()
    {
        return $this->getParameter('serverKey');
    }

   

    /**
     * Set the gateway API Key.
     *
     * Authentication is by means of a single secret API key set as
     * the apiKey parameter when creating the gateway object.
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
     * @param string $value
     *
     * @return Gateway provides a fluent interface.
     */

    public function serverKey($value)
    {
        return $this->setParameter('serverKey', $value);
    }
   

    public function setAuthentication()
    {
        $serverkey = 'S9JNRZJ269-JBNH9GNTWR-ZJWH2HTR2L';
       // $serverkey = \Settings::get('payment_paytabs_server_key');
        $this->serverkey($serverkey);

    }

    public function requireRedirect()
    {
        return false;
    }


    /* @param array $parameters
    *
    * @return \Corals\Modules\Payment\Paytabs\Message\HostedPaymentPageRequest
    */
   public function getHostedPaymentPage(array $parameters = array())
   {
       return $this->createRequest('\Corals\Modules\Payment\Paytabs\Message\HostedPaymentPageRequest', $parameters);
   }
}