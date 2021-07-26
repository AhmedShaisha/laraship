<?php

namespace Corals\Modules\Quality\Policies;

use Corals\User\Models\User;
use Corals\Modules\Quality\Models\QualityTest;

class QualityTestPolicy
{

    protected $administrationPermission = 'Administrations::admin.quality';
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Quality::qualityTest.view')) {
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
        return $user->can('Quality::qualityTest.create');
    }

    /**
     * @param User $user
     * @param QualityTest $qualityTest
     * @return bool
     */
    public function update(User $user, QualityTest $qualityTest)
    {
        if ($user->can('Quality::qualityTest.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param QualityTest $qualityTest
     * @return bool
     */
    public function destroy(User $user, QualityTest $qualityTest)
    {
        if ($user->can('Quality::qualityTest.delete')) {
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
