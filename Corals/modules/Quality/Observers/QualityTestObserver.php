<?php

namespace Corals\Modules\Quality\Observers;

use Corals\Modules\Quality\Models\QualityTest;

class QualityTestObserver
{

    /**
     * @param QualityTest $qualityTest
     */
    public function created(QualityTest $qualityTest)
    {
    }
}