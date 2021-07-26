<?php

namespace Corals\Modules\Support\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Modules\Support\DataTables\CustomerSupportsDataTable;
use Corals\Modules\Support\Http\Requests\CustomerSupportRequest;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Models\Response;
use Corals\Modules\Marketplace\Models\Order;
//use Corals\Modules\Support\Http\Controllers\Request;
use Corals\Modules\Support\Services\CustomerSupportService;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
class CustomerSupportsController extends BaseController
{
    protected $customerSupportService;

    public function __construct(CustomerSupportService $customerSupportService)
    {
        $this->customerSupportService = $customerSupportService;

        $this->resource_url = config('support.models.customerSupport.resource_url');

        $this->title = trans('Support::module.customerSupport.title');
        $this->title_singular = trans('Support::module.customerSupport.title_singular');

        parent::__construct();
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupportsDataTable $dataTable
     * @return mixed
     */
    public function index(CustomerSupportRequest $request, CustomerSupportsDataTable $dataTable)
    {
        return $dataTable->render('Support::customerSupports.index');
    }

    /**
     * @param CustomerSupportRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CustomerSupportRequest $request)
    {
        $customerSupport = new CustomerSupport();
        
        //dd($request);
       $order_id= $request->input('order_id');
        

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.create_title', ['title' => $this->title_singular])]);

        return view('Support::customerSupports.create_edit')->with(compact('customerSupport','order_id'));
    }

    /**
     * @param CustomerSupportRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CustomerSupportRequest $request)
    {
        try {
            $customerSupport = $this->customerSupportService->store($request, CustomerSupport::class);

            flash(trans('Corals::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, CustomerSupport::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(CustomerSupportRequest $request, CustomerSupport $customerSupport, Response $response)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.show_title', ['title' => $customerSupport->getIdentifier()])]);

        $this->setViewSharedData(['comment_url' => $this->resource_url . '/' . $customerSupport->hashed_id . '/comment']);
       $response = new Response();
        return view('Support::customerSupports.show')->with(compact('customerSupport','response'));
    }

    public function comment( CustomerSupportRequest $request, $customerSupport_hashedid)
    {
      
        $response = new Response();
                 $response->response = $request->input('response');
                    $response->customer_Support_id  = hashids_decode( $customerSupport_hashedid);
                //  $response->user_id =  $request->input('customer_Support_id'); 

                    $response->save();
                //    event('notifications.support.response_created',['user' => $response->created_by]);
                 return redirectTo($this->resource_url."/".$customerSupport_hashedid);
            
         return redirectTo($this->resource_url."/".$customerSupport_hashedid);
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CustomerSupportRequest $request, CustomerSupport $customerSupport)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.update_title', ['title' => $customerSupport->getIdentifier()])]);

        return view('Support::customerSupports.create_edit')->with(compact('customerSupport'));
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CustomerSupportRequest $request, CustomerSupport $customerSupport)
    {
        try {
            $this->customerSupportService->update($request, $customerSupport);

            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, CustomerSupport::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CustomerSupportRequest $request, CustomerSupport $customerSupport)
    {
        try {
            $this->customerSupportService->destroy($request, $customerSupport);

            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, CustomerSupport::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    
    
    
 /**
     * @param Request $request
     * @param $hashed_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(Request $request, $hashed_id)
    {
        //if (!user()->hasPermissionTo('Marketplace::product.update')) {
        //    abort(403);
        //}

        $id = hashids_decode($hashed_id);

        $media = Media::findOrfail($id);

        return response()->download( public_path().$media->getUrl());
    }

    
}