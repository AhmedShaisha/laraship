<?php

namespace Corals\Modules\Approval\Http\Controllers\API;

use Corals\Foundation\Http\Controllers\APIBaseController;
use Corals\Modules\Approval\DataTables\ApproveRequestsDataTable;
use Corals\Modules\Approval\Http\Requests\ApproveRequestRequest;
use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\Modules\Approval\Services\ApproveRequestService;
use Corals\Modules\Approval\Transformers\API\ApproveRequestPresenter;

class ApproveRequestsController extends APIBaseController
{
    protected $approveRequestService;

    /**
     * ApproveRequestsController constructor.
     * @param ApproveRequestService $approveRequestService
     * @throws \Exception
     */
    public function __construct(ApproveRequestService $approveRequestService)
    {
        $this->approveRequestService = $approveRequestService;
        $this->approveRequestService->setPresenter(new ApproveRequestPresenter());

        parent::__construct();
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequestsDataTable $dataTable
     * @return mixed
     * @throws \Exception
     */
    public function index(ApproveRequestRequest $request, ApproveRequestsDataTable $dataTable)
    {
        $approveRequests = $dataTable->query(new ApproveRequest());

        return $this->approveRequestService->index($approveRequests, $dataTable);
    }

    /**
     * @param ApproveRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApproveRequestRequest $request)
    {
        try {
            $approveRequest = $this->approveRequestService->store($request, ApproveRequest::class);
            return apiResponse($this->approveRequestService->getModelDetails(), trans('Corals::messages.success.created', ['item' => $approveRequest->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequest $approveRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ApproveRequestRequest $request, ApproveRequest $approveRequest)
    {
        try {
            return apiResponse($this->approveRequestService->getModelDetails($approveRequest));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param ApproveRequestRequest $request
     * @param ApproveRequest $approveRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ApproveRequestRequest $request, ApproveRequest $approveRequest)
    {
        try {
            $this->approveRequestService->update($request, $approveRequest);

            return apiResponse($this->approveRequestService->getModelDetails(), trans('Corals::messages.success.updated', ['item' => $approveRequest->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
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

            return apiResponse([], trans('Corals::messages.success.deleted', ['item' => $approveRequest->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }
}
