<?php

namespace Corals\Modules\Quality\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Modules\Quality\Facades\Quality;
use Illuminate\Http\Request;


class QualitySettingsController extends BaseController
{
    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->title = 'Quality::module.quality.title';
        $this->title_singular = 'Quality::module.quality.title';

        parent::__construct();
    }

    /**
     * @param $permission
     */
    private function canAccess($permission)
    {
        if (!user()->hasPermissionTo($permission)) {
            abort(403);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
  

    public function settings(Request $request)
    {
        $this->canAccess('Quality::settings.access');

        $this->setViewSharedData(['title_singular' => 'Quality Settings']);

        $settings = config('quality.site_settings');

        return view('Quality::qualityTests.settings')->with(compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        try {
            $this->canAccess('Quality::settings.access');

            $settings = $request->except('_token');

            foreach ($settings as $key => $value) {
                list($setting_key, $cast) = explode('|', $key);
                \Settings::set($setting_key, $value, 'Quality', $cast);
            }

            flash(trans('Corals::messages.success.saved', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, 'qualitySettings', 'savedSettings');
        }

        return redirectTo('qualityTests/settings');
    }
}
