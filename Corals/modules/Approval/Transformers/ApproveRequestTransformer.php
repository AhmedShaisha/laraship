<?php

namespace Corals\Modules\Approval\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Approval\Models\ApproveRequest;

use Corals\Modules\Marketplace\Models\Product;


class ApproveRequestTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('approval.models.approveRequest.resource_url');

        parent::__construct();
    }

    /**
     * @param ApproveRequest $approveRequest
     * @return array
     * @throws \Throwable
     */
    public function transform(ApproveRequest $approveRequest)
    {
       

        $show_url = url($this->resource_url . '/' . $approveRequest->hashed_id);

       //add levels by wafa
       
       $levels = [
        'pending' => 'info',
        'review' => 'warning ',
        'accepted' => 'success',
        'rejected' => 'danger',
            ];
            $Approval_status = [
                'pending' => 'Pending',
                'review' => 'Send back for update ',
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
                'no request' => 'No Request',
            
                    ];
                    $setting_name = strtolower(class_basename($approveRequest->status));
                    $status = $approveRequest->status ? $approveRequest->status : \Settings::get($setting_name);
           
            if($approveRequest->status=="pending"){
        $transformedArray= [
            'id' => $approveRequest->id,

            //added new data
            'name' => HtmlElement('a', ['href' => $approveRequest->getShowURL()], $approveRequest->name),
            'product_id' => HtmlElement('a', ['href' =>
             route("marketplace.products.show",$approveRequest->product->hashed_id)],
             $approveRequest->product->name),
           
            'note'=>$approveRequest->note,
            'status' => formatStatusAsLabels($status, ['level' => $levels[$status], 'text' => trans('Approval::attributes.status_options.' . $status)]),
            
            'created_at' => format_date($approveRequest->created_at),
            'updated_at' => format_date($approveRequest->updated_at),

      
            'action' => $this->actions($approveRequest),
        ];
    }
    else {
        $transformedArray= [
            'id' => $approveRequest->id,

            //added new data
            'name' => HtmlElement('a', ['href' => $approveRequest->getShowURL()], $approveRequest->name),
            'product_id' => HtmlElement('a', ['href' =>
             route("marketplace.products.show",$approveRequest->product->hashed_id)],
             $approveRequest->product->name),
           
             'note'=>$approveRequest->note,
            'status' => formatStatusAsLabels($Approval_status[$approveRequest->status], ['level' => $levels[$approveRequest->status], 'text' => trans('Approval::attributes.status_options.' . $status)]),
            
            'created_at' => format_date($approveRequest->created_at),
            'updated_at' => format_date($approveRequest->updated_at),

      
            //'action' => $this->actions($approveRequest),
        ]; 
    }

        return parent::transformResponse($transformedArray);
    }
}