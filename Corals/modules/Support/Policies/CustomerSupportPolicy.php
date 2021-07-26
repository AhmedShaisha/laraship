<?php

namespace Corals\Modules\Support\Policies;

use Corals\User\Models\User;
use Corals\Modules\Support\Models\CustomerSupport;

class CustomerSupportPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Support::customerSupport.view')) {
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
        return $user->can('Support::customerSupport.create');
    }

    /**
     * @param User $user
     * @param CustomerSupport $customerSupport
     * @return bool
     */
    public function update(User $user, CustomerSupport $customerSupport)
    {
        if ($user->can('Support::customerSupport.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param CustomerSupport $customerSupport
     * @return bool
     */
    public function destroy(User $user, CustomerSupport $customerSupport)
    {
        if ($user->can('Support::customerSupport.delete')) {
            return true;
        }
        return false;
    }


    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if (isSuperUser($user)) {
            return true;
        }

        return null;
    }
}
