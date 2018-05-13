<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssue extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $issue = $this->route('issue');

        return $issue && $this->user()->can('update', $issue);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'        => 'exists:types,id',
            'title'       => 'required',
            'description' => 'required',
            'attachment'  => 'file',
            'assigned_to' => 'required|exists:users,id'
        ];
    }
}
