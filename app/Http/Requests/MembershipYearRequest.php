<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipYearRequest extends FormRequest
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
      if($this->getMethod() == 'POST')
      {
        return [
            'type' => 'required',
            'year' => 'required|numeric',
            'payment' => 'required|numeric',
        ];
      } else {
        return [
            'type' => 'required',
            'year' => 'required|numeric',
            'payment' => 'required|numeric',
        ];
      }

    }

    public function messages()
    {
      return [

      ];
    }
}
