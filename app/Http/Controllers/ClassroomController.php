<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(){
        $courses = Course::with('class')->get();
        return view('classroom.index', compact('courses'));
    }

    public function detail($id){
        $courses = Course::with('class')->get();
        return view('classroom.index', compact('courses', 'id'));
    }
}
