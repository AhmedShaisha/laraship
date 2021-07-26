<?php

namespace Corals\Modules\Quality\Classes;

use Corals\Modules\Marketplace\Models\Attribute;
use Corals\Modules\Marketplace\Models\Order;
use Corals\Modules\Marketplace\Models\Product;
use Corals\Modules\Marketplace\Models\SKU;
use Corals\Modules\Quality\Models\QualityTest;
use Corals\User\Models\User;

class Quality
{
    /**
     * Quality constructor.
     */
    public function __construct()
    {
    }
    public function getusersList()
    {
        $uesrs = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'qualityassistant');
        })->get();

        return $uesrs;
    }

    public function getQualityColumns($columns, $view = null)
    {
        $columns['quality_Test'] = ['title' => trans('Quality::labels.show_qualityTest'), 'orderable' => false, 'searchable' => false];

        return $columns;
    }

    public function getQualityTransformedArray($transformedArray, $product, $levels = [])
    {

        if (!empty($product->qualityTest)) {

            $status = $product->qualityTest->status;
            $transformedArray['quality_Test'] = HtmlElement('a', ['href' => url(config('marketplace.models.product.resource_url') . '/' . $product->hashed_id . '/show_qualityTest_status'), 'class' => 'modal-load '],
                formatStatusAsLabels($status, ['level' => $levels[$status], 'text' => trans('Quality::attributes.status_options.' . $status)]));

        } else {
            $status = 'N/A';
            $transformedArray['quality_Test'] = HtmlElement('a', ['href' => url(config('marketplace.models.product.resource_url') . '/' . $product->hashed_id . '/show_qualityTest_status'), 'class' => 'modal-load '],
                formatStatusAsLabels($status, ['level' => $levels[$status], 'text' => trans($status)]));
        }

        return $transformedArray;
    }

    public function is_QualityTest($attributes)
    {
        if (empty($attributes)) {
            return false;
        }

        foreach ($attributes as $attribute_id => $attribute_value) {

            if (Attribute::find($attribute_id)->where('code', 'order authentication')) {

                if ($attribute_value) {
                    return true;
                } else {return false;}

            }

        } //end foreach
    }

    public function generateProductsQualityTest($order)
    {

        foreach ($order->items as $order_item) {
            if ($order_item->type == 'Product') {

                $sku = $order_item->sku;

                $quality_users = \Quality::getusersList();
                $quality_user;
                if (!$quality_users->isEmpty()) {
                    $quality_user = $quality_users->pluck('id')->random(1)->first();

                } else {
                    $quality_user = null;

                }

                $order = $order_item->order;
                $product = $sku->product;

                $is_qualityTest = \Quality::is_QualityTest($order_item->item_options['product_options']);
                
                if (!$product->qualityTest && $is_qualityTest) {

                    $qualityTest = QualityTest::create([
                        'code' => QualityTest::getCode('QUA'),
                        'order_id' => $order->id,
                        'order_item_id' => $order_item->id,
                        'product_id' => $product->id,
                        'user_id' => $quality_user,
                        'shipping' => ['address' => \Quality::getShippingAddress($order)],

                    ]);
                    event('notifications.qualityTest.qualityTest_created', ['order' => $order]);
                    event('notifications.qualityTest.shipping_address.qualityTest', ['order' => $order, 'qualityTest' => $qualityTest]);
                    if ($quality_user) {
                        event('notifications.qualityTest.responsible_qualityTest', ['user' => $qualityTest->user]);
                    }
                }

            }
        }

    } // create for quality test

    public function getBuyerAddress($order)
    {
        $buyer_address = $order->billing['billing_address']['first_name'] . " " .
        $order->billing['billing_address']['last_name'] . '<br /> Adress:' .
        $order->billing['billing_address']['address_1'] . '<br />' .
        $order->billing['billing_address']['city'] . " " .
        $order->billing['billing_address']['state'] . " " .
        $order->billing['billing_address']['country'] . " " . 'zip' . " " .
        $order->billing['billing_address']['zip'];

        return $buyer_address;
    }

    public function getShippingAddress($order)
    {
        $shipping_method = \Settings::get('quality_shipping_shipping_method');
        if ($shipping_method == 'Ship to Warehouse') {
            $warehouse_address = \Settings::get('warehouse_address');
            return $warehouse_address;
        } else {
            $buyer_address = \Quality::getBuyerAddress($order);
            return $buyer_address;
        }
    }

}
