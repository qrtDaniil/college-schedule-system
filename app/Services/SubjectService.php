<?php

namespace App\Services;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

class SubjectService
{
    public static function index()
    {
        return Subject::query()
            ->when(Request::input('grade'), function ($query, $grade) {
                $query->whereGrade($grade);
            })
            ->when(Request::input('group'), function ($query, $group) {
                $query->like('group', $group);
            })
            ->when(Request::input('index'), function ($query, $index) {
                $query->like('index', $index);
            })
            ->when(Request::input('name'), function ($query, $name) {
                $query->like('name', $name);
            })
            ->when(Request::input('teacher'), function ($query, $teacher) {
                $query->like('teacher', $teacher);
            })
            ->when(Request::input('hours_first_half'), function ($query, $hours_first_half) {
                $query->like('hours_first_half', $hours_first_half);
            })
            ->when(Request::input('hours_second_half'), function ($query, $hours_second_half) {
                $query->like('hours_second_half', $hours_second_half);
            })
            ->when(Request::input('class'), function ($query, $class) {
                $query->like('class', $class);
            })
            ->order()->paginate(12)->withQueryString();
    }
}
