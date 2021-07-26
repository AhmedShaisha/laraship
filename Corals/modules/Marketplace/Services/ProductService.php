<?php

namespace Corals\Modules\Marketplace\Services;

use Corals\Foundation\Services\BaseServiceClass;
use Corals\Modules\Marketplace\Classes\Marketplace;
use Corals\Modules\Marketplace\Models\Tag;
use Corals\Modules\Marketplace\Traits\DownloadableController;
//our_change
use Corals\Modules\Marketplace\Models\Category;
use Corals\Modules\Marketplace\Models\SKU;

class ProductService extends BaseServiceClass
{
    use DownloadableController;

    public $sku_attributes = ['regular_price', 'sale_price', 'code', 'inventory', 'inventory_value', 'allowed_quantity'];
    public $skipParameters = ['global_options', 'variation_options', 'create_gateway_product', 'tax_classes', 'categories', 'tags', 'posts', 'private_content_pages', 'downloads_enabled', 'downloads', 'cleared_downloads', 'external', 'price_per_classification','options'];
     
    public function getRequestData($request)
    {
        $excludedRequestParams = array_merge($this->skipParameters, $this->sku_attributes);

        if (is_array($request)) {
            $data = \Arr::except($request, $excludedRequestParams);
        } else {
            $data = $request->except($excludedRequestParams);
        }

        $data = \Store::setStoreData($data);

        $data = $this->setShippingData($data);

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function setShippingData($data)
    {
        if (!isset($data['shipping']['enabled'])) {
            $data['shipping']['enabled'] = 0;
        }

        return $data;
    }

    protected function postStoreUpdate($request, $additionalData)
    {
        $product = $this->model;
                
        if ($product->type == "simple") {
            $sku_data = $request->only(array_merge($this->sku_attributes, ['status']));

            if ($product->sku->first()) {
                $product->sku->first()->update($sku_data);
            } else {
                //our_change 
                $sku_data['code']=$product->id;
                //end
                $product->sku()->create($sku_data);
            }
        }

        $attributes = [];

        foreach ($request->get('global_options', []) as $option) {
            $attributes[$option] = [
                'sku_level' => false,
            ];
        }

        if ($product->type == "variable") {
            foreach ($request->get('variation_options', []) as $option) {
                $attributes[$option] = [
                    'sku_level' => true,
                ];
            }
        }

        $product->attributes()->sync($attributes);
          //our_change
        $categories = $this->getCategories($request);
        $product->categories()->sync($categories);
        //$product->categories()->sync($request->get('categories', []));
        $product->tax_classes()->sync($request->get('tax_classes', []));

        $tags = $this->getTags($request);

        $product->tags()->sync($tags);

        $product->posts()->sync($request->get('posts', []));

        $this->handleDownloads($request, $product);
        //our_change
        //  if($product->sku->first()){
        $this->createOptions($request, $product);
       // }//end
        
        $product->indexRecord();
    }

    /**
     * @param $request
     * @return array
     */
    protected function getTags($request)
    {
        $tags = [];

        $requestTags = $request->get('tags', []);

        foreach ($requestTags as $tag) {
            if (is_numeric($tag)) {
                array_push($tags, $tag);
            } else {
                try {
                    $newTag = Tag::create([
                        'name' => $tag,
                        'slug' => \Str::slug($tag)
                    ]);

                    array_push($tags, $newTag->id);
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        return $tags;
    }

    /**
     * @param $request
     * @param $model
     * @throws \Exception
     */
    public function destroy($request, $model)
    {
        $product = $model;

        $gateways = \Payments::getAvailableGateways();

        foreach ($gateways as $gateway => $gateway_title) {
            $Marketplace = new Marketplace($gateway);
            if (!$Marketplace->gateway->getConfig('manage_remote_product')) {
                continue;
            }

            $Marketplace->deleteProduct($product);
            $product->setGatewayStatus($this->gateway->getName(), 'DELETED', null);
        }

        $product->clearMediaCollection('product-downloads');
        $product->clearMediaCollection($product->galleryMediaCollection);

        $product->delete();
        $product->unIndexRecord();
    }
    //our_change 
    protected function getCategories($request)
    {
        
        $categories_ids=$request->get('categories', []);
            foreach($categories_ids as $category_id){
                $category=Category::find($category_id);
                $parent_id=$category->parent_id;
                while($parent_id){
                    if (!in_array($parent_id, $categories_ids)) {
                        array_push($categories_ids,$parent_id);
                    }
                    $parent_category=Category::find($parent_id);
                    $parent_id=$parent_category->parent_id;
                }
            }

        return $categories_ids;
    }

    protected function createOptions($request, $product)
    {
        $sku = SKU::where('product_id',$product->id)->first();
        //$sku = $product->sku->first();
        $sku->options()->delete();
        
        $options = [];
    
        if (isset($request->options)) {
            foreach ($request->options as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $value_option) {
                        $options[] = [
                            'attribute_id' => $key,
                            'value' => $value_option
                        ];
                    }
                } else {
                    $options[] = [
                        'attribute_id' => $key,
                        'value' => $value
                    ];
                }
            }
  
            $sku->options()->createMany($options);
        }
    }
}
