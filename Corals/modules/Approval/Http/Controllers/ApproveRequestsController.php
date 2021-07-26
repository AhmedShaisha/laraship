<?php

namespace Corals\Modules\Approval\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Modules\Approval\DataTables\ApproveRequestsDataTable;
use Corals\Modules\Approval\Http\Requests\ApproveRequestRequest;
use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\Modules\Approval\Services\ApproveRequestService;
use Corals\Modules\Marketplace\Models\Product;
use Corals\Modules\Marketplace\Services\ProductService;



class ApproveRequestsController extends BaseController
{
    protected $approveRequestService;

    public function __construct(ApproveRequestService $approveRequestService)
    {    
        
        $this->approveRequestService = $approveRequestService;

        $this->resource_url = config('approval.models.approveRequest.resource_url');

        $this->title = trans('Approval::module.approveRequest.title');
        $this->title_singular = trans('Approval::module.approveRequest.title_singular');
        

        parent::__construct();
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequestsDataTable $dataTable
     * @return mixed
     */
    public function index(ApproveRequestRequest $request, ApproveRequestsDataTable $dataTable)
    {  //added by wafa
        $this->setViewSharedData(['hideCreate' => true]); //end   
        return $dataTable->render('Approval::approveRequests.index');
    }

    /**
     * @param ApproveRequestRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ApproveRequestRequest $request)
    {
        $approveRequest = new ApproveRequest();

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.create_title', ['title' => $this->title_singular])]);

        return view('Approval::approveRequests.create_edit')->with(compact('approveRequest'));
    }

    /**
     * @param ApproveRequestRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ApproveRequestRequest $request)
    {
        try {
            $approveRequest = $this->approveRequestService->store($request, ApproveRequest::class);
            if($approveRequest){
                $product = $approveRequest->product;
                $product->update(['admin_approved'=>$request->status]);   
            }

            flash(trans('Corals::messages.success.created', ['item' => $this->title_singular]))->success();
            event('notifications.approval.new_request.created', ['product' => $product]);
        } catch (\Exception $exception) {
            log_exception($exception, ApproveRequest::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequest $approveRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ApproveRequestRequest $request, ApproveRequest $approveRequest)
    {
  $this->setViewSharedData(['title_singular' => trans('Corals::labels.show_title', ['title' => $approveRequest->getIdentifier()]),
                       'showModel' => $approveRequest,
                   ]);
        return view('Approval::approveRequests.show')->with(compact('approveRequest'));
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequest $approveRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ApproveRequestRequest $request, ApproveRequest $approveRequest)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.update_title', ['title' => $approveRequest->getIdentifier()])]);

        return view('Approval::approveRequests.create_edit')->with(compact('approveRequest'));
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequest $approveRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ApproveRequestRequest $request, ApproveRequest $approveRequest)
    {  
     
        try { 
            
                $this->approveRequestService->update($request, $approveRequest);
                //added
              
                $product = $approveRequest->product;
                $product->update(['admin_approved'=>$request->status]);
            
            //end
            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, ApproveRequest::class, 'update');
        }
       // return redirec()->route('marketplace.products.update',$product);
        return redirectTo($this->resource_url);

    }


    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequest $approveRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ApproveRequestRequest $request, ApproveRequest $approveRequest)
    {
        try {
            $this->approveRequestService->destroy($request, $approveRequest);

            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, ApproveRequest::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    
    public function showRequest(Product $Product )
    {
        $product=Product::find($Product->id);
        $approveRequests =$product->approveRequests;
        $approveRequests= $approveRequests->sortByDesc('created_at');
       
        return view('Approval::approveRequests.showRequest',['approveRequests' =>  $approveRequests ]);
    }

    
     
        
}

