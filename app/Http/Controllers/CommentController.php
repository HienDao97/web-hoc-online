<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::select('students.avatar as avatar', 'comments.*')->where('public', 1)->join('students', 'students.id', '=', 'comments.student_id')->paginate(6);
        return view('goc-phu-huynh.index', compact('comments'));
    }
}
