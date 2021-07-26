<?php

namespace Corals\Modules\Quality\Http\Requests;

use Corals\Foundation\Http\Requests\BaseRequest;
use Corals\Modules\Quality\Models\QualityTest;

class QualityTestRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       // $this->setModel(QualityTest::class);

       // return $this->isAuthorized();
       return user()->hasPermissionTo('Quality::qualityTest.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(QualityTest::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $qualityTest = $this->route('qualityTest');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
