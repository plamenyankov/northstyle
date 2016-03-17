<?php

namespace Northstyle\Module\Content\Backend\Http\Request;

use Northstyle\Http\Requests\Request;

class ConfirmDeletePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function forbiddenResponse(){
        return redirect()->back()->withErrors([
           'error'=>'You are not able to delete yourself.'
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
