<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Theory;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use DB;
use App\Models\KMsg;
use Carbon\Carbon;
use Validator;
use Session;

class TheoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $actions = request()->route()->getAction();
        $controller = explode("@",$actions['controller']);
        $controller = $controller[0];
        Session::put('edit', Auth::user()->hasPermission($controller, "edit"));
        Session::put('destroy', Auth::user()->hasPermission($controller, "destroy"));

        $courses = Course::whereNull('deleted_at')->get();
        return view('course::theory.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->only('name', 'video_link', 'classroom_id', 'course_id');

            $validatorArray = [
                'name' => 'required',
                'classroom_id' => 'required',
                'course_id' => 'required',
            ];
            $result = new KMsg();


            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }
            if(!empty($params['video_link'])){
                if(!preg_match('#https?://(?:www\.)?youtube\.com/watch\?v=([^&]+?)#', $params['video_link'], $matches)){
                    $result->message = ["video_link" => "Link video ph&#7843;i l� link youtube"];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
            }

            // Save project
            try {
                Theory::create($params);
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::theory.create', compact('courses'));
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('course::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $params = $request->only('name', 'video_link', 'classroom_id', 'course_id');

            $validatorArray = [
                'name' => 'required',
                'classroom_id' => 'required',
                'course_id' => 'required'
            ];
            $result = new KMsg();

            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }
            if(!empty($params['video_link'])){
                if(!preg_match('#https?://(?:www\.)?youtube\.com/watch\?v=([^&]+?)#', $params['video_link'], $matches)){
                    $result->message = ["video_link" => "Link video ph&#7843;i l� link youtube"];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
            }

            // Save project
            try {
                $item = Theory::where('id', $id)->whereNull('deleted_at')->first();
                if(empty($item)){
                    $result->message = ["Không tồn tại khoá học này "];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
                $item->name = $params["name"];
                $item->video_link = $params["video_link"];
                $item->classroom_id = $params["classroom_id"];
                $item->course_id = $params["course_id"];
                $item->save();
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $item = Theory::select('theories.*', 'class_rooms.class_name as classroom_name')
                ->join('class_rooms', 'class_rooms.id', '=', 'theories.classroom_id')
                ->where('theories.id', $id)->whereNull('theories.deleted_at')->first();
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::theory.edit', compact('item', 'courses'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $result = Theory::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('theory.index'))->with('messages','Xoá bài học thành công');
        } else {
            return redirect(route('theory.index'))->withErrors(["Không tồn tại bài học này "]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = Theory::select("theories.*", "class_rooms.class_name as classroom_name", 'courses.name as course_name')->join('class_rooms', 'class_rooms.id','=', 'theories.classroom_id')
            ->join('courses', 'courses.id', '=', 'class_rooms.course_id')
            ->whereNull('theories.deleted_at');
        return Datatables::of($query)
            ->filter(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (($value == "") || ($value == -1) || ($value == null)) {

                    } else {
                        if ($key == 'classroom_id') {
                            $query->where('classroom_id', $value);
                        }
                    }
                }
            })
            ->escapeColumns([])
            ->addColumn('actions', function ($classroom) {
                $html = Theory::genColumnHtml($classroom);
                return $html;
            })

            ->removeColumn('updated_at')
            ->removeColumn('deleted_at')
            ->make(true);
    }


}
