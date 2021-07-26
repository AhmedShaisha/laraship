<?php

namespace Corals\Modules\Support\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Support\Models\CustomerSupport;

class CustomerSupportTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('support.models.customerSupport.resource_url');

        parent::__construct();
    }

    /**
     * @param CustomerSupport $customerSupport
     * @return array
     * @throws \Throwable
     */
    public function transform(CustomerSupport $customerSupport)
    {
        $actions = [];

//added
//$actions = array_merge(  $actions);


        $setting_name = strtolower(class_basename($customerSupport->status));
        $status = $customerSupport->status ? $customerSupport->status : \Settings::get($setting_name);
        $show_url = url($this->resource_url . '/' . $customerSupport->hashed_id);
        $levels = [
            
            'answered' => 'success',
            'no response yet' => 'danger',
            
            ];
           
            $actions['showResponse'] = [
                'icon' => 'fa fa-fw fa-edit',
                'href' => url($this->resource_url . '/' . $customerSupport->hashed_id.'/showResponse'),
            
                'label' =>'view Responses',
                'class' => 'modal-load modal-xl',
                'data' => [
                    'title' =>  $customerSupport->title
                ]
        ]; 
           
                
                   
                   
        $transformedArray= [
            'id' => $customerSupport->id,
            'customer_type' => $customerSupport->customer_type,
            'status' => formatStatusAsLabels($status, ['level' => $levels[$status], 'text' => trans('Support::attributes.status_options.' . $status)]),
            'title' => HtmlElement('a', ['href' => route("customerSupports.show",$customerSupport->hashed_id)],$customerSupport->title),
            'created_at' => format_date($customerSupport->created_at),
            'updated_at' => format_date($customerSupport->updated_at),
            'user_id'=> "",//"<a href='" . url('users/' . $customerSupport->user->hashed_id) . "'> {$customerSupport->user->full_name}</a>",
            
            'action' => $this->actions($customerSupport,$actions)
        ];

        return parent::transformResponse($transformedArray);
    }
}