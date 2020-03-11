<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sectionRequest extends FormRequest
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
          'description' => 'required',
      ];

/*
      if($this->getMethod() == 'POST')
        return [
            'name' => 'required|unique:sections,name',
            'description' => 'nullable',
        ];
      else {
        return [
            'name' => 'required|unique:sections,name,' . $this->section['id'],
            'description' => 'nullable',
        ];
      }*/
    }
/*
    public function messages()
    {

      return [
        'title.required' => 'required is TITLE',
        'title.unique' => 'Ze obstaja',
      ];
    }
*/
}
