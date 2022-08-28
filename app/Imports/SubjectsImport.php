<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubjectsImport implements ToCollection, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key != 0) {

                for($i=0; $i < 7; $i++) {

                    if($i == 3) {
                        $rows[$key][$i] = preg_replace("/[Дд]\о\п\.\д\о\г\о\в\о\р/u", "(Доп.договор)", $rows[$key][$i]); // replace unwanted text
                    }

                    if($i != 2){
                        $rows[$key][$i] = preg_replace("/[,]/", ".", $rows[$key][$i]); // replace comma with dot if not 'name'
                    }

                    $rows[$key][$i] = preg_replace("/[ ]+/", " ", $rows[$key][$i]); // replace more than one spaces with one space
                    $rows[$key][$i] = preg_replace("/((^\s) AND (\s$))|(\s$)|(^\s)/", "", $rows[$key][$i]); // delete first and last, or last or first spaces

                    if(!isset($rows[$key][4])){
                        $rows[$key][4] = 0;
                    }
                    if(!isset($rows[$key][5])){
                        $rows[$key][5] = 0;
                    }
                }

                $rows[$key][2] = preg_replace_callback("/^[а-я]/u", function ($matches) {
                    return mb_strtoupper($matches[0]);
                }, mb_strtolower($rows[$key][2]));


                $validator = Validator::make(
                    [
                        'group' => $row[0],
                        'index' => $row[1],
                        'name' => $row[2],
                        'teacher' => $row[3],
                        'hours_first_half' => $row[4],
                        'hours_second_half' => $row[5],
                        'class' => $row[6],
                    ],
                    [
                        'group' => 'required',
                        'index' => 'required',
                        'name' => 'required',
                        'teacher' => 'nullable',
                        'hours_first_half' => 'nullable|integer',
                        'hours_second_half' => 'nullable|integer',
                        'class' => 'nullable',
                    ]
                );

                if(!$validator->fails())
                {
                    Subject::create([
                        'grade' => $row[0][-2],
                        'group' => $row[0],
                        'index' => $row[1],
                        'name' => $row[2],
                        'teacher' => $row[3],
                        'hours_first_half' => $row[4],
                        'hours_second_half' => $row[5],
                        'class' => $row[6],
                    ]);
                }
                else{
                    echo 'Ошибка при чтении строки номер' . ($key + 1);
                }
            }
        }
    }
}
