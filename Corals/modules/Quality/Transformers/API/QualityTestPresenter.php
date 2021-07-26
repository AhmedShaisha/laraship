<?php

namespace Corals\Modules\Quality\Transformers\API;

use Corals\Foundation\Transformers\FractalPresenter;

class QualityTestPresenter extends FractalPresenter
{

    /**
     * @return QualityTestTransformer
     */
    public function getTransformer()
    {
        return new QualityTestTransformer();
    }
}