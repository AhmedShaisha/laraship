<?php

namespace Corals\Modules\Approval\Observers;

use Corals\Modules\Approval\Models\ApproveRequest;

class ApproveRequestObserver
{

    /**
     * @param ApproveRequest $approveRequest
     */
    public function created(ApproveRequest $approveRequest)
    {
    }
}
