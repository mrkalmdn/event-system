<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventFormRequest extends FormRequest
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
            'name' => 'required',
            'from' => 'required|date|date_format:Y-m-d|before_or_equal:to',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from',
            'days' => 'required|array|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun'
        ];
    }
}
