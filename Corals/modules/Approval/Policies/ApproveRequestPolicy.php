<?php

namespace Corals\Modules\Approval\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\User\Models\User;
use Corals\Modules\Approval\Models\ApproveRequest;

class ApproveRequestPolicy extends BasePolicy
{

    protected $administrationPermission = 'Administrations::admin.approval';
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Approval::approveRequest.view')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('Approval::approveRequest.create');
    }

    /**
     * @param User $user
     * @param ApproveRequest $approveRequest
     * @return bool
     */
    public function update(User $user, ApproveRequest $approveRequest)
    {
        if ($user->can('Approval::approveRequest.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param ApproveRequest $approveRequest
     * @return bool
     */
    public function destroy(User $user, ApproveRequest $approveRequest)
    {
        if ($user->can('Approval::approveRequest.delete')) {
            return true;
        }
        return false;
    }

}
