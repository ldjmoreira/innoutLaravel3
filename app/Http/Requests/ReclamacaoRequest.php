<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReclamacaoRequest extends FormRequest
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
	        'titulo'         => 'required',
	        'area'        => 'required',
            'politico_id'        => 'required',
            'descricao'        => 'required',
            'thumblink'        => 'required',
            'texto'        => 'required',
        ];
    }
    public function messages()
    {
    	return [
    		'required' => 'Este campo é obrigatório!',
	    ];
    }
}
