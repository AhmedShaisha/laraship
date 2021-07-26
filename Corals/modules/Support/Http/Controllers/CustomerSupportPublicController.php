<?php

namespace Corals\Modules\Support\Http\Controllers;

use Corals\Modules\CMS\Traits\SEOTools;
use Corals\Foundation\Http\Controllers\PublicBaseController;
//use Corals\Modules\CMS\Http\Controllers\FrontendController;
use Corals\Modules\Marketplace\Facades\Shop;
use Corals\Modules\Marketplace\Models\Product;
use Corals\Modules\Marketplace\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\CMS\Models\Content;
use Corals\Modules\CMS\Facades\CMS;
use Corals\Modules\Support\Services\CustomerSupportService;

class CustomerSupportPublicController extends PublicBaseController
{
    use SEOTools;
    protected $customerSupportService;

    public function __construct(CustomerSupportService $customerSupportService)
    {
        $this->customerSupportService = $customerSupportService;

       // $this->resource_url = config('support.models.customerSupport.resource_url');

       // $this->title = trans('Support::module.customerSupport.title');
      //  $this->title_singular = trans('Support::module.customerSupport.title_singular');

        parent::__construct();
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $this->contentQuery = Content::query()->published();

       /* if (!$ignoreInternal) {
            $this->contentQuery->internal($this->internalState);
        }*/
        $item = Content::query()->published()->where('slug', \Str::slug('questions'))->first();
        $item = $item->toContentType();
        $title = null;
        $featured_image = CMS::getContentFeaturedImage($item);
        $view = '/support';
        $questions=CustomerSupport::paginate(config('cms.frontend.page_limit', 10));
        $faq= $item;
        return view($view)->with(compact('faq','title','questions','item'));
        Content::query()->published();
        $seoItem = [
            'title' => $item->title,
            'meta_description' => $item->meta_description,
            'url' => $url ?: url($item->slug),
            'type' => " ",
            'image' => $featured_image ?? \Settings::get('site_logo'),
            'meta_keywords' => $item->meta_keywords
        ];
        $this->setSEO((object)$seoItem);
        
      
        return view($view)->with(compact('faq', 'faqs', 'title'));
    }

       /**
     * @param Request $request
     * @return $this
     */
    public function create(Request $request)
    {
        $customerSupport = new CustomerSupport();

     return view('ask')->with(compact('customerSupport'));   
    }
      /**
     * @param CustomerSupportRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $customerSupport = $this->customerSupportService->store($request, CustomerSupport::class);

            flash(trans('Corals::messages.success.created', ['item' => $this->title_singular]))->success();
            event('notifications.support.customerSupport_created', ['customerSupport' => $customerSupport]);

        } catch (\Exception $exception) {
            log_exception($exception, CustomerSupport::class, 'store');
        }
                event('notifications.qualityTest.product_accept.qualityTest', ['order' => $qualityTest->order]);

        return redirectTo(\Str::slug('questions'));
    }

}