<?php

namespace Corals\Modules\Support\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;

use Corals\Modules\Support\Http\Requests\ResponseRequest;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Models\Response;


class ResponsesController extends BaseController
{
    

    public function __construct(ResponseRequest $request)
    {
        $this->resource_url = config('support.models.response.resource_url');

       

        parent::__construct();
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupportsDataTable $dataTable
     * @return mixed
     */
    public function index(ResponseRequest $request)
    {
        $responses = Response::latest()->get();

        return view('Support::responses.index', compact('responses'));
       
    }

    /**
     * @param CustomerSupportRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ResponseRequest $request)
   
    {   $response = new Response();

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.create_title', ['title' => $this->title_singular])]);

        return view('Support::responses.create_edit')->with(compact('response'));
    }

    /**
     * @param ResponseRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ResponseRequest $request)
    {
        $validated = $request->validate([
           
            'response' => 'required|string|min:5|max:2000',
            ]);

           
            //On left field name in DB and on right field name in Form/view
            $response->response = $request->input('response');
           
            $response->save();
           
            
          return redirectTo($this->resource_url);
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ResponseRequest $request)
    {
        
        return view('Support::responses.show')->with(compact('response'));
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ResponseRequest $request)
    {
        $this->setViewSharedData(['title_singular' => trans('Corals::labels.update_title', ['title' => $customerSupport->getIdentifier()])]);

        return view('Support::responses.create_edit')->with(compact('response'));
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ResponseRequest $request)
    {
       
        return redirectTo($this->resource_url);
    }

    /**
     * @param ResponsetRequest $request
     * @param Response $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ResponseRequest $request)
    {
       

        
    }


    
}