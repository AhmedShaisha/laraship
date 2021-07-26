<?php

namespace Corals\Modules\Support\Http\Requests;

use Corals\Foundation\Http\Requests\BaseRequest;
use Corals\Modules\Support\Models\Response;

class ResponseRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Response::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Response::class);
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
            $response = $this->route('response');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
