<?php

namespace Corals\Modules\Support\Transformers\API;

use Corals\Foundation\Transformers\FractalPresenter;

class CustomerSupportPresenter extends FractalPresenter
{

    /**
     * @return CustomerSupportTransformer
     */
    public function getTransformer()
    {
        return new CustomerSupportTransformer();
    }
}