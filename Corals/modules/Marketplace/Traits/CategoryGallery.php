<?php

namespace Corals\Modules\Marketplace\Traits;

use Corals\Foundation\Facades\Actions;
use Corals\Modules\Marketplace\Models\Category;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

trait CategoryGallery
{

    /**
     * @param Request $request
     * @param $category
     * @return array|string
     * @throws \Throwable
     */
    public function gallery(Request $request, $category)
    {
        $category = Category::findByHash($category);

     /*   if (is_api_request()) {
            return apiResponse(['gallery' => $this->productService->getModelDetails($product)['gallery']]);
        }
*/
        $editable = true;

        return view('Marketplace::categories.gallery', compact('category', 'editable'))->render();
    }

    /**
     * @param Request $request
     * @param $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function galleryUpload(Request $request, $category)
    {
        $category = Category::findByHash($category);

        try {
            $this->validate($request, [
                'file' => 'required|mimes:jpg,jpeg,png|max:' . maxUploadFileSize(),
            ]);

            $category->addMedia($request->file('file'))->withCustomProperties(['root' => 'user_' . user()->hashed_id,'name'=>'test'])->toMediaCollection($category->galleryMediaCollection);

            $messageText = trans('Marketplace::labels.category.image_upload');

            if (is_api_request()) {
                return apiResponse([], $messageText);
            }

            $message = ['level' => 'success', 'message' => $messageText];
        } catch (\Exception $exception) {
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
            log_exception($exception, 'Gallery', 'destroy');
            if (is_api_request()) {
                return apiExceptionResponse($exception);
            }
        }

        return response()->json($message);
    }

    /**
     * @param Request $request
     * @param $media
     * @return \Illuminate\Http\JsonResponse
     */
    public function galleryItemDelete(Request $request, $media)
    {
        try {
            $media = Media::findOrFail($media);

            Actions::do_action('pre_update_gallery', $media);

            $media->delete();

            $messageText = trans('Corals::messages.success.deleted', ['item' => trans('Marketplace::module.category.media_title')]);

            if (is_api_request()) {
                return apiResponse([], $messageText);
            }

            $message = ['level' => 'success', 'message' => $messageText];
        } catch (\Exception $exception) {
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
            log_exception($exception, Media::class, 'destroy');
            if (is_api_request()) {
                return apiExceptionResponse($exception);
            }
        }

        return response()->json($message);
    }

    /**
     * @param Request $request
     * @param $media
     * @return \Illuminate\Http\JsonResponse
     */
   /*public function galleryItemFeatured(Request $request, $media)
    {
        try {
            $media = Media::findOrFail($media);

            Actions::do_action('pre_update_gallery', $media);

            $product = $media->model()->first();

            $gallery = $product->getMedia($product->galleryMediaCollection);

            foreach ($gallery as $item) {
                $item->forgetCustomProperty('featured');
                $item->save();
            }

            $media->setCustomProperty('featured', true);

            $media->save();

            $messageText = trans('Corals::messages.success.saved', ['item' => trans('Marketplace::module.product.media_title')]);

            if (is_api_request()) {
                return apiResponse([], $messageText);
            }

            $message = ['level' => 'success', 'message' => $messageText];
        } catch (\Exception $exception) {
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
            log_exception($exception, Media::class, 'destroy');
            if (is_api_request()) {
                return apiExceptionResponse($exception);
            }
        }

        return response()->json($message);
    }*/
}