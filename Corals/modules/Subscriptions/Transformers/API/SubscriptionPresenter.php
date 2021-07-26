<?php

namespace Corals\Modules\Subscriptions\Transformers\API;

use Corals\Foundation\Transformers\FractalPresenter;

class SubscriptionPresenter extends FractalPresenter
{

    /**
     * @return SubscriptionTransformer
     */
    public function getTransformer()
    {
        return new SubscriptionTransformer();
    }
}
