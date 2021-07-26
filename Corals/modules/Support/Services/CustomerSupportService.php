<?php

namespace Corals\Modules\Support\Services;


use Corals\Foundation\Services\BaseServiceClass;

class CustomerSupportService extends BaseServiceClass
{

    protected $excludedRequestParams = ['downloads'];

    public function postStoreUpdate($request, $additionalData = [])
    {
        $model = $this->model;

        $collectionName = 'customoer-support-files';
         //   $product->addMedia($request->file('file'))->withCustomProperties(['root' => 'user_' . user()->hashed_id])->toMediaCollection($product->galleryMediaCollection);

        foreach ($request->get('downloads', []) as $index => $download) {
            if ($request->hasFile("downloads.$index.file")) {
                $model->addMedia($request->file("downloads.$index.file"))
                ->withCustomProperties(['root' => 'user_' . user()->hashed_id])->toMediaCollection($collectionName);
            }
        }
    
        foreach ($request->get('cleared_downloads', []) as $hashedId) {
            $media = Media::find(hashids_decode($hashedId));
            if ($media) {
                $media->delete();
    
            }
        }
    }


}