<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = NewsPost::where("post_status", 1)
            ->whereDate("published_at", "<=", Carbon::now())
            ->paginate(6);
        return view('news.index', compact('news'));
    }

    public function info($slug){
        $new_detail = NewsPost::where('slug', $slug)->first();
        if(empty($new_detail)){
            return redirect()->back();
        }else{
            return view('news.detail', compact('new_detail'));
        }
    }
}
