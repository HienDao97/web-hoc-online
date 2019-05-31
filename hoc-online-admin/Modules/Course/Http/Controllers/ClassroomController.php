<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Classroom;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\TheoryGroup;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use App\Models\KMsg;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('course::classroom.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->all();

            $validatorArray = [
                'class_name' => 'required',
                'code' => 'required',
                'course_id' => 'required',
                'status' => 'required',
                'tuition' => 'numeric'
            ];
            $result = new KMsg();

            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            // Save project
            try {
                Classroom::create($params);
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = $ex->getMessage();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::classroom.create', compact('courses'));
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
            $params = $request->all();

            $validatorArray = [
                'class_name' => 'required',
                'code' => 'required',
                'course_id' => 'required',
                'status' => 'required',
                'tuition' => 'numeric'
            ];
            $result = new KMsg();

            $validator = Validator::make($params, $validatorArray);
            if ($validator->fails()) {
                $result->message = $validator->messages();
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

            // Save project
            try {
                $item = Classroom::where('id', $id)->whereNull('deleted_at')->first();
                if(empty($item)){
                    $result->message = ["Không tồn tại khoá học này "];
                    $result->result = KMsg::RESULT_ERROR;
                    return \response()->json($result);
                }
                $item->class_name = $params["class_name"];
                $item->code = $params["code"];
                $item->course_id = $params["course_id"];
                $item->status = $params["status"];
                $item->tuition = $params["tuition"];
                $item->save();
                $result->result = KMsg::RESULT_SUCCESS;
                return \response()->json($result);
            } catch (Exception $ex) {
                $result->message = [$ex->getMessage()];
                $result->result = KMsg::RESULT_ERROR;
                return \response()->json($result);
            }

        } else {
            $item = Classroom::where('id', $id)->whereNull('deleted_at')->first();
            $courses = Course::whereNull('deleted_at')->get();
            return view('course::classroom.edit', compact('item','courses'));
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
        $result = Classroom::where('id', $id)->first();
        if ($result) {
            $result->deleted_at = Carbon::now();
            $result->save();

            return redirect(route('theory.group.index'))->with('messages','Xoá khoá lớp học thành công');
        } else {
            return redirect(route('theory.group.index'))->withErrors(["Không tồn tại lớp học này "]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $query = Classroom::select("class_rooms.*", "courses.name")->with('theory')->join('courses', 'courses.id','=', 'class_rooms.course_id');
        return Datatables::of($query)
            ->escapeColumns([])
            ->addColumn('actions', function ($classroom) {
                $html = Classroom::genColumnHtml($classroom);
                return $html;
            })
            ->addColumn('number_of_unit', function ($classroom) {

                return count($classroom->theory);
            })

            ->editColumn('tuition', function ($classroom){
                return number_format($classroom->tuition)." Đồng";
            })
            ->editColumn('status', function ($classroom){
                if($classroom->status == 0){
                    return "<label class=\"label label-default\">Chưa kích hoạt</label>";
                }
                else{
                    return "<label class=\"label label-success\">Kích hoạt</label>";
                }
            })
            ->removeColumn('updated_at')
            ->removeColumn('deleted_at')
            ->make(true);
    }
}
