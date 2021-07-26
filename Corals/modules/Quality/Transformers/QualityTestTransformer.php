<?php

namespace Corals\Modules\Quality\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Quality\Models\QualityTest;

class QualityTestTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('quality.models.qualityTest.resource_url');

        parent::__construct();
    }

    /**
     * @param QualityTest $qualityTest
     * @return array
     * @throws \Throwable
     */
    public function transform(QualityTest $qualityTest)
    {
        $show_url = url($this->resource_url . '/' . $qualityTest->hashed_id);

       // $status = $qualityTest->status ;
        $levels = [
            'pending' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger',
            'review' =>  'warning',
            ];
        
        $setting_name = strtolower(class_basename($qualityTest->status));
        $status = $qualityTest->status ? $qualityTest->status : \Settings::get($setting_name);
                
       // if ($qualityTest->status=="pending" || $qualityTest->status=="review") {
            $transformedArray= [
            'id' => $qualityTest->id,
            'code' => HtmlElement('a', ['href' => $qualityTest->getShowURL()], $qualityTest->code),
            /*'order_number' => HtmlElement(
                'a',
                ['href' =>
            route("marketplace.orders.show", $qualityTest->order->hashed_id)],
                $qualityTest->order->order_number
            ),*/
           
            'status' => formatStatusAsLabels($status, ['level' => $levels[$status], 'text' => trans('Quality::attributes.status_options.' . $status)]),
           // 'shipping'=>$qualityTest->shipping,
           // 'note'=> $qualityTest->note,
            'user_id'=> "<a href='" . url('users/' . $qualityTest->user->hashed_id) . "'> {$qualityTest->user->full_name}</a>",
            'product_id' =>"<a href='" . url('marketplace/products/' . $qualityTest->product->hashed_id) . "'> {$qualityTest->product->name}</a>",

            'created_at' => format_date($qualityTest->created_at),
            'updated_at' => format_date($qualityTest->updated_at),
            'action' => $this->actions($qualityTest)
        ];
        /*}else{
            $transformedArray= [
                'id' => $qualityTest->id,
                'code' => HtmlElement('a', ['href' => $qualityTest->getShowURL()], $qualityTest->code),
               /*'order_number' => HtmlElement(
                    'a',
                    ['href' =>
                route("marketplace.orders.show", $qualityTest->order->hashed_id)],
                    $qualityTest->order->order_number
                ),
               
                'status' => formatStatusAsLabels($status, ['level' => $levels[$status], 'text' => trans('Quality::attributes.status_options.' . $status)]),
                //'shipping'=>$qualityTest->shipping,
                //'note'=>$qualityTest->note,
                'user_id'=> "<a href='" . url('users/' . $qualityTest->user->hashed_id) . "'> {$qualityTest->user->full_name}</a>",
                'product_id' =>"<a href='" . url('products/' . $qualityTest->product->hashed_id) . "'> {$qualityTest->product->name}</a>",
               
    
                'created_at' => format_date($qualityTest->created_at),
                'updated_at' => format_date($qualityTest->updated_at),
                //'action' => $this->actions($qualityTest)
            ];

        }*/


        return parent::transformResponse($transformedArray);
    }
}