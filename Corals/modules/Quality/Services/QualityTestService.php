<?php

namespace Corals\Modules\Quality\Services;


use Corals\Foundation\Services\BaseServiceClass;
use Corals\Modules\Marketplace\Models\OrderItem;


class QualityTestService extends BaseServiceClass
{
  
     public function canceledProductOrder(OrderItem $order_item){
        $order_item = OrderItem::find($order_item->id);
        $order =  $order_item->order;
        $product = $order_item->qualityTest->product;

        //here put refund 

        $order_item->update(['quantity' => 0,'amount'=> 0]);
        $order_item->qualityTest->update(['status' => 'rejected']);      
        event('notifications.marketplace.order.updated', ['order' => $order]);
        event('notifications.qualityTest.warning_seller', ['user'=>$order->store->user,'order' => $order]); 
        event('notifications.qualityTest.buyer_apology', ['user'=>$order->user,'order' => $order]);

    }
   
}