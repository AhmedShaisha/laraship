<?php

namespace Corals\Modules\Marketplace\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Marketplace\Models\Product;
//our_change
use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Approval\Models\ApproveRequset;

class ProductTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('marketplace.models.product.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param Product $product
     * @return array
     * @throws \Throwable
     */
    public function transform(Product $product)
    {

        $showUrl = url("{$this->resource_url}/{$product->hashed_id}");


        $productName = $product->name;
        if ($product->is_featured) {
            $productName .= '&nbsp;<i class="fa fa-star text-warning" title="Featured"></i>';
        }
                
               //our_change 
              $actions= [];
             
               $quality_module =\Marketplace::isModuleInstalled('corals-quality');
               
               if( \Marketplace::isModuleInstalled('corals-approval')){
                   
                   $actions['showRequest'] = [
                    'icon' => 'fa fa-fw fa-edit',
                    'href' => url(config('approval.models.approveRequest.resource_url') . '/' . $product->hashed_id.'/showRequest'),
                    'label' =>'view Requests',
                    'class' => 'modal-load modal-xl',
                    'data' => [
                        'title' =>  $product->name
                    ]   
                    ];
                    if (user() && user()->hasPermissionTo('Approval::approveRequest.create')) {
                        //added
                       if($product->admin_approved == 'no request' || $product->admin_approved == 'review'){
                    $actions['approve'] = [
                        'icon' => 'fa fa-fw fa-check',
                        'href' => route("approveRequests.store",['product_id'=>$product->id,'status'=>'pending']),
                        'label' => 'Send for Approval' ,
                        'data' => ['action'=>'post', 'page_action'=>'site_reload','confirmation' => trans('Corals::labels.confirmation.title')]];
                        }//end 
                    }
               
                }
                $levels = [
                    'pending' => 'info',
                    'review' => 'warning ',
                    'accepted' => 'success',
                    'rejected' => 'danger',
                    'no request' => 'secondary',
                    'N/A' => 'secondary',
                
                        ];
                $Approval_status = [
                    'pending' => 'Pending',
                    'review' => 'Send back for update ',
                    'accepted' => 'Accepted',
                    'rejected' => 'Rejected',
                    'no request' => 'No Request',
                
                        ];
             
               if ($quality_module){
                if (!empty($product->qualityTest)){
                    $actions['showStatus'] = [
                        'icon' => 'fa fa-fw fa-eye',
                       'href' => url($this->resource_url . '/' . $product->hashed_id.'/show_qualityTest_status'),
                       'label' =>'show qualityTest status',
                       'class' => 'modal-load  ',
                        'data' => [
                            
                        ]];
                  }
              }
               $actions = array_merge($product->getGatewayActions($product), $actions);
              //end
        

        $transformedArray = [
            'id' => $product->id,
            'checkbox' => $this->generateCheckboxElement($product),
            'image' => '<a href="' . $showUrl . '">' . '<img src="' . $product->image . '" class=" img-responsive" alt="Product Image" style="max-width: 50px;max-height: 50px;"/></a>',
            'name' => '<a href="' . $showUrl . '">' . $productName . '</a>',
            'plain_name' => $productName,
            'price' => $product->price,
            'system_price' => $product->system_price,
            'type' => $product->type == "simple" ? '<i class="fa fa-spoon"></i>' : '<i class="fa fa-sitemap"></i>',
            'brand' => $product->brand ? $product->brand->name : '-',
            'store' => $product->store ? $product->store->name : '-',
            'caption' => $product->caption,
            'shippable' => $product->shipping['enabled'] ? '<i class="fa fa-truck"></i>' : '<i class="fa fa-times"></i>',
            'status' => formatStatusAsLabels($product->status),
            'categories' => formatArrayAsLabels($product->categories->pluck('name'), 'success', '<i class="fa fa-folder-open"></i>'),
            'tags' => generatePopover(formatArrayAsLabels($product->tags->pluck('name'), 'primary', '<i class="fa fa-tags"></i>')),
            'description' => $product->description ? generatePopover($product->description) : '-',
            'gateway_status' => $product->getGatewayStatus(),
            'global_options' => formatArrayAsLabels($product->globalOptions->pluck('label')),
            'variation_options' => formatArrayAsLabels($product->variationOptions->pluck('label'), 'info'),
            'created_at' => format_date($product->created_at),
            'updated_at' => format_date($product->updated_at),
            'action' => $this->actions($product, $product->getGatewayActions($product))
        ];
        //our_change       
        if( \Marketplace::isModuleInstalled('corals-approval')){
                        $transformedArray=array_merge([ 
                            'admin_approved' => formatStatusAsLabels($Approval_status[$product->admin_approved], ['level' => $levels[$product->admin_approved]])
                            //end
                        ], $transformedArray);
                    }
            
                    //our_change
                  
                    if ($quality_module){
                     $transformedArray = \Quality::getQualityTransformedArray($transformedArray, $product, $levels);
                    }//end

        return parent::transformResponse($transformedArray);
    }
}
