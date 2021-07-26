<?php

namespace Corals\Modules\Support\Http\Controllers\API;

use Corals\Foundation\Http\Controllers\APIBaseController;
use Corals\Modules\Support\DataTables\CustomerSupportsDataTable;
use Corals\Modules\Support\Http\Requests\CustomerSupportRequest;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Services\CustomerSupportService;
use Corals\Modules\Support\Transformers\API\CustomerSupportPresenter;

class CustomerSupportsController extends APIBaseController
{
    protected $customerSupportService;

    /**
     * CustomerSupportsController constructor.
     * @param CustomerSupportService $customerSupportService
     * @throws \Exception
     */
    public function __construct(CustomerSupportService $customerSupportService)
    {
        $this->customerSupportService = $customerSupportService;
        $this->customerSupportService->setPresenter(new CustomerSupportPresenter());

        parent::__construct();
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupportsDataTable $dataTable
     * @return mixed
     * @throws \Exception
     */
    public function index(CustomerSupportRequest $request, CustomerSupportsDataTable $dataTable)
    {
        $customerSupports = $dataTable->query(new CustomerSupport());

        return $this->customerSupportService->index($customerSupports, $dataTable);
    }

    /**
     * @param CustomerSupportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerSupportRequest $request)
    {
        try {
            $customerSupport = $this->customerSupportService->store($request, CustomerSupport::class);
            return apiResponse($this->customerSupportService->getModelDetails(), trans('Corals::messages.success.created', ['item' => $customerSupport->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CustomerSupportRequest $request, CustomerSupport $customerSupport)
    {
        try {
            return apiResponse($this->customerSupportService->getModelDetails($customerSupport));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param CustomerSupportRequest $request
     * @param CustomerSupport $customerSupport
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomerSupportRequest $request, CustomerSupport $customerSupport)
    {
        try {
            $this->customerSupportService->update($request, $customerSupport);

            return apiResponse($this->customerSupportService->getModelDetails(), trans('Corals::messages.success.updated', ['item' => $customerSupport->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
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

            return apiResponse([], trans('Corals::messages.success.deleted', ['item' => $customerSupport->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }
}