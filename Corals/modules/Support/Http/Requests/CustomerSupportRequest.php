<?php

namespace Corals\Modules\Support\Http\Requests;

use Corals\Foundation\Http\Requests\BaseRequest;
use Corals\Modules\Support\Models\CustomerSupport;

class CustomerSupportRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(CustomerSupport::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(CustomerSupport::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'file' => 'mimes:jpg,jpeg,png,pdf|max:' . maxUploadFileSize(),

            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $customerSupport = $this->route('customerSupport');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
