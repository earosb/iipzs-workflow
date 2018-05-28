<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIssue extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'        => 'required|exists:types,id',
            'title'       => 'required',
            'description' => 'required',
            'attachment'  => 'file',
            'assigned_to' => 'required|exists:users,id'
        ];
    }
}
