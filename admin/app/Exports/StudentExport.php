<?php
/**
 * Created by PhpStorm.
 * User: paditech
 * Date: 7/1/19
 * Time: 1:11 AM
 */

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Student\Entities\Student;

class StudentExport implements FromView
{
    public function view(): View
    {
        $item = Student::select("students.*", "class_rooms.class_name as classroom_name", "courses.name as course_name")
            ->leftJoin('student_classrooms', 'students.id', '=', 'student_classrooms.student_id')
            ->leftJoin("courses", "courses.id", "=", "student_classrooms.course_id")
            ->leftJoin("class_rooms", "class_rooms.id", "=", "student_classrooms.class_room_id")
            //->groupBy('students.id')
            ->whereNull('students.deleted_at')->get();
        //dd($item);
        return view('student::student.csv', [
            'students' => $item
        ]);
    }
}