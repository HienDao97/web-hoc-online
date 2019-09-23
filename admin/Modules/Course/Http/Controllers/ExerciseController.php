<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Course\Entities\Classroom;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Exercise;
use Modules\Course\Entities\Theory;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use Session;
use App\Models\KMsg;
use Carbon\Carbon;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $courses = Course::whereNull('deleted_at')->get();
        $actions = request()->route()->getAction();
        $controller = explode("@",$actions['controller']);
        $controller = $controller[0];
        Session::put('edit', Auth::user()->hasPermission($controller, "edit"));
        Session::put('destroy', Auth::user()->hasPermission($controller, "destroy"));
        return view('course::exercise.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $courses = Course::whereNull('deleted_at')->get();
        return view('course::exercise.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $validatorArray = [
            'theory_id' => 'required',
            'classroom_id' => 'required',
            'course_id' => 'required',
            'content'   => 'required|max:10000',
            'answer' => 'required'
        ];


        $validator = Validator::make($request->all(), $validatorArray);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        DB::beginTransaction();
        try {
            $object = Exercise::where([
                "theory_id" => $params["theory_id"],
                "course_id" => $params["course_id"],
                "classroom_id" => $params["classroom_id"]
            ])->whereNull('deleted_at')->first();
            if(!empty($object)){
                return redirect()->back()->withInput()->withErrors(["B�i t&#7853;p cho l&#7899;p h&#7885;c n�y &#273;� t&#7891;n t&#7841;i"]);
            }
            $content ="";
            if($request->hasFile('content')){
                $img = $request->file('content')->getClientOriginalName();
                $request->content->move('img/exercise',$img);
                $content = $img;
            }
            $array = array();
            foreach ($params["answer"] as $key => $value){
                array_push($array, $value[0]);
            }
            //dd($params["birthday"]);
            Exercise::create([
                "name" => $params["name"],
                "theory_id" => $params["theory_id"],
                "course_id" => $params["course_id"],
                "classroom_id" => $params["classroom_id"],
                "content" => $content,
                "answer" => json_encode($array),
                "created_at" => Carbon::now()
            ]);
            DB::commit();
            return redirect(route('exercise.index'))->with('messages','Tạo bài tập thành công');
        } catch (\Exception $e) {
            DB::rollback();
            Log::alert($e);
            return redirect()->back()->withInput()->withErrors([trans('core::user.error_save')]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('course::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $courses = Course::whereNull('deleted_at')->get();
        $exercise = Exercise::select("exercises.*", "class_rooms.class_name as classroom_name","theories.name as theory_name")
            ->where('exercises.id', $id)
            ->join("theories" , "theories.id", "=", "exercises.theory_id")
            ->join("class_rooms", "exercises.classroom_id", "=", "class_rooms.id")
            ->join("courses", "courses.id" , "=", "exercises.course_id")
            ->first();
        return view('course::exercise.edit', compact('exercise', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $validatorArray = [
            'theory_id' => 'required',
            'classroom_id' => 'required',
            'course_id' => 'required',
            //'content'   => 'max:10000',
            'answer' => 'required'
        ];

        $validator = Validator::make($request->all(), $validatorArray);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        $item = Exercise::where("id", $id)->whereNull('deleted_at')->first();
        if ($item) {
            if($request->hasFile('content')){
                $img = $request->file('content')->getClientOriginalName();
                $request->content->move('img/exercise',$img);
                $item->content = $img;
            }

            $array = array();
            foreach ($params["answer"] as $key => $value){
                array_push($array, $value[0]);
            }

            $item->answer = json_encode($array);
            $item->name = $params['name'];
            $item->theory_id = $params['theory_id'];
            $item->classroom_id = $params['classroom_id'];
            $item->course_id = $params['course_id'];
            $item->save();

            return redirect(route('exercise.index'))->with('messages','Cập nhật bài tập thành công');
        }
        else {
            return redirect(route('exercise.index'))->withErrors(["Không tồn tại bài học này"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = Exercise::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('exercise.index'))->with('messages','Xoá bài tập thành công');
        } else {
            return redirect(route('exercise.index'))->withErrors(["Không tồn tại bài học này "]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = Exercise::select("exercises.*", "theories.name as theory_name", "class_rooms.class_name as classroom_name", "courses.name as course_name", "class_rooms.id as classroom_id")
        ->join("theories" , "theories.id", "=", "exercises.theory_id")
        ->join("class_rooms", "exercises.classroom_id", "=", "class_rooms.id")
        ->join("courses", "courses.id" , "=", "exercises.course_id")
        ->whereNull('exercises.deleted_at');
        return Datatables::of($query)
            ->filter(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (($value == "") || ($value == -1) || ($value == null)) {

                    } else {
                        if ($key == 'classroom_id') {
                            $query->where('exercises.classroom_id', $value);
                        }elseif ($key == 'course_id') {
                            $query->where('exercises.course_id', $value);                        }
                    }
                }
            })
            ->escapeColumns([])
            ->addColumn('actions', function ($course) {
                $html = Exercise::genColumnHtml($course);
                return $html;
            })
            ->editColumn('content', function ($exercies){
                return '<img src="'. asset("/img/exercise/".$exercies->content) .'" style="width: 100px; height: 100px">';
            })
            ->removeColumn('updated_at')
            ->removeColumn('deleted_at')
            ->make(true);
    }

    /**
     * Filter area
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request){
        $result = new KMsg();
        if(empty($request->id) || empty($request->type)){
            $result->message = "Something was wrong";
            $result->result = KMsg::RESULT_ERROR;
            return \response()->json($result);
        }else{
            $html = "";

            if($request->type == "classroom"){
                $html .= "<option value=''>-- Khoá học --</option>";
                $classrooms = Classroom::select('id', 'class_name as name')->where('course_id', $request->id)->whereNull('deleted_at')->get();
                //dd($classrooms);
                foreach ($classrooms as $classroom){
                    if(!empty($request->select_value) && $classroom->id == $request->select_value){
                        $html .= "<option value=". $classroom->id ." selected>". $classroom->name ."</option>";
                    }else{
                        $html .= "<option value=". $classroom->id .">". $classroom->name ."</option>";
                    }

                }
                $result->message = $html;
                $result->result = KMsg::RESULT_SUCCESS;
            }
            else if($request->type == "theory"){
                $html .= "<option value=''>-- Bài học --</option>";
                $theorys = Theory::select('id', 'name')->where('classroom_id', $request->id)->whereNull('deleted_at')->get();
                foreach ($theorys as $theory){
                    if(!empty($request->select_value) && $theory->id == $request->select_value){
                        $html .= "<option value=". $theory->id ." selected>". $theory->name ."</option>";
                    }else{
                        $html .= "<option value=". $theory->id .">". $theory->name ."</option>";
                    }
                }
                $result->message = $html;
                $result->result = KMsg::RESULT_SUCCESS;
            }
            return \response()->json($result);
        }
    }
}
