<?php

namespace Corals\Modules\Marketplace\Widgets;

use \Corals\Modules\Marketplace\Models\Product;


class MostViewedProductsWidget
{
    public function __construct()
    {
    }

    public function run($args)
    {
        $product = Product::orderBy('visitors_count', 'desc')
        ->take(1)
        ->get()
        ->first();
       
        return ' <!-- small box -->
                <div class="card">
                <div class="small-box bg-green card-body">
                    <div class="inner">
                        <h3>' . $product->name.' &nbsp;  '.$product->visitors_count. '</h3>
                       
                        <p>' . trans('Most viwed product') . '</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <a href="' . url('marketplace/shop/'.$product->slug) . '" class="small-box-footer">
                        ' . trans('Corals::labels.more_info') . '
                    </a>
                </div>
                </div>';
    }
}