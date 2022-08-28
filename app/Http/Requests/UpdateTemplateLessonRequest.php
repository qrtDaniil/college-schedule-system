<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplateLessonRequest extends FormRequest
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
            'day' => 'required',
            'position' => 'required',
            'week_number' => 'required',
            'subject_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'day' => '"День недели"',
            'position' => '"Номер пары"',
            'week_number' => '"Номер недели"',
            'subject_id' => '"Учебная дисциплина"',
        ];
    }
}
