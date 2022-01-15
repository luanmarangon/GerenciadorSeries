<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'nome' => 'required|min:2',
            'qtd_temporadas' => 'required',
            'ep_por_temporada' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório',
            'nome.min' => 'O campo nome precisa ter pelo menos 2 caracteres',
            'qtd_temporadas.required' => 'O campo Quantidade de Temporadas é obrigatório',
            'ep_por_temporada.required' => 'O campo Episodios por Temporadas é obrigatório',
        ];
    }
}
