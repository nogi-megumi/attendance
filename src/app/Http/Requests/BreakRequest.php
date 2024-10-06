<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreakRequest extends FormRequest
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
            'work_id'=>'required',
            'break_start' => 'sometimes|required|date_format:Y-m-d H:i:s',
            'break_end' => 'sometimes|required| date_format:Y-m-d H:i:s',
        ];
    }
}
