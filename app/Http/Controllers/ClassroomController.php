<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $courses = Course::with('class')->get();
        if(!empty( Auth::user()->id)){
            $student_class = StudentClass::with("class")->where('student_id', Auth::user()->id)->get();
        }else{
            $student_class = "";
        }

        return view('classroom.index', compact('courses', 'student_class'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id){
        $courses = Course::with('class')->get();
        return view('classroom.index', compact('courses', 'id'));
    }
}
