<?php

namespace App\Http\Controllers;

use App\Exports\TemplateLessonExport;
use App\Http\Requests\StoreTemplateLessonRequest;
use App\Http\Requests\UpdateTemplateLessonRequest;
use App\Models\TemplateLesson;
use App\Services\TemplateLessonService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class TemplateLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(TemplateLessonService $templateLessonService)
    {
        return Inertia::render('TemplateLessons/Index', [
            'templateLessons' => $templateLessonService->index(),
            'subjectsForGroup' => $templateLessonService->create(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreTemplateLessonRequest $request)
    {
        if (TemplateLesson::create($request->validated())) {
            return back()
                ->withErrors(['message' => 'Запись была успешно добавлена']);
        }
        else {
            return redirect()->route('template-lessons.index')->withErrors([
                'backError' => 'Произошла ошибка при добавлении записи'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param TemplateLesson $templateLesson
     * @return Response
     */
    public function show(TemplateLesson $templateLesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateLesson $templateLesson
     * @return Response
     */
    public function edit(TemplateLesson $templateLesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TemplateLesson $templateLesson
     * @return RedirectResponse
     */
    public function update(UpdateTemplateLessonRequest $request, TemplateLesson $templateLesson)
    {
        if ($templateLesson->update($request->validated())) {
            return back()
                ->withErrors(['message' => 'Запись была успешно изменена']);
        }
        else {
            return redirect()->route('template-lessons.index')->withErrors([
                'backError' => 'Произошла ошибка при изменении записи'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TemplateLesson $templateLesson
     * @return RedirectResponse
     */
    public function destroy(TemplateLesson $templateLesson)
    {
        if ($templateLesson->delete()) {
            return back()->withErrors(['message' => 'Запись была успешно удалена']);
        }
    }

    public function export()
    {
        try {
            Excel::store(new TemplateLessonExport, 'расписание.xlsx');
        } catch (Exception $exception) {
            return back()->withErrors(['file' => 'Произошла ошибка во время формирования файла']);
        }
        return back();
    }
}
