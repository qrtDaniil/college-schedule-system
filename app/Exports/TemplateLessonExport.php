<?php

namespace App\Exports;

use App\Models\Subject;
use App\Models\TemplateLesson;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;


class TemplateLessonExport implements FromView
{
    public function view(): \Illuminate\Contracts\View\View
    {
        $templateLessons = [];

        $groups = Subject::query()->select('group')->distinct()->get();

        for ($day = 1; $day < 6; $day++){
            foreach ($groups as $group){
                $templateLessons[$day][$group->group] = TemplateLesson::query()
                    ->select('id', 'day', 'position', 'week_number', 'subject_id')
                    ->whereHas('subject', function (Builder $query) use ($group) {
                        return $query
                            ->where('group', '=', $group->group)
                            ->order();
                    })
                    ->where('day', '=', $day)
                    ->with('subject')
                    ->order()->get();
            }
        }

        return view('Exports.template-lessons-export', [
            'templateLessons' => $templateLessons
        ]);
    }
}
