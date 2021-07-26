<?php

namespace Corals\Modules\Quality\Transformers\API;

use Corals\Foundation\Transformers\APIBaseTransformer;
use Corals\Modules\Quality\Models\QualityTest;

class QualityTestTransformer extends APIBaseTransformer
{
    /**
     * @param QualityTest $qualityTest
     * @return array
     * @throws \Throwable
     */
    public function transform(QualityTest $qualityTest)
    {
        $transformedArray = [
            'id' => $qualityTest->id,
            'name' => $qualityTest->name,
            'created_at' => format_date($qualityTest->created_at),
            'updated_at' => format_date($qualityTest->updated_at),
        ];

        return parent::transformResponse($transformedArray);
    }
}