<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Agency\Entities\Agency;
use Modules\Course\Entities\Classroom;
use Modules\News\Models\NewsPost;
use Modules\News\Models\NewsPostView;
use Modules\Orders\Entities\Customer;
use Modules\Orders\Entities\Orders;
use Modules\Product\Entities\Product;
use Modules\Student\Entities\Comment;
use Modules\Student\Entities\Student;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        $student_count = Student::count();
        $class_count = Classroom::count();
        $comment_count = Comment::count();
//        $agency_count = Agency::count();
        //dd(1);
        return view('core::index', compact('student_count', 'class_count', 'comment_count'));
    }

}
