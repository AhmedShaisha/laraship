<?php

namespace Corals\Modules\Quality\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Modules\Marketplace\Models\Order;
use Corals\Modules\Marketplace\Models\OrderItem;
use Corals\Modules\Marketplace\Models\Product;
use Corals\Modules\Quality\DataTables\QualityTestsDataTable;
use Corals\Modules\Quality\Http\Requests\QualityTestRequest;
use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Quality\Services\QualityTestService;
use Corals\User\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class QualityTestsController extends BaseController
{
    protected $qualityTestService;
    protected $shipping;

    public function __construct(QualityTestService $qualityTestService)
    {
        $this->qualityTestService = $qualityTestService;

        $this->resource_url = config('quality.models.qualityTest.resource_url');

        $this->title = trans('Quality::module.qualityTest.title');
        $this->title_singular = trans('Quality::module.qualityTest.title_singular');

        parent::__construct();
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTestsDataTable $dataTable
     * @return mixed
     */
    public function index(QualityTestRequest $request, QualityTestsDataTable $dataTable)
    {
        $this->setViewSharedData(['hideCreate' => true]); //
        return $dataTable->render('Quality::qualityTests.index');
    }

    /**
     * @param QualityTestRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(QualityTestRequest $request)
    {
        $qualityTest = new QualityTest();

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.create_title', ['title' => $this->title_singular])]);

        return view('Quality::qualityTests.create_edit')->with(compact('qualityTest'));
    }

    /**
     * @param QualityTestRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(QualityTestRequest $request)
    {
        try {
            $qualityTest = $this->qualityTestService->store($request, QualityTest::class);

            flash(trans('Corals::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, QualityTest::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTest $qualityTest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(QualityTestRequest $request, QualityTest $qualityTest)
    {
           $this->setViewSharedData(['title_singular' => trans('Corals::labels.show_title', ['title' => $qualityTest->getIdentifier()]),
                        'showModel' => $qualityTest,
                   ]);
        return view('Quality::qualityTests.show')->with(compact('qualityTest'));
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTest $qualityTest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(QualityTestRequest $request, QualityTest $qualityTest)
    {
        $files = $qualityTest->getMedia('files') ?? [];

        $this->setViewSharedData(['title_singular' => trans('Corals::labels.update_title', ['title' => $qualityTest->getIdentifier()])]);

        return view('Quality::qualityTests.create_edit')->with(compact('qualityTest', 'files'));
    }

    /**
     * @param QualityTestRequest $request
     * @param QualityTest $qualityTest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(QualityTestRequest $request, QualityTest $qualityTest)
    {
        $status = $request->status;
        $order_item = $qualityTest->item;
        $user = $qualityTest->user->id;
        $data = $request->all();
        $shipping = $qualityTest->shipping ?? [];

        try {
            if ($request->has('shipping')) {
                $shipping = array_replace_recursive($shipping, $data['shipping']);
            }
            $this->qualityTestService->update($request->except(['file']), $qualityTest);
            //check if request has file and status accepted
            if ($status == 'accepted') {
                if ($request->hasFile('file')) {
                    $this->validate($request, [
                        'file' => 'required|mimes:doc,docx,pdf|max:' . maxUploadFileSize(),
                    ]);
                    $qualityTest->addMedia($request->file('file'))->withCustomProperties(['root' => 'user_' . user()->hashed_id])->toMediaCollection('files');
                }

                event('notifications.qualityTest.product_accept.qualityTest', ['order' => $qualityTest->order]);
                event('notifications.qualityTest.shipping_Buyer', ['order' => $qualityTest->order]);
            }

            if ($status == 'rejected') {
                $this->qualityTestService->canceledProductOrder($order_item);
            }

            if ($status == 'review') {
                event('notifications.qualityTest.warning_seller', ['order' => $qualityTest->order, 'user' => $qualityTest->order->store->user]);
            }

            if ($user != $request->user_id) {
                event('notifications.qualityTest.responsible_qualityTest', ['user' => $qualityTest->user, 'qualityTest' => $qualityTest]);
                $user = User::find($request->user_id);
                event('notifications.qualityTest.responsible_qualityTest', ['user' => $user, 'qualityTest' => $qualityTest]);

            }

            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, QualityTest::class, 'update');
        }

        return redirectTo($this->resource_url);
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

            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, QualityTest::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    //update Shipping function
    public function updateShipping(Request $request, QualityTest $qualityTest)
    {$this->validate($request, ['shipping.tracking_number' => 'required']);

        $data = $request->all();
        $shipping = $qualityTest->shipping ?? [];

        try {

            if ($request->has('shipping')) {
                $shipping = array_replace_recursive($shipping, $data['shipping']);

            }
            $qualityTest->update(['shipping' => $shipping]);

            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.updated', ['item' => $this->title_singular])];
            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();

        } catch (\Exception $exception) {
            log_exception($exception, QualityTest::class, 'update');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }
        return response()->json($message);

    }

    public function downloadFile(Request $request, $hashed_id)
    {
        if (!user()->hasPermissionTo('Quality::qualityTest.update')) {
            abort(403);
        }

        $id = hashids_decode($hashed_id);

        $media = Media::findOrfail($id);

        return response()->download(storage_path($media->getUrl()));
    }
    //added
    /**
     *QualityStatus for seller form
     **/
    public function showQualityStatus(Product $product)
    {
        $product = Product::find($product->id);
        $qualityTest = $product->qualityTest;
        $order_item = $qualityTest->item;

        return view('Quality::qualityTests.show_qualityTest_status')->with(compact('qualityTest', 'product', 'order_item'));
    }

    //QualityStatus form  Agreement for buyer
    public function showBuyerFormAgreement(OrderItem $order_item)
    {
        $order_item = $order_item;

        return view('Quality::qualityTests.BuyerFormAgreement')->with(compact('order_item'));
    }
    //from seller side
    public function updateQualityStatus(Request $request, OrderItem $order_item)
    {

        $this->validate($request, ['response.seller' => 'required']);

        $order_item = OrderItem::find($order_item->id);
        $order = $order_item->order;
        $product = $order_item->qualityTest->product;
        $data = $request->all();
        $response = $order_item->qualityTest->response ?? [];
        try {

            if ($request->has('response')) {
                $response = array_replace_recursive($response, $data['response']);
                $order_item->qualityTest->update(['response' => $response]);
            }
            switch ($request->response['seller']) {

                case 'agree':

                    // $order_item->qualityTest->update(['status' => 'pending']);
                    event('notifications.qualityTest.Buyer_FormAgreement', ['order_item' => $order_item, 'order' => $order]);
                    event('notifications.qualityTest.seller_response', ['qualityTest' => $order_item->qualityTest]);

                    break;

                case 'disagree':

                    $this->qualityTestService->canceledProductOrder($order_item);
                    event('notifications.qualityTest.seller_response', ['qualityTest' => $order_item->qualityTest]);
                    break;
            }
            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.updated', ['item' => $this->title_singular])];

            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'update');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);

    }
    //from buyer side
    public function updateBuyerFormAgreement(Request $request, OrderItem $order_item)
    {

        $this->validate($request, ['response.buyer' => 'required']);
        $order_item = OrderItem::find($order_item->id);
        $order = $order_item->order;
        $product = $order_item->qualityTest->product;
        $response = $order_item->qualityTest->response ?? [];
        $data = $request->all();
        try {
            if ($request->has('response')) {
                $response = array_replace_recursive($response, $data['response']);
                $order_item->qualityTest->update(['response' => $response]);
            }
            switch ($request->response['buyer']) {

                case 'agree':

                    $amount = $order_item->amount;
                    $discount = $order_item->qualityTest->discount_percentage;
                    $amount = $amount - ($amount * $discount / 100);

                    $order_item->update(['amount' => $amount]);
                    $order_item->qualityTest->update(['status' => 'accepted']);

                    //here put refundS

                    event('notifications.marketplace.order.updated', ['order' => $order]);
                    // event('notifications.qualityTest.shipping_Buyer', ['order' => $order]);
                    event('notifications.qualityTest.buyer_response', ['qualityTest' => $order_item->qualityTest]);

                    break;

                case 'disagree':
                    // $order->update(['status' => 'canceled']);

                    /* $order_item->update(['quantity' => 0,'Amount'=> 0]);
                    $order_item->qualityTest->update(['status' => 'rejected']);
                    event('notifications.marketplace.order.updated', ['order' => $order]);
                    event('notifications.qualityTest.warning_seller', ['user'=>$order->user,'order' => $order]);
                     */
                    $this->qualityTestService->canceledProductOrder($order_item);
                    event('notifications.qualityTest.buyer_response', ['qualityTest' => $order_item->qualityTest]);
                    break;
            }
            $message = ['level' => 'success', 'message' => trans('Corals::messages.success.updated', ['item' => $this->title_singular])];

            flash(trans('Corals::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'update');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);

    }

}
