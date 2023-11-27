<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:255',
            'created_user_id' => 'required|exists:users,id',
            'due_date' => 'required'
        ];

        if($this->method() === "PUT"){
            $rules = [
                'title' => 'nullable|max:255',
                'due_date' => 'nullable'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'created_user_id.required' => 'O campo id usuário é obrigatório.',
            'created_user_id.exists' => 'O usuário precisa existir para criar uma tarefa.',
            'due_date.required' => 'A data máxima de conclusão é obrigatória.'
        ];
    }
}
