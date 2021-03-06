<?php

namespace Corals\Modules\Marketplace\Traits;

use Corals\Modules\Marketplace\Classes\Coupons\Advanced;
use Corals\Modules\Marketplace\Classes\Marketplace;
use Corals\Modules\Marketplace\Facades\Marketplace as MarketplaceFacade;
use Corals\Modules\Marketplace\Http\Requests\CheckoutRequest;
use Corals\Modules\Marketplace\Models\Coupon;
use Corals\Modules\Marketplace\Models\Order;
use Corals\Modules\Marketplace\Models\Store;
use Corals\Modules\Payment\Payment;
use Corals\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait CheckoutControllerCommonFunctions
{
    /**
     * CartController constructor.
     */
    protected $shipping;

    /**
     * @param $step
     * @param Request $request
     * @return array|bool|string
     * @throws \Throwable
     */
    public function checkoutStep($step, Request $request)
    {
        try {
            switch ($step) {
                case 'checkout-method':
                    return view('Marketplace::checkout.partials.checkout_method')->render();

                case 'cart-details':
                    foreach (\ShoppingCart::getAllInstanceItems() as $item) {
                        if (!$item->id->isAvailable($item->qty)) {
                            \ShoppingCart::removeItem($item->getHash());
                        }
                    }

                    $coupon_code = \ShoppingCart::get('default')->getAttribute('coupon_code');

                    return view('Marketplace::checkout.partials.cart_items')->with(compact('coupon_code'))->render();
                case 'billing-shipping-address':
                    $enable_shipping = \ShoppingCart::get('default')->getAttribute('enable_shipping');

                    $billing_address = \ShoppingCart::get('default')->getAttribute('billing_address') ?? [];

                    if (!$billing_address) {
                        if (user() && user()->address('billing')) {
                            $billing_address = user()->address('billing');
                        }
                    }

                    $shipping_address = \ShoppingCart::get('default')->getAttribute('shipping_address') ?? [];

                    if (!$shipping_address) {
                        if (user() && user()->address('shipping')) {
                            $shipping_address = user()->address('shipping');
                        }
                    }

                    if (user()) {
                        $shipping_address['first_name'] = user()->name;
                        $shipping_address['last_name'] = user()->last_name;
                        $shipping_address['email'] = user()->email;

                        $billing_address['first_name'] = user()->name;
                        $billing_address['last_name'] = user()->last_name;
                        $billing_address['email'] = user()->email;
                    }
          
                    
                    return view('Marketplace::checkout.partials.address')->with(compact('shipping_address',
                        'enable_shipping', 'billing_address'))->render();
                case 'select-payment':
                    $gateway = null;
                    $gateway_name = $request->get('gateway_name');
                  return   $this->preparePayment($gateway_name);
              /*    $billing = [];
                  $enable_shipping = \ShoppingCart::get('default')->getAttribute('enable_shipping');
                  $billing_address = \ShoppingCart::get('default')->getAttribute('billing_address');
          
                  $cart_instances = \ShoppingCart::getInstances();
          
                  $user = user();
          
                  $orders = [];
          
                  foreach ($cart_instances as $instance) {
                      $cart = \ShoppingCart::setInstance($instance);
          
                      $cart_items_count = $cart->count();
          
                      if ($cart_items_count > 0) {
                          $coupon_code = $cart->getAttribute('coupon_code');
          
                          $billing['billing_address'] = $billing_address;
          
                          $order = null;
          
                          if ($cart->getAttribute('order_id')) {
                              $order = Order::find($cart->getAttribute('order_id'));
                          }
          
                          if ($order) {
                              $order->items()->delete();
          
                              $order->update([
                                  'amount' => \Payments::currency_convert($cart->total(false)),
                                  'billing' => $billing,
                                  'currency' => \Payments::session_currency(),
                                  'status' => 'pending',
                              ]);
                          } else {
                              $order = Order::create([
                                  'amount' => \Payments::currency_convert($cart->total(false)),
                                  'currency' => \Payments::session_currency(),
                                  'order_number' => \Marketplace::createOrderNumber(),
                                  'billing' => $billing,
                                  'status' => 'pending',
                                  'store_id' => $instance,
                                  'user_id' => $user ? $user->id : null,
                              ]);
          
                              $cart->setAttribute('order_id', $order->id);
                          }
          
                          $items = [];
          
                          foreach ($cart->getItems() as $item) {
                              $items[] = [
                                  'amount' => \Payments::currency_convert($item->price),
                                  'quantity' => $item->qty,
                                  'description' => $item->id->product->name . ' - ' . $item->id->code,
                                  'sku_code' => $item->id->code,
                                  'type' => 'Product',
                                  'item_options' => ['product_options' => $item->product_options]
                              ];
                          }
          
                          if ($enable_shipping && $cart->getAttribute('selected_shipping_method')) {
                              $shipping_rates = $cart->getAttribute('shipping_rates');
                              $selected_shipping_method = $cart->getAttribute('selected_shipping_method');
          
                              foreach ($selected_shipping_method as $selected_method) {
                                  $methods = explode(';', $selected_method);
                                  foreach ($methods as $method) {
                                      $selected_shipping = $shipping_rates[$method];
                                      $shipping_method = $selected_shipping['shipping_method'];
                                      $shipping_description = $selected_shipping['provider'] . ' - ' . $shipping_method . "-" . $selected_shipping['service'] . ' Shipping';
          
                                      $shipping_properties = [
                                          'shipping_rule_id' => $selected_shipping['shipping_rule_id'],
                                          'shipping_method' => $shipping_method,
                                          'provider' => $selected_shipping['provider'],
                                          'store_id' => $instance,
                                          'product_id' => $selected_shipping['product_id'] ?? '',
                                          'product_name' => $selected_shipping['product_name'] ?? '',
                                          'shipping_ref_id' => $selected_shipping['shipping_ref_id'] ?? [],
                                      ];
          
          
                                      $items[] = [
                                          'amount' => \Payments::currency_convert($selected_shipping['amount'],
                                              $selected_shipping['currency']),
                                          'quantity' => $selected_shipping['qty'],
                                          'description' => !empty($shipping_properties['product_name']) ?
                                              sprintf("%s [%s]", $shipping_description,
                                                  $shipping_properties['product_name']) :
                                              $shipping_description,
                                          'sku_code' => '',
                                          'type' => 'Shipping',
                                          'properties' => $shipping_properties,
                                      ];
          
                                      if ($cart->getAttribute('shipping_description')) {
                                          $cart->removeFee($cart->getAttribute('shipping_description'));
                                      }
                                      $cart->addFee($shipping_description, $selected_shipping['amount']);
                                      $cart->setAttribute('shipping_description', $shipping_description);
                                  }
                              }
                              $order->amount = $cart->total(false);
                              $order->save();
                          }
          
                          $order_tax = $cart->taxTotal(false);
          
                          if ($order_tax) {
                              $items[] = [
                                  'amount' => \Payments::currency_convert($order_tax),
                                  'quantity' => 1,
                                  'description' => 'Sales Tax',
                                  'sku_code' => 'tax',
                                  'type' => 'Tax',
                              ];
                          }
          
                          $discount = $cart->totalDiscount(false);
          
                          if ($discount > 0) {
                              $coupon_code;
                              $items[] = [
                                  'amount' => -1 * $discount,
                                  'quantity' => 1,
                                  'description' => 'Discount Coupon ',
                                  'sku_code' => $coupon_code,
                                  'type' => 'Discount',
                              ];
                          }
          
                          $order->items()->createMany($items);
          
                          //save amount again after addons calculations
          
                          $order->amount = \Payments::currency_convert($cart->total(false));
          
                          $order->save();
          
                          $orders[] = $order;
                      } elseif ($instance != 'default') {
                          $order_id = $cart->getAttribute('order_id');
                          if ($order_id) {
                              $order = Order::find($order_id);
                              if ($order) {
                                  $order->delete();
                              }
                          }
                          $cart->destroyCart();
                      }
                  }
          
                  if (!$gateway_name) {
                      $available_gateways = \Payments::getAvailableGateways();
                      foreach ($available_gateways as $gateway_key => $available_gateway) {
                          $marketplace = new Marketplace($gateway_key);
                          if (!$marketplace->gateway->getConfig('support_marketplace')) {
                              unset($available_gateways[$gateway_key]);
                          }
                      }
                      if (count($available_gateways) == 1) {
                          $gateway_name = key($available_gateways);
                      }
                  }
          
          
                  if ($gateway_name) {
                      $marketplace = new Marketplace($gateway_name);
                      $gateway = $marketplace->gateway;
                  }
          
                  //save amount again after additinal charge calculations
                  $amount = \ShoppingCart::totalAllInstances(false);
                  $can_redeem = false;
          
                  if (\Settings::get('marketplace_checkout_points_redeem_enable', true)) {
                      $points_needed = \Referral::getPointsNeedforAmount($amount);
          
                      $available_points_blanace = \Referral::getPointsBalance(user());
          
                      if ($available_points_blanace > $points_needed) {
                          $can_redeem = true;
                      }
                  }
          
                      return view('Marketplace::checkout.partials.payment')->with(compact('gateway', 'can_redeem',
                      'points_needed', 'available_points_blanace', 'amount', 'available_gateways',
                      'orders'))->render();
                  */
             
                    break;
                case 'shipping-method':
                    $shipping_address = \ShoppingCart::get('default')->getAttribute('shipping_address');

                    $cart_instances = \ShoppingCart::getInstances();

                    $shipping_methods = [];
                    $shippable_items = [];

                    foreach ($cart_instances as $instance) {
                        $cart = \ShoppingCart::setInstance($instance);

                        if ($cart->getAttribute('shipping_description')) {
                            $cart->removeFee($cart->getAttribute('shipping_description'));
                        }

                        $store = Store::find($instance);

                        $isPerProductShipping = false;

                        if ($store) {
                            $isPerProductShipping = $store->getSettingValue('marketplace_shipping_is_shipping_per_product',
                                false);
                        }

                        if ($cart->count() > 0) {
                            $cartItems = $cart->getItems();
                            $cartTotal = $cart->total(false);

                            $store_shippable_items = \Shipping::getShippableItems($cartItems, $isPerProductShipping);

                            if (count($store_shippable_items) > 0) {
                                $cart_shipping_rates = [];
                                $instanceShippingMethods = [];

                                $excludedProductsFromStoreLabel = [];

                                if ($isPerProductShipping) {
                                    foreach ($store_shippable_items as $shippable_item) {
                                        $shipping_rates = \Shipping::getAvailableShippingMethods($shipping_address,
                                            [$shippable_item], $cartTotal, $instance, true);

                                        if (is_array($shipping_rates)) {
                                            $cart_shipping_rates = array_merge($cart_shipping_rates, $shipping_rates);
                                            if (empty($shipping_rates)) {
                                                $instanceShippingMethods['products'][$shippable_item->getHash()] = [];
                                            } else {
                                                $this->fillInstanceRates($shipping_rates, $instanceShippingMethods,
                                                    $excludedProductsFromStoreLabel, $store);
                                            }
                                        }
                                    }
                                } else {
                                    $shipping_rates = \Shipping::getAvailableShippingMethods($shipping_address,
                                        $store_shippable_items, $cartTotal, $instance, false);
                                    if (is_array($shipping_rates)) {
                                        $cart_shipping_rates = array_merge($cart_shipping_rates, $shipping_rates);

                                        $this->fillInstanceRates($shipping_rates, $instanceShippingMethods,
                                            $excludedProductsFromStoreLabel, $store);
                                    }
                                }

                                $shipping_methods[$instance] = $instanceShippingMethods;

                                foreach ($store_shippable_items as $store_shippable_item) {
                                    if (in_array($store_shippable_item->getHash(),
                                        $excludedProductsFromStoreLabel)) {
                                        continue;
                                    }
                                    $shippable_items[$instance][$store_shippable_item->getHash()] = $store_shippable_item->id->product->name;
                                }


                                \Logger($cart_shipping_rates);

                                $cart->setAttribute('shipping_rates', $cart_shipping_rates);
                            }
                        }
                    }

                    return view('Marketplace::checkout.partials.shipping_methods')->with(compact('shipping_methods',
                        'shippable_items'))->render();
                    break;
                case 'order-review':
                    $cart_instances = \ShoppingCart::getInstances();

                    $orders = [];

                    foreach ($cart_instances as $instance) {
                        $cart = \ShoppingCart::setInstance($instance);

                        if ($cart->getAttribute('order_id')) {
                            $order = Order::find($cart->getAttribute('order_id'));
                            $orders[] = $order;
                        }
                    }

                    return view('Marketplace::checkout.partials.order_review')->with(['orders' => $orders])->render(); 
                    break;
                default:
                    return false;
            }
        } catch (\Exception $exception) {
            log_exception($exception, 'CheckOutController', 'checkoutStep', null, true);
        }
    }

    protected function fillInstanceRates(
        $shipping_rates,
        &$instanceShippingMethods,
        &$excludedProductsFromStoreLabel,
        $store
    )
    {
        foreach ($shipping_rates as $key => $rate) {
            $label = $rate['shipping_method'];

            if ($rate['service']) {
                $label .= " " . $rate['service'];
            }

            if ($rate['provider']) {
                $label .= " " . $rate['provider'];
            }

            if ($rate['amount']) {
                $label .= ' : <span class="text-info">' . \Payments::currency_convert($rate['amount'],
                        $rate['currency'], null, true) . '</span>';
            }

            if ($rate['estimated_days']) {
                $label .= ', Estimated Delivery : <span class="text-info">' . $rate['estimated_days'] . ' Day(s) </span>';
            }

            if ($rate['description']) {
                $label .= '<br><small>' . $rate['description'] . '</small>';
            }

            $instanceShippingMethods['products'][$rate['cart_ref_id']][] = [
                'key' => $key,
                'label' => $label,
                'amount' => $rate['amount'],
                'product_name' => $rate['product_name'],
                'product_id' => $rate['product_id'],
                'currency' => $rate['currency']
            ];
        }

        $isPerProductShipping = $store->getSettingValue('marketplace_shipping_is_shipping_per_product', false);
        if (isset($instanceShippingMethods['products'])) {
            foreach ($instanceShippingMethods['products'] as $ref_id => $rates) {
                if ($isPerProductShipping || count($rates) > 1) {
                    $excludedProductsFromStoreLabel[] = $rate['cart_ref_id'];
                } else {
                    $current_label = $instanceShippingMethods['options'][$store->id]['label'] ?? "";
                    $current_amount = $instanceShippingMethods['options'][$store->id]['amount'] ?? 0;
                    $current_keys = $instanceShippingMethods['options'][$store->id]['key'] ?? [];

                    $instanceShippingMethods['options'][$store->id] = [
                        'key' => array_merge($current_keys, [$rates[0]['key']]),
                        'label' => $current_label . $rates[0]['product_name'] . ": " . $rates[0]['label'] . ",",
                        'amount' => $current_amount + $rates[0]['amount'],
                        'currency' => $rates[0]['currency'],
                    ];

                    unset($instanceShippingMethods['products'][$ref_id]);
                }
            }
        }
        if (isset($instanceShippingMethods['options'])) {
            foreach ($instanceShippingMethods['options'] as $store_id => $rate) {
                $instanceShippingMethods['options'][$store_id]['label'] = '<span class="text-info">' . \Payments::currency_convert($instanceShippingMethods['options'][$store_id]['amount'],
                        $instanceShippingMethods['options'][$store_id]['currency'], null,
                        true) . '</span>:' . $instanceShippingMethods['options'][$store_id]['label'];

                $instanceShippingMethods['options'][$store_id]['key'] = implode(';',
                    $instanceShippingMethods['options'][$store_id]['key']);
            }
        }
    }


    /**
     * @param $step
     * @param CheckoutRequest $request
     */
    public function saveCheckoutStep($step, CheckoutRequest $request)
    {
        try {
            switch ($step) {
                case 'cart-details':
                    \ShoppingCart::get('default')->removeAttribute('coupon_code');
                    \ShoppingCart::removeCoupons();

                    if ($request->input('coupon_code')) {
                        $coupon_code = $request->input('coupon_code');
                        $coupon = Coupon::where('code', $coupon_code)->first();
                        if (!$coupon) {
                            throw new \Exception(trans('Marketplace::exception.checkout.invalid_coupon',
                                ['code' => $coupon_code]));
                        }
                        $coupon_class = new Advanced($coupon_code, $coupon, []);

                        $coupon_store_cart = \ShoppingCart::get($coupon->store_id);

                        $coupon_class->validate($coupon_store_cart, true);


                        $coupon_store_cart->addCoupon($coupon_class);
                        \ShoppingCart::get('default')->setAttribute('coupon_code', $coupon_code);
                    }
                    break;
                case 'billing-shipping-address':

                    $shipping_address = $request->input('shipping_address');
                    $billing_address = $request->input('billing_address');

                    if (\Settings::get('marketplace_tax_calculate_tax')) {
                        if ($shipping_address) {
                            $this->calculateCartTax($shipping_address);
                        } elseif ($billing_address) {
                            $this->calculateCartTax($billing_address);
                        }
                    }

                    if ($request->input('save_billing')) {
                        user()->saveAddress($billing_address, 'billing');
                    }
                    if ($request->input('save_shipping')) {
                        user()->saveAddress($shipping_address, 'shipping');
                    }

                    \ShoppingCart::get('default')->setAttribute('billing_address', $billing_address);
                    \ShoppingCart::get('default')->setAttribute('shipping_address', $shipping_address);
                   
                    $this->preparePayment();
                    ///
                   // $checkoutToken = $request->input('checkoutToken');
                //    $gateway_key = 'Paytabs';
                    $payment_details = 'TEST';//$request->input('payment_details');

                 //   $gateway = Payment::create($gateway_key);

                  //  if (method_exists($gateway, 'validateRequest')) {
                  //      $gateway->validateRequest($request);
                  //  }

                   // \ShoppingCart::get('default')->setAttribute('checkoutToken', $checkoutToken);
                  //  \ShoppingCart::get('default')->setAttribute('gateway', $gateway_key);
                    \ShoppingCart::get('default')->setAttribute('payment_details', 'payment_details' );
                    ////
                    break;
                case 'select-payment':
                    $checkoutToken = $request->input('checkoutToken');
                    $gateway_key = $request->input('gateway');
                    $payment_details = $request->input('payment_details');

                    $gateway = Payment::create($gateway_key);

                    if (method_exists($gateway, 'validateRequest')) {
                        $gateway->validateRequest($request);
                    }

                    \ShoppingCart::get('default')->setAttribute('checkoutToken', $checkoutToken);
                    \ShoppingCart::get('default')->setAttribute('gateway', $gateway_key);
                    \ShoppingCart::get('default')->setAttribute('payment_details', $payment_details);
                    break;
                case 'shipping-method':
                    $selected_shipping_methods = $request->input('selected_shipping_methods');

                    foreach ($selected_shipping_methods as $instance => $selected_shipping_method) {
                        $cart = \ShoppingCart::setInstance($instance);

                        $cart->setAttribute('selected_shipping_method',
                            Arr::flatten(Arr::wrap($selected_shipping_method)));
                    }
                    break;
            }

            echo json_encode(['action' => 'nextCheckoutStep', 'lastSuccessStep' => '#' . $step]);
        } catch (\Exception $exception) {
            if ($exception instanceof ValidationException) {
                throw $exception;
            }
            log_exception($exception, 'CheckOutController', 'saveCheckoutStep', null, true);
        }
    }

    /**
     * @param $gateway_name
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gatewayPayment($gateway_name)
    {
        try {
            $marketplace = new Marketplace($gateway_name);
            $gateway = $marketplace->gateway;

            //save amount again after additional charge calculations
            $amount = \ShoppingCart::totalAllInstances(false);

            $view = $gateway->getPaymentViewName('marketplace');
            $action = '/checkout/step/select-payment';
            return view($view)->with(compact('gateway', 'action', 'amount'));
        } catch (\Exception $exception) {
            log_exception($exception, 'CartController', 'card', null, true);
        }
    }

    /**
     * @param $gateway
     * @param Request $request
     * @return mixed
     */
    public function gatewayPaymentToken($gateway, Request $request)
    {
        try {
            $params = $request->all();
            $amount = \ShoppingCart::totalAllInstances(false);
            $currency = \Payments::session_currency();
            $marketplace = new Marketplace($gateway);
            $token = $marketplace->createPaymentToken($amount, $currency, $params);
            return $token;
        } catch (\Exception $exception) {
            log_exception($exception, 'CartController', 'generatePaymentToken');
        }
    }


    /**
     * @param $gateway
     * @param Request $request
     * @return false|mixed|string
     */
    public function gatewayCheckPaymentToken($gateway, Request $request)
    {
        $params = $request->all();

        try {
            $marketplace = new Marketplace($gateway);
            return $marketplace->checkPaymentToken($params);
        } catch (\Exception $exception) {
            log_exception($exception, 'CartController', 'checkPaymentToken');
            return json_encode(['status' => 'error', 'error' => $exception->getMessage()]);
        }
    }



        /**
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|mixed
     */
    public function doCheckout(Request $request)
    {
        $checkoutToken = \ShoppingCart::get('default')->getAttribute('checkoutToken');

        $gateway = \ShoppingCart::get('default')->getAttribute('gateway');
        $payment_details = \ShoppingCart::getAttribute('payment_details');

        $order_ids = $request->get('order_ids');

        $orders = [];

        foreach ($order_ids as $order_id) {
            $order = Order::find($order_id);
            $orders[] = $order;
        }

        $user = user() ?? new User();

        $all_cart_items = \ShoppingCart::getAllInstanceItems();

       try {
            if ((count($all_cart_items) > 0) && ($checkoutToken || $payment_details)) {
                if ($gateway == "RedeemPoints") {
                    $payment_status = "paid";
                    $order_status = "processing";
                    $payment_name = "Redeem Points";
                    $amount = \ShoppingCart::totalAllInstances(false);
                    $points_needed = \Referral::getPointsNeedforAmount($amount);
                    $payment_reference = $checkoutToken;

                    \Referral::deductFromBalance($user, $points_needed);
                } else {
                    $payment_gateway = Payment::create($gateway);
                    $payment_name = $payment_gateway->getName();
                    /*if($payment_name=='Paytabs'){
                        $parameters = [
                            'cart_id' => $order_ids[0],
                            'cart_description' => 'PAYMENT FOR ORDERS',
                            'cart_currency' => \Payments::session_currency(),
                            'cart_amount' => \ShoppingCart::totalAllInstances(false),
                           
                                    ];  
               // dd($parameters);
               $marketplace = new Marketplace($payment_name);
               $gateway = $marketplace->gateway;
                        $request = $gateway->getHostedPaymentPage($parameters);  
                       // try {  
                             $response = $request->send();
                       
                     
                            //   } catch (InvalidRequestException $e) {
                             //   print "Something went wrong: " . $e->getMessage() . "\n";
                              // }
                     //   if ($response->isSuccessful()) {
                        //    $data = $response->getData();
                           // return redirectTo($data['redirect_url']);
                       // }
                          
                        //return $response->isSuccessful();

                                }*/
                    if ($payment_gateway->requireRedirect()) {
                        $paymentRedirectURL = URL::temporarySignedRoute('marketplace.public.checkout.redirect',
                            now()->addMinutes(5), [
                                'gateway' => $gateway,
                            ]);

                        return redirectTo($paymentRedirectURL);
                    } else {//if ($payment_gateway->getConfig('offline_management')) {
                        $payment_status = "pending";
                        $order_status = "pending";
                        $payment_reference = $checkoutToken;
                    } /*else {
                        $payment_reference = $this->payGatewayOrders(
                            $orders, $user,
                            [
                                'token' => $checkoutToken,
                                'gateway' => $gateway,
                                'payment_details' => $payment_details
                            ]);
                        $payment_status = "paid";
                        $order_status = "processing";
                    }*/
                }

                MarketplaceFacade::checkoutOrder($orders, $payment_name,
                    $payment_reference, $payment_status, $order_status, $user);
            }

            flash(trans('Marketplace::messages.order.placed'))->success();

            return redirectTo($this->urlPrefix . 'checkout/order-success');
        } catch (\Exception $exception) {
            log_exception($exception, 'CheckOutController', 'doCheckout');
        }

        return redirectTo($this->urlPrefix . 'checkout');
    }


    /**
     * @param $orders
     * @param User $user
     * @param $checkoutDetails
     * @return bool
     * @throws \Exception
     */
    protected function payGatewayOrders($orders, User $user, $checkoutDetails)
    {
        return $this->payGatewayOrdersSend($orders, $user, $checkoutDetails);
    }

    /**
     * @param $orders
     * @param User $user
     * @param $checkoutDetails
     * @return bool
     * @throws \Exception
     */
    protected function payGatewayOrdersSend($orders, User $user, $checkoutDetails)
    {
        $Marketplace = new Marketplace($checkoutDetails['gateway']);

        $payment_reference = $Marketplace->payOrders($orders, $user, $checkoutDetails);
        return $payment_reference;
    }
    public function calculateCartTax($address)
    {
        $cart_items = \ShoppingCart::getAllInstanceItems();

        foreach ($cart_items as $cart_item) {
            $itemHash = $cart_item->getHash();
            $taxes = \Payments::calculateTax($cart_item->id->product, $address);

            $tax_rate = 0;

            foreach ($taxes as $tax) {
                $tax_rate += $tax['rate'];
            }
            \ShoppingCart::updateItem($itemHash, 'tax', $tax_rate);
        }
    }
   
    /**
     * @param Request $request
     * @param $gateway
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function redirectPage(Request $request, $gateway)
    {
        $payment_gateway = Payment::create($gateway);

        $cart_instances = \ShoppingCart::getInstances();

        $paymentPurpose = '';
        //e.g. SUB:RD123456789:30.10;BUS:1023456789:10.54;UJI:SF001:312;

        $transaction_id = 'mp-' . Str::random();

        foreach ($cart_instances as $instance) {
            $cart = \ShoppingCart::setInstance($instance);
            $cart_items_count = $cart->count();

            if ($cart_items_count > 0) {
                if ($cart->getAttribute('order_id')) {
                    $order = Order::find($cart->getAttribute('order_id'));

                    if ($order) {
                        $storeCode = $order->store->code ?: $order->store->id;
                        $order_billing = $order->billing;
                        $order_billing['payment_reference'] = $transaction_id;
                        $order->billing = $order_billing;
                        $order->save();

                        $paymentPurpose .= sprintf("%s:%s:%s;", $storeCode, $order->order_number, $order->amount);
                    }
                }
            }
        }

        $paymentRedirectContent = $payment_gateway->getPaymentRedirectContent([
            'redirectHandler' => '\Corals\Modules\Marketplace\Facades\Marketplace::redirectHandler',
            'paymentPurpose' => Str::limit($paymentPurpose, 140, ''),
            'transactionId' => $transaction_id,
            "amount" => \ShoppingCart::totalAllInstances(false),
            "currency" => \Payments::session_currency(),
        ]);

        $gatewayName = $payment_gateway->getName();

        return view('views.redirect_page')->with(compact('paymentRedirectContent', 'gatewayName'));
    }

    private function preparePayment($gateway_name = null)
    {
        $billing = [];
        $enable_shipping = \ShoppingCart::get('default')->getAttribute('enable_shipping');
        $billing_address = \ShoppingCart::get('default')->getAttribute('billing_address');

        $cart_instances = \ShoppingCart::getInstances();

        $user = user();

        $orders = [];

        foreach ($cart_instances as $instance) {
            $cart = \ShoppingCart::setInstance($instance);

            $cart_items_count = $cart->count();

            if ($cart_items_count > 0) {
                $coupon_code = $cart->getAttribute('coupon_code');

                $billing['billing_address'] = $billing_address;

                $order = null;

                if ($cart->getAttribute('order_id')) {
                    $order = Order::find($cart->getAttribute('order_id'));
                }

                if ($order) {
                    $order->items()->delete();

                    $order->update([
                        'amount' => \Payments::currency_convert($cart->total(false)),
                        'billing' => $billing,
                        'currency' => \Payments::session_currency(),
                        'status' => 'pending',
                    ]);
                } else {
                    $order = Order::create([
                        'amount' => \Payments::currency_convert($cart->total(false)),
                        'currency' => \Payments::session_currency(),
                        'order_number' => \Marketplace::createOrderNumber(),
                        'billing' => $billing,
                        'status' => 'pending',
                        'store_id' => $instance,
                        'user_id' => $user ? $user->id : null,
                    ]);

                    $cart->setAttribute('order_id', $order->id);
                }

                $items = [];

                foreach ($cart->getItems() as $item) {
                    $items[] = [
                        'amount' => \Payments::currency_convert($item->price),
                        'quantity' => $item->qty,
                        'description' => $item->id->product->name . ' - ' . $item->id->code,
                        'sku_code' => $item->id->code,
                        'type' => 'Product',
                        'item_options' => ['product_options' => $item->product_options]
                    ];
                }

                if ($enable_shipping && $cart->getAttribute('selected_shipping_method')) {
                    $shipping_rates = $cart->getAttribute('shipping_rates');
                    $selected_shipping_method = $cart->getAttribute('selected_shipping_method');

                    foreach ($selected_shipping_method as $selected_method) {
                        $methods = explode(';', $selected_method);
                        foreach ($methods as $method) {
                            $selected_shipping = $shipping_rates[$method];
                            $shipping_method = $selected_shipping['shipping_method'];
                            $shipping_description = $selected_shipping['provider'] . ' - ' . $shipping_method . "-" . $selected_shipping['service'] . ' Shipping';

                            $shipping_properties = [
                                'shipping_rule_id' => $selected_shipping['shipping_rule_id'],
                                'shipping_method' => $shipping_method,
                                'provider' => $selected_shipping['provider'],
                                'store_id' => $instance,
                                'product_id' => $selected_shipping['product_id'] ?? '',
                                'product_name' => $selected_shipping['product_name'] ?? '',
                                'shipping_ref_id' => $selected_shipping['shipping_ref_id'] ?? [],
                            ];


                            $items[] = [
                                'amount' => \Payments::currency_convert($selected_shipping['amount'],
                                    $selected_shipping['currency']),
                                'quantity' => $selected_shipping['qty'],
                                'description' => !empty($shipping_properties['product_name']) ?
                                    sprintf("%s [%s]", $shipping_description,
                                        $shipping_properties['product_name']) :
                                    $shipping_description,
                                'sku_code' => '',
                                'type' => 'Shipping',
                                'properties' => $shipping_properties,
                            ];

                            if ($cart->getAttribute('shipping_description')) {
                                $cart->removeFee($cart->getAttribute('shipping_description'));
                            }
                            $cart->addFee($shipping_description, $selected_shipping['amount']);
                            $cart->setAttribute('shipping_description', $shipping_description);
                        }
                    }
                    $order->amount = $cart->total(false);
                    $order->save();
                }

                $order_tax = $cart->taxTotal(false);

                if ($order_tax) {
                    $items[] = [
                        'amount' => \Payments::currency_convert($order_tax),
                        'quantity' => 1,
                        'description' => 'Sales Tax',
                        'sku_code' => 'tax',
                        'type' => 'Tax',
                    ];
                }

                $discount = $cart->totalDiscount(false);

                if ($discount > 0) {
                    $coupon_code;
                    $items[] = [
                        'amount' => -1 * $discount,
                        'quantity' => 1,
                        'description' => 'Discount Coupon ',
                        'sku_code' => $coupon_code,
                        'type' => 'Discount',
                    ];
                }

                $order->items()->createMany($items);

                //save amount again after addons calculations

                $order->amount = \Payments::currency_convert($cart->total(false));

                $order->save();

                $orders[] = $order;
            } elseif ($instance != 'default') {
                $order_id = $cart->getAttribute('order_id');
                if ($order_id) {
                    $order = Order::find($order_id);
                    if ($order) {
                        $order->delete();
                    }
                }
                $cart->destroyCart();
            }
        }

        if (!$gateway_name) {
            $available_gateways = \Payments::getAvailableGateways();
            foreach ($available_gateways as $gateway_key => $available_gateway) {
                $marketplace = new Marketplace($gateway_key);
                if (!$marketplace->gateway->getConfig('support_marketplace')) {
                    unset($available_gateways[$gateway_key]);
                }
            }
            if (count($available_gateways) == 1) {
                $gateway_name = key($available_gateways);
                \ShoppingCart::get('default')->setAttribute('gateway', $gateway_name);
            }
        }


        if ($gateway_name) {
            $marketplace = new Marketplace($gateway_name);
            $gateway = $marketplace->gateway;
        }

        //save amount again after additinal charge calculations
        $amount = \ShoppingCart::totalAllInstances(false);
        $can_redeem = false;

        if (\Settings::get('marketplace_checkout_points_redeem_enable', true)) {
            $points_needed = \Referral::getPointsNeedforAmount($amount);

            $available_points_blanace = \Referral::getPointsBalance(user());

            if ($available_points_blanace > $points_needed) {
                $can_redeem = true;
            }
        }
       // if ($gateway_name == 'Paytabs'){
           // dd($gateway_name );
        
        return null;
      //  }
       // else {
            //dd($gateway_name );
         //   return view('Marketplace::checkout.partials.payment')->with(compact('gateway', 'can_redeem',
        //    'points_needed', 'available_points_blanace', 'amount', 'available_gateways',
       //     'orders'))->render();
       // }
      //  return null;

    }



}
