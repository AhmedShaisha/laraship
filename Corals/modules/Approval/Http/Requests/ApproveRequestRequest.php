<?php

namespace Corals\Modules\Approval\Http\Requests;

use Corals\Foundation\Http\Requests\BaseRequest;
use Corals\Modules\Approval\Models\ApproveRequest;

class ApproveRequestRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //update hanaa
        //$this->setModel(ApproveRequest::class);
        //return $this->isAuthorized();
        return user()->hasPermissionTo('Approval::approveRequest.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(ApproveRequest::class);
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
            $approveRequest = $this->route('approveRequest');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
