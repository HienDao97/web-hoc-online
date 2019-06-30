<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        $courses = Course::get();
        return view('document.index', compact('courses'));
    }

    public function detail($id){
        $items = Document::where('course_id', $id)
            ->whereNull('deleted_at')
            ->paginate(6);
        $course = Course::where('id', $id)->first();
        return view('document.detail', compact('items', 'course'));
    }
}
