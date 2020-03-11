<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
      if($this->getMethod() == "POST")
      {
        return [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role_id' => 'required|numeric',
        ];
      } else {
        return [
            'name' => 'required|unique:users,name,' . $this->user['id'],
            'email' => 'required|email|unique:users,email,' . $this->user['id'],
            'password' => 'required',
            'role_id' => 'required|numeric',
        ];
      }

    }

    public function messages()
    {
      return [

      ];
    }
}
