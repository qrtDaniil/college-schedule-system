<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'grade' => 'required|numeric|between:1,6',
            'group' => 'required|string',
            'index' => 'nullable|string',
            'name' => 'required|string',
            'teacher' => 'nullable|string',
            'hours_first_half' => 'numeric|between:0,65535',
            'hours_second_half' => 'numeric|between:0,65535',
            'class' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'grade' => '"Курс"',
            'group' => '"Группа"',
            'index' => '"Индекс"',
            'name' => '"Наименование учебной дисциплины"',
            'teacher' => '"Преподаватель"',
            'hours_first_half' => '"Часов 1 п/г"',
            'hours_second_half' => '"Часов 2 п/г"',
            'class' => '"Аудитория"',
        ];
    }
}
