<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use App\Models\KMsg;
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
    public function download($id){
        $document = Document::where('id', $id)->first();
        $result = new KMsg();
        if(empty($document)){
            $result->message = "Kh�ng t&#7891;n t&#7841;i t�i li&#7879;u n�y";
            $result->result = KMsg::RESULT_ERROR;
            return response()->json();
        }else{
            $document->download_count += 1;
            $document->save();
            $result->result = KMsg::RESULT_SUCCESS;
            return response()->json();
        }
    }

}
