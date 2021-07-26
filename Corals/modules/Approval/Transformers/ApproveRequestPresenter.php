<?php

namespace Corals\Modules\Approval\Transformers;

use Corals\Foundation\Transformers\FractalPresenter;

class ApproveRequestPresenter extends FractalPresenter
{

    /**
     * @return ApproveRequestTransformer
     */
    public function getTransformer($extras = [])
    {
        return new ApproveRequestTransformer($extras);
    }
}
