<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Imports\SubjectsImport;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\TemplateLesson;
use App\Services\SubjectService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(SubjectService $subjectService)
    {
        return Inertia::render('Subjects/Index', [
            'subjects' => $subjectService->index()
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
     * @param StoreSubjectRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSubjectRequest $request)
    {
        if (Subject::create($request->validated())) {
            return redirect()->route('subjects.index')
                ->withErrors(['message' => 'Запись была успешно добавлена']);
        }
        else {
            return redirect()->route('subjects.index')->withErrors([
                'backError' => 'Произошла ошибка при добавлении записи'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @return Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subject $subject
     * @return \Inertia\Response
     */
    public function edit(Subject $subject)
    {
        return Inertia::render('Subjects/Edit', [
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubjectRequest $request
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        if ($subject->update($request->validated())) {
            return redirect()->route('subjects.index')
                ->withErrors(['message' => 'Запись была успешно изменена']);
        }
        else {
            return redirect()->route('subjects.index')->withErrors([
                'backError' => 'Произошла ошибка при изменении записи'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function destroy(Subject $subject)
    {
        if ($subject->delete()) {
            return back()->withErrors(['message' => 'Запись была успешно удалена']);
        }
    }

    public function import(Request $request)
    {
        if ($request->file('file') !== null) {

            Schema::disableForeignKeyConstraints();
            Subject::truncate();
            Schema::enableForeignKeyConstraints();

            $path = $request->file('file')->storeAs('app', 'import.xls');

            try {
                Excel::import(new SubjectsImport, $path);
            } catch (Exception $exception) {
                return back()->withErrors(['file' => 'Произошла ошибка во время чтения файла']);
            }
            return back()->with(['message' => 'Файл был успешно загружен в базу данных']);
        }
        else {
            return back()->withErrors(['file' => 'Сначала вам необходимо выбрать файл для загрузки']);
        }
    }
}
