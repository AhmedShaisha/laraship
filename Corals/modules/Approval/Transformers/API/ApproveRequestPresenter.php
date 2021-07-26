<?php

namespace Corals\Modules\Approval\Transformers\API;

use Corals\Foundation\Transformers\FractalPresenter;

class ApproveRequestPresenter extends FractalPresenter
{

    /**
     * @return ApproveRequestTransformer
     */
    public function getTransformer()
    {
        return new ApproveRequestTransformer();
    }
}
