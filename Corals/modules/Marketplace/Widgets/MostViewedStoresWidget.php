<?php

namespace Corals\Modules\Marketplace\Widgets;

use \Corals\Modules\Marketplace\Models\Store;


class MostViewedStoresWidget
{
    public function __construct()
    {
    }

    public function run($args)
    {
        $store = Store::orderBy('visitors_count', 'desc')
        ->take(1)
        ->get()
        ->first();
        
        return ' <!-- small box -->
                <div class="card">
                <div class="small-box bg-aqua card-body">
                    <div class="inner">
                        <h3>' . $store->name.' &nbsp;  '.$store->visitors_count. '</h3>
                        <p>' . trans('Most viwed store') . '</p>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="' . url('marketplace/store/'.$store->slug) . '" class="small-box-footer">
                        ' . trans('Corals::labels.more_info') . '
                    </a>
                </div>
                </div>';
    }
}