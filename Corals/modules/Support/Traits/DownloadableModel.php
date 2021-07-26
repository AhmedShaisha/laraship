<?php

namespace Corals\Modules\Support\Traits;


trait DownloadableModel
{
    /**
     * @return array
     */
    public function getDownloadsAttribute()
    {
        $collectionName = 'customoer-support-files';

        $medias = $this->getMedia($collectionName);

        $downloads = [];

        foreach ($medias as $item) {
            $downloads[$item->id] = [
                'description' => $item->getCustomProperty('description'),
                'name' => $item->name,
                'hashed_id' => hashids_encode($item->id)
            ];
        }

        return $downloads;
    }
}