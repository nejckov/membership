<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            '*.title' => 'required|unique:company,name',
            '*.details' => 'nullable'
        ];
      } else {
        return [
          '*.title' => 'required|unique:company,name,' . $this->company['num'],
          '*.description' => 'nullable',
        ];
      }

    }


    public function messages()
    {
      return [
        '*.title.required' => 'Company ime je obvezen',
        '*.title.unique' => 'Company že obstaja'
      ];
    }
}
