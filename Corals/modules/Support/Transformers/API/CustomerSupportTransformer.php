<?php

namespace Corals\Modules\Support\Transformers\API;

use Corals\Foundation\Transformers\APIBaseTransformer;
use Corals\Modules\Support\Models\CustomerSupport;

class CustomerSupportTransformer extends APIBaseTransformer
{
    /**
     * @param CustomerSupport $customerSupport
     * @return array
     * @throws \Throwable
     */
    public function transform(CustomerSupport $customerSupport)
    {
        $transformedArray = [
            'id' => $customerSupport->id,
            'name' => $customerSupport->name,
            'created_at' => format_date($customerSupport->created_at),
            'updated_at' => format_date($customerSupport->updated_at),
        ];

        return parent::transformResponse($transformedArray);
    }
}