<?php

namespace Corals\Modules\Approval\Transformers\API;

use Corals\Foundation\Transformers\APIBaseTransformer;
use Corals\Modules\Approval\Models\ApproveRequest;

class ApproveRequestTransformer extends APIBaseTransformer
{
    /**
     * @param ApproveRequest $approveRequest
     * @return array
     * @throws \Throwable
     */
    public function transform(ApproveRequest $approveRequest)
    {
        $transformedArray = [
            'id' => $approveRequest->id,
            'name' => $approveRequest->name,
            'created_at' => format_date($approveRequest->created_at),
            'updated_at' => format_date($approveRequest->updated_at),
        ];

        return parent::transformResponse($transformedArray);
    }
}
