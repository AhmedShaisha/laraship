<?php

namespace Corals\Modules\Quality\Http\Controllers\API;

use Corals\Foundation\Http\Controllers\APIBaseController;
use Corals\Modules\Quality\DataTables\QualityTestsDataTable;
use Corals\Modules\Quality\Http\Requests\QualityTestRequest;
use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Quality\Services\QualityTestService;
use Corals\Modules\Quality\Transformers\API\QualityTestPresenter;

class QualityTestsController extends APIBaseController
{
    protected $qualityTestService;

    /**
     * QualityTestsController constructor.
     * @param QualityTestService $qualityTestService
     * @throws \Exception
     */
    public function __construct(QualityTestService $qualityTestService)
    {
        $this->qualityTestService = $qualityTestService;
        $this->qualityTestService->setPresenter(new QualityTestPresenter());

        parent::__construct();
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTestsDataTable $dataTable
     * @return mixed
     * @throws \Exception
     */
    public function index(QualityTestRequest $request, QualityTestsDataTable $dataTable)
    {
        $qualityTests = $dataTable->query(new QualityTest());

        return $this->qualityTestService->index($qualityTests, $dataTable);
    }

    /**
     * @param QualityTestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(QualityTestRequest $request)
    {
        try {
            $qualityTest = $this->qualityTestService->store($request, QualityTest::class);
            return apiResponse($this->qualityTestService->getModelDetails(), trans('Corals::messages.success.created', ['item' => $qualityTest->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTest $qualityTest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(QualityTestRequest $request, QualityTest $qualityTest)
    {
        try {
            return apiResponse($this->qualityTestService->getModelDetails($qualityTest));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTest $qualityTest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(QualityTestRequest $request, QualityTest $qualityTest)
    {
        try {
            $this->qualityTestService->update($request, $qualityTest);

            return apiResponse($this->qualityTestService->getModelDetails(), trans('Corals::messages.success.updated', ['item' => $qualityTest->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTest $qualityTest
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(QualityTestRequest $request, QualityTest $qualityTest)
    {
        try {
            $this->qualityTestService->destroy($request, $qualityTest);

            return apiResponse([], trans('Corals::messages.success.deleted', ['item' => $qualityTest->name]));
        } catch (\Exception $exception) {
            return apiExceptionResponse($exception);
        }
    }
}