<?php

namespace App\Services;

use App\Models\Subject;
use App\Models\TemplateLesson;
use Illuminate\Database\Eloquent\Builder;

class TemplateLessonService
{
    public static function index(): array
    {
        $templateLessons = [];

        for ($grade = 1; $grade < 6; $grade++){

            $groups = Subject::query()->select('group')->where('grade', '=', $grade)->distinct()->get();

            for ($day = 1; $day < 6; $day++){
                foreach ($groups as $group){
                    $templateLessons[$grade][$day][$group->group] = TemplateLesson::query()
                        ->select('id', 'day', 'position', 'week_number', 'subject_id')
                        ->whereHas('subject', function (Builder $query) use ($group, $grade) {
                            return $query
                                ->where('grade', '=', $grade)
                                ->where('group', '=', $group->group)
                                ->order();
                        })
                        ->where('day', '=', $day)
                        ->with('subject')
                        ->order()->get();
                }
            }
        }

        return $templateLessons;
    }

    public static function create()
    {
        return Subject::query()->withCount('templateLesson')->get()->groupBy('group');
    }

}
